<?php
$error='not connected';
$host='mysql8.000webhost.com';
$username='a1726010_blog';
$pass='Nirmalbaba12';

$db='a1726010_sundar';

$con=mysqli_connect($host,$username,$pass,$db) or die('sorry can not connect');


$query = mysqli_query($con,"SELECT * FROM on_off ");

$response = array();
if($query)
{
while($row = mysqli_fetch_array($query))
{
array_push($response,array("ID"=>$row[0],"Bluetooth"=>$row[1],"Wifi"=>$row[2],"Hotspot"=>$row[3],"MobileData"=>$row[4]));


}
echo json_encode(array("Server_response" => $response ));
}

mysqli_close($con);

?>