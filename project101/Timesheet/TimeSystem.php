<?php  
// include '../Php/authenticate.php';
// checkLoggedIn();
// checkUserType();
$title="Time Tracking System";
 include '../Php/db_connect.php';

  ?>

     <!-- //leaflet -->
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    
<?php
$user_id = $_SESSION['user_id'];

$sql = "SELECT event_type FROM timesheet WHERE DATE(timestamp) = CURDATE() AND user_id = '$user_id' ORDER BY id DESC LIMIT 1";
$query = mysqli_query($connect, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $latest_event_type = $row['event_type'];

    if ($latest_event_type == 'In') {
        // If the latest event type is "In", display the "Out" button
        echo '
   
        <p class="card-text">Don\'t forget to time Out.</p>
        <div class="d-grid gap-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#timeInDefault">
               Time Out
            </button>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="timeInDefault" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Daily Timesheet Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p>Current Date-Time: <span bg-success id="datetime"></span></p>
                            <p style="color: orange;">Please turn on the GPS on your device.</p>
                            <form id="selfie-form" method="post" action="../Php/time-in-out.php" enctype="multipart/form-data">
                                <div class = "align-items-center">
                                    <video id="video" width="320" height="240" autoplay></video></br></br>
                                    <button type="button" id="capture-button" class="btn btn-warning">Capture</button></br></br>
                                    <canvas id="canvas" width="320" height="240" hidden></canvas>

                              <label class="form-label" for="lat" >Latitude </label>
                                <input id="lat" name ="lat" type="text" value="" class="form-control"> 
                                <label class="form-label" for="Long" >Longitude </label>
                                <input id="long" name = "long" type="text" value="" class="form-control"> 
                                <input type="hidden" name="selfie_out" id="selfie_out">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        ';
    
        // JavaScript to update location input field and initialize camera when modal is shown
        echo '
        <script>
            // Initialize camera and watch position when modal is shown
            document.getElementById("timeInDefault").addEventListener("shown.bs.modal", function () {
                const video = document.getElementById("video");
                const canvas = document.getElementById("canvas");
                const captureButton = document.getElementById("capture-button");
                const selfieInput = document.getElementById("selfie_out");
                const form = document.getElementById("selfie-form");
    
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        video.srcObject = stream;
                    })
                    .catch(err => console.error("Error accessing webcam: ", err));
    
                captureButton.addEventListener("click", () => {
                    canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
                    const dataURL = canvas.toDataURL("image/png");
                    selfieInput.value = dataURL;
                    form.submit();
                });
    
                let id;
                let target;
                let options;
    
                function success(pos) {
                    const latitude = pos.coords.latitude;
                    const longitude = pos.coords.longitude;
                
                    console.log("Latitude:", latitude);
                    console.log("Longitude:", longitude);
                
                    // Assign latitude and longitude values to the respective input fields
                    document.getElementById("lat").value = latitude;
                    document.getElementById("long").value = longitude;
                
                    console.log("Congratulations, you reached the target");
                
                    // Clear the geolocation watch
                    navigator.geolocation.clearWatch(id);
                }
    
                function showError(error) {
                    switch(error.code) {
                      case error.PERMISSION_DENIED:
                       alert ("User denied the request for Geolocation.");
                        break;
                      case error.POSITION_UNAVAILABLE:
                        alert( "Location information is unavailable.");
                        break;
                      case error.TIMEOUT:
                       alert("The request to get user location timed out.");
                        break;
                      case error.UNKNOWN_ERROR:
                       alert("An unknown error occurred.");
                        break;
                    }
                  }
                options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0,
                };
    
                id = navigator.geolocation.watchPosition(success, showError, options);
            });
    
            // Display current date and time
            const updateTime = () => {
                const now = new Date();
                document.getElementById("datetime").textContent = now.toLocaleString();
            };
            updateTime();
            setInterval(updateTime, 1000);
        </script>
        ';
    } else {
        // If the latest event type is "Out", display the "In" button
        echo '
   
        <p class="card-text">Don\'t forget to time In.</p>
        <div class="d-grid gap-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timeInDefault">
               Time In 
            </button>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="timeInDefault" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Daily Timesheet Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p>Current Date-Time: <span bg-success id="datetime"></span></p>
                            <p style="color: orange;">Please turn on the GPS on your device.</p>
                            <form id="selfie-form" method="post" action="../Php/time-in-out.php" enctype="multipart/form-data">
                                <div class = "align-items-center">
                                    <video id="video" width="320" height="240" autoplay></video></br></br>
                                    <button type="button" id="capture-button" class="btn btn-primary">Capture</button></br></br>
                                    <canvas id="canvas" width="320" height="240" hidden></canvas>

                                    <label class="form-label" for="lat" >Latitude </label>
                                <input id="lat" name ="lat" type="text" value="" class="form-control"> 
                                <label class="form-label" for="Long" >Longitude </label>
                                <input id="long" name = "long" type="text" value="" class="form-control"> 
                                <input type="hidden" name="selfie_in" id="selfie_in" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        ';
    
        // JavaScript to update location input field and initialize camera when modal is shown
        echo '
        <script>
            // Initialize camera and watch position when modal is shown
            document.getElementById("timeInDefault").addEventListener("shown.bs.modal", function () {
                const video = document.getElementById("video");
                const canvas = document.getElementById("canvas");
                const captureButton = document.getElementById("capture-button");
                const selfieInput = document.getElementById("selfie_in");
                const form = document.getElementById("selfie-form");
    
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        video.srcObject = stream;
                    })
                    .catch(err => console.error("Error accessing webcam: ", err));
    
                captureButton.addEventListener("click", () => {
                    canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
                    const dataURL = canvas.toDataURL("image/png");
                    selfieInput.value = dataURL;
                    form.submit();
                });
    
                let id;
                let target;
                let options;
    
                function success(pos) {
                    const latitude = pos.coords.latitude;
                    const longitude = pos.coords.longitude;
                
                    console.log("Latitude:", latitude);
                    console.log("Longitude:", longitude);
                
                    // Assign latitude and longitude values to the respective input fields
                    document.getElementById("lat").value = latitude;
                    document.getElementById("long").value = longitude;
                
                    console.log("Congratulations, you reached the target");
                
                    // Clear the geolocation watch
                    navigator.geolocation.clearWatch(id);
                }
    
                function showError(error) {
                    switch(error.code) {
                      case error.PERMISSION_DENIED:
                       alert ("User denied the request for Geolocation.");
                        break;
                      case error.POSITION_UNAVAILABLE:
                        alert( "Location information is unavailable.");
                        break;
                      case error.TIMEOUT:
                       alert("The request to get user location timed out.");
                        break;
                      case error.UNKNOWN_ERROR:
                       alert("An unknown error occurred.");
                        break;
                    }
                  }
                options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0,
                };
    
                id = navigator.geolocation.watchPosition(success, showError, options);
            });
    
            // Display current date and time
            const updateTime = () => {
                const now = new Date();
                document.getElementById("datetime").textContent = now.toLocaleString();
            };
            updateTime();
            setInterval(updateTime, 1000);
        </script>
        ';
    }

} else {
    // If there are no events for the user, display the "In" button by default
    echo '
   
    <p class="card-text">Don\'t forget to time In.</p>
    <div class="d-grid gap-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timeInDefault">
           Time In 
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="timeInDefault" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Daily Timesheet Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class = "align-items-center">
                        <p>Current Date-Time: <span bg-success id="datetime"></span></p>
                        <p style="color: orange;">Please turn on the GPS on your device.</p>
                        <form id="selfie-form" method="post" action="../Php/time-in-out.php" enctype="multipart/form-data">

                                <video id="video" width="320" height="240" autoplay></video></br></br>
                                <button type="button" id="capture-button" class="btn btn-primary">Capture</button></br></br>
                                <canvas id="canvas" width="320" height="240" hidden></canvas>
                          
                            <label class="form-label" for="lat" >Latitude </label>
                            <input id="lat" name ="lat" type="text" value="" class="form-control">
                            <label class="form-label" for="long" >Longitude </label> 
                            <input  id="long" name = "long" type="text" value="" class="form-control"> 
                            <input type="hidden" name="selfie_in" id="selfie_in" >

                        </form> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    ';

    // JavaScript to update location input field and initialize camera when modal is shown
    echo '
    <script>
        // Initialize camera and watch position when modal is shown
        document.getElementById("timeInDefault").addEventListener("shown.bs.modal", function () {
            const video = document.getElementById("video");
            const canvas = document.getElementById("canvas");
            const captureButton = document.getElementById("capture-button");
            const selfieInput = document.getElementById("selfie_in");
            const form = document.getElementById("selfie-form");

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(err => console.error("Error accessing webcam: ", err));

            captureButton.addEventListener("click", () => {
                canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL("image/png");
                selfieInput.value = dataURL;
                form.submit();
            });

            let id;
            let target;
            let options;

            function success(pos) {
                const latitude = pos.coords.latitude;
                const longitude = pos.coords.longitude;
            
                console.log("Latitude:", latitude);
                console.log("Longitude:", longitude);
            
                
                // Assign latitude and longitude values to the respective input fields
                document.getElementById("lat").value = latitude;
                document.getElementById("long").value = longitude;
            
                console.log("Congratulations, you reached the target");
            
                // Clear the geolocation watch
                navigator.geolocation.clearWatch(id);
            }

            function showError(error) {
                switch(error.code) {
                  case error.PERMISSION_DENIED:
                   alert ("User denied the request for Geolocation.");
                    break;
                  case error.POSITION_UNAVAILABLE:
                    alert( "Location information is unavailable.");
                    break;
                  case error.TIMEOUT:
                   alert("The request to get user location timed out.");
                    break;
                  case error.UNKNOWN_ERROR:
                   alert("An unknown error occurred.");
                    break;
                }
              }
            options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0,
            };

            id = navigator.geolocation.watchPosition(success, showError, options);
        });

        // Display current date and time
        const updateTime = () => {
            const now = new Date();
            document.getElementById("datetime").textContent = now.toLocaleString();
        };
        updateTime();
        setInterval(updateTime, 1000);
    </script>
    ';
}
?>

             <br>               
          <!-- Show current time -->
      <script src="../Assets/js/dateTime.js"> </script>
    <!-- Show current time -->
