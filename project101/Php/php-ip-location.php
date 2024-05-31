<?php 
include '../Layouts/main-user.php';
include 'db_connect.php';


// $ip = $_SERVER['HTTP_CLIENT_IP'] 
//     ? $_SERVER['HTTP_CLIENT_IP'] 
//     : ($_SERVER['HTTP_X_FORWARDED_FOR'] 
//      ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
//      : $_SERVER['REMOTE_ADDR']);   
?>
<style>

    #map {
        height:200px;
        width: 200px;
    }

</style>

  <div id="map"> </div>

  <?php include '../Layouts/footer.php'; ?>


  <script>

var map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

if(!navigator.geolocation){
 conosle.log("Your browser does not support geolocation feature");

}else {
    setInterval(() => {
        navigator.geolocation.getCurrentPosition(getPosition)
    }, 5000);
}
var marker, circle;

function getPosition(position){
    var lat = position.coords.latitude
    var long = position.coords.longitude;
    var accuracy = position.coords.accuracy;

if(marker){
    map.removeLayer(marker)
}   
if(circle){
    map.reomoveLayer(circle);
    }

        marker =  L.marker([ lat, long] )
        circle - L.marker ([ lat, long], {
            radius: accuracy,
        })
        var featureGroup = L.featureGroup([marker, circle]).addTo(map)
        map.fitBounds(featureGroup.getBounds())

        console.log("Your coordinate is lat:" + lat + " long:" + long + "accuracy:"+ accuracy)

}

</script
