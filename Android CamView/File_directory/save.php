<?php

$name =$_POST["name"];
$image =$_POST["image"];
$decode = base64_decode("$image");
file_put_contents("pictures/".$name.".JPG",$decode);

?>