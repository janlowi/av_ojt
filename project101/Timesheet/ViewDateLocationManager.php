<?php
session_start();
$usertype = 'Manager';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title = "View Date-Location";
include '../Php/db_connect.php';
include '../Layouts/main-manager.php';
?>

<?php
if (isset($_POST['view_location'])) {
    $trainee_id = $_POST['trainee_id'];
    $date = date("Y-m-d", strtotime($_POST['date']));
    $sql = "SELECT * FROM `timesheet` WHERE  DATE(timestamp) = ? AND user_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('si', $date, $trainee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = date("Y-m-d", strtotime($row['timestamp']));

            // Fetch time in record
            $currentIn = "SELECT * FROM timesheet WHERE DATE(timestamp) = ? AND user_id = ? AND event_type = 'In' ORDER BY id DESC LIMIT 1";
            $stmtIn = $connect->prepare($currentIn);
            $stmtIn->bind_param('si', $date, $trainee_id);
            $stmtIn->execute();
            $resultIn = $stmtIn->get_result();

            if ($resultIn->num_rows > 0) {
                $rowIn = $resultIn->fetch_assoc();
                $currentInRecord = date('Y-m-d h:i:s A', strtotime($rowIn['timestamp']));
                $image = $rowIn['image'];
                $location = $rowIn['location'];
                $location_array = explode(",", $location);
                $lat = $location_array[0];
                $long = $location_array[1];
                $lat_json = json_encode($lat);
                $long_json = json_encode($long);
            }

            // Fetch time out record
            $currentOut = "SELECT * FROM timesheet WHERE DATE(timestamp) = ? AND user_id = ? AND event_type = 'Out' ORDER BY id DESC LIMIT 1";
            $stmtOut = $connect->prepare($currentOut);
            $stmtOut->bind_param('si', $date, $trainee_id);
            $stmtOut->execute();
            $resultOut = $stmtOut->get_result();

            if ($resultOut->num_rows > 0) {
                $rowOut = $resultOut->fetch_assoc();
                $currentOutRecord = date('Y-m-d h:i:s A', strtotime($rowOut['timestamp']));
                $imageTimeOut = $rowOut['image'];
                $locationTimeOut = $rowOut['location'];
                $location_arrayTimeOut = explode(",", $locationTimeOut);
                $latTimeOut = $location_arrayTimeOut[0];
                if (isset($location_arrayTimeOut[1])) {
                    $latTimeOut = $location_array[0];
                    $longTimeOut = $location_array[1];
                } else {
                    $latTimeOut = $location_array[0];
                    $longTimeOut = $location_array[1];
                }
                $lat_json_out = json_encode($lat);
                $long_json_out = json_encode($long);
            }
        }
    }
?>
    <div class="card">
    <div  class=" d-flex justify-content-end">
        <a href="../Timesheet/DisplayUserAttendanceManager.php?trainee_attendance=<?=$trainee_id ?> "  class="btn btn-dark">Back</a>
        </div>
        <div class="card-body">
            <?php if (isset($currentInRecord)) : ?>
                <h5 class="card-title">Time In</h5>
                <div class="d-flex align-items-start gap-3">
                    <img src="../Php/<?= $image ?>" class="rounded mx-auto d-block mt-5" alt="..." style="width: 400px; height: 400px; margin-right: 50px;">
                    <div>
                        <h5 class="card-title"><?= $currentInRecord ?></h5>
                        <div id="location">Latitude : <?= $lat ?> Longitude : <?= $long ?></div>
                        <div id="map" style="width: 500px; height: 390px; margin-right: 50px;"></div>
                    </div>
                </div>
            <?php else : ?>
                <p>No record of time in.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($currentOutRecord)) : ?>
                <h5 class="card-title">Time Out</h5>
                <div class="d-flex align-items-start gap-3">
                    <img src="../Php/<?= $imageTimeOut ?>" class="rounded mx-auto d-block mt-5" alt="..." style="width: 400px; height: 400px; margin-right: 50px;">
                    <div>
                        <h5 class="card-title"><?= $currentOutRecord ?></h5>
                        <div id="location">Latitude : <?= $latTimeOut ?> Longitude : <?= $longTimeOut ?></div>
                        <div id="mapOut" style="width: 500px; height: 390px; margin-right: 50px;"></div>
                    </div>
                </div>
            <?php else : ?>
                <p>No record of time out.</p>
            <?php endif; ?>
        </div>
    </div>

<?php } ?>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const map = L.map('map'); 

    const latValue= <?php echo $lat_json; ?>;
    const longValue= <?php echo $long_json ?>;
map.setView([latValue, longValue], 13); 
// Sets initial coordinates and zoom level

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map); 
// Sets map data source and associates with map

let marker, circle, zoomed;
let popup = L.popup();

if (marker) {
        map.removeLayer(marker);
        map.removeLayer(circle);
    }
    // Removes any existing marker and circule (new ones about to be set)

    marker = L.marker([latValue, longValue]).addTo(map);
    circle = L.circle([latValue, longValue]).addTo(map);
    // Adds marker to the map and a circle for accuracy

    if (!zoomed) {
        zoomed = map.fitBounds(circle.getBounds()); 
    }
function onMapClick(e) {
    popup
        .setLatlong(e.latValuelongValue)
        .setContent("You clicked the map at " + e.latValuelongValue.toString())
        .openOn(map);
}
map.on('click', onMapClick);

  

const mapOut = L.map('mapOut'); 
const latValueOut= <?php echo $lat_json_out; ?>;
const longValueOut= <?php echo $long_json_out ?>;
mapOut.setView([latValueOut, longValueOut], 13); 
// Sets initial coordinates and zoom level

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '© OpenStreetMap'
}).addTo(mapOut); 
// Sets map data source and associates with map

let markerOut, circleOut, zoomedOut;
let popupOut = L.popup();

if (markerOut) {
    mapOut.removeLayer(markerOut);
    mapOut.removeLayer(circleOut);
}
markerOut = L.marker([latValueOut, longValueOut]).addTo(mapOut);
circleOut = L.circle([latValueOut, longValueOut]).addTo(mapOut);


if (!zoomedOut) {
    zoomedOut = mapOut.fitBounds(circleOut.getBounds()); 
}
function onMapClick(e) {
popup
    .setLatlong(e.latValuelongValue)
    .setContent("You clicked the map at " + e.latValuelongValue.toString())
    .openOn(mapOut);
}
mapOut.on('click', onMapClick);
});

</script>