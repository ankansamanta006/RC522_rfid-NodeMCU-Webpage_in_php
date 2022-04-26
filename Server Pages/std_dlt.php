<?php 
ob_start();
include("connection.php");
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}
$rid=$_POST['std_rid'];
if(!empty($rid))
{
	$sql_std_dlt="UPDATE `std_reg` SET `status`='0' WHERE id='$rid'";
	$qry_std_dtl=mysqli_query($conn,$sql_std_dlt) OR die('error');
	$sql_std_card_dlt="UPDATE `std_card_issu` SET `status`='0' WHERE std_rid='$rid'";
	$qry_std_card_dtl=mysqli_query($conn,$sql_std_card_dlt) OR die('error');
	//echo "hi";
	//header("location:std_dtl.php");
	$data=array('success' => TRUE, 'device_status' =>'', 'message' => 'Student Succesfully Deleted');
  	echo json_encode($data);
  
}
else
{
	$data=array('success' => TRUE, 'device_status' =>'', 'message' => 'Student Succesfully Deleted');
  	echo json_encode($data);
}

?>