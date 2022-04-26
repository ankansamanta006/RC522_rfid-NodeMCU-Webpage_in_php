<?php 
ob_start();
include("connection.php");
$masg="";

 
$to = "soumikkarmahapatra23@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From:tpiclg@mpap.in";

mail($to,$subject,$txt,$headers);


?>

