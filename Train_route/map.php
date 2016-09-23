<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Polylines</title>
    <style>
     body {  font: 600 14px/24px "Open Sans", "HelveticaNeue-Light", "Helvetica Neue Light", 
"Helvetica Neue", Helvetica, Arial, "Lucida Grande", Sans-Serif;}
button {  border: 0;  background: #0087cc;  border-radius: 4px;  box-shadow: 0 5px 0 #006599; width:350px;
  color: #fff;  cursor: pointer;  font: inherit;  margin: 0;  outline: 0;  padding: 12px 20px; 
  transition: all .1s linear;}
  button:active {  box-shadow: 0 2px 0 #006599;  transform: translateY(3px);}
	body{background-color:#9bbaab;}
	 #floating-panel {
  position: absolute;
  top: 50px;
  left: 50%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
       left:24%;
	  margin-top:30px;
        height: 96%;
		width:74%;
      }
	  #right-panel {
	  
        margin: 10px;
        border-width: 2px;
        width: 20%;
        
        text-align: left;
        padding-top: 1px;
      }
	  #station {font-size:20px;
	  font-family: 'Roboto';
  font-style: normal;
  font-weight: 300;
  margin:20px;
  border-bottom:2px solid green;
  height:40px;
	  width:25%;
  }
 
	  #station:hover{background-color:orange;
	  height:40px;
	  width:25%;
	  color:white;
	  transition-property: background;
  transition-duration: 1s;
 
	  }
	  input{width:130%;
	  border:black solid 1px;
	  border-radius:12px 12px;
	  height:40px;
	  
	  }

    </style>
  </head>
  <body>
  
  <div id="station">
 <b>Trains Between Stations</b>
 </div>
 <div id="right-panel">
 
 <form method="post" action="" >
   
&nbsp <input type="text" id="start" name="start" value="24887" placeholder="Enter Train Number" required="required" />
  </br>
   

   

&nbsp &nbsp   <button name="submit" style="font-family: 'Roboto';
  font-style: normal;
  font-weight: 300;font-size:30px;" id="submit">GO</button>
 
 </form>
 

 </div>
  
    <div id="map"></div>
    <script>

      // This example creates a 2-pixel-wide red polyline showing the path of William
      // Kingsford Smith's first trans-Pacific flight between Oakland, CA, and
      // Brisbane, Australia.

     function initMap() {
 // var directionsService = new google.maps.DirectionsService;
 // var directionsDisplay = new google.maps.DirectionsRenderer;

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 28.7897468, lng: 73.89893599999999},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  
  
  <?php
  
$msg=14114;
if (isset($_POST['submit'])) {
$msg = $_POST['start'];
//$dest=$_POST['end'];



 $str = file_get_contents('http://api.railwayapi.com/route/train/'.$msg.'/apikey/obver4944/'); 
 $json = json_decode($str, true);
 
 $LAT=array();
$checkboxArray=array();
$LAG=array();
$i=0;
for($key=0;$key<sizeof($json['route']);$key++){ 
for($key1=0;$key1<sizeof($json['route'][$key]);$key1++){
  $LAT[$i]= $json['route'][$key]['lat']; 
  $LAG[$i]=$json['route'][$key]['lng']; 
  $checkboxArray[$i]=$json['route'][$key]['fullname'];
	 $i++;
	 break;
				} 
					 }
//					 }
 
 
 
 
 
}
else{
	$s=0;
$dest="";
$source="";
}

?>
  
 
var LAT = <?php echo json_encode( $LAT); ?>;
var LAG= <?php echo json_encode( $LAG); ?>;
var checkboxArray =<?php echo json_encode( $checkboxArray); ?>;
var t = 38;
t = "<?php echo $i;   $k=0; ?>";
var citymap=[];
var flightPlanCoordinates=[];
  //var a=123,c=4567;
  for(var i=0;i<t;i++){
flightPlanCoordinates.push({
  	lat:LAT[i],lng:LAG[i]
 //source:checkboxArray[i]
  });
citymap.push({
  	lat:LAT[i],lng:LAG[i]
 //source:checkboxArray[i]
  });
  
}


  for (var city in citymap) {
  
    // Add the circle for this city to the map.
    var cityCircle = new google.maps.Circle({
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      center: {lat:citymap[city]['lat'],lng:citymap[city]['lng']},
      radius: 8000
    });
  }
  
  
  
  
  /*
  var flightPlanCoordinates = [
  {lat: 29.3177, lng: 73.89893599999999},
   {lat: 29.9456906, lng: 78.16424780000001}
   
   ];
   
   */
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: 'blue',
    strokeOpacity: 1.0,
    strokeWeight: 4
  });

<!----- Info window  ---?
/*
var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'Uluru (Ayers Rock)'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
	  
	  */

  
        flightPath.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1HOKQRI_JcuAqEs255LN6Fnukn12F0zw&callback=initMap">
    </script>
  </body>
</html>