<?php 
ob_start();
include("connection.php");

$sql_last_card="SELECT * FROM `ran_uid` WHERE status='1' ORDER BY id DESC";
$qry_last_card=mysqli_query($conn,$sql_last_card) OR die('error');
$row_last_card=mysqli_fetch_array($qry_last_card);
$card_no=$row_last_card['rfid_uid'];
$successdata =   array('success' => TRUE,'messssage' => 'Data Successfully Inserted!','card_no'=>$card_no);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($successdata);
?>