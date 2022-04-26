<?php 
ob_start();
include("connection.php");

if (isset($_POST['rfid_uid'])){ 
  if(!empty($_POST['rfid_uid']))
    {
      $rfid_uid=$_POST['rfid_uid'];
      $sql="INSERT INTO `ran_uid`(`rfid_uid`) VALUES ('$rfid_uid')";
      $qry=mysqli_query($conn,$sql) OR die('error');
        $sql_std_cardissue_status="SELECT * FROM `std_card_issu` WHERE rfid_uid='$rfid_uid' AND status='1'";
        $qry_std_cardissue_status=mysqli_query($conn,$sql_std_cardissue_status) OR die('error');
        $row_std_cardissue_status=mysqli_fetch_array($qry_std_cardissue_status);
        echo $std_rid=$row_std_cardissue_status['std_rid'];
        if(!empty($row_std_cardissue_status)){
          date_default_timezone_set("Asia/Kolkata");
          $current_y=date('Y');
          $current_m=date('m');
          $current_d=date('d');
          $sql_std_out_status="SELECT * FROM `std_attend_dtl` WHERE rfid_uid='$rfid_uid' AND status='1' AND YEAR(std_entry_time)='$current_y' AND MONTH(std_entry_time)='$current_m' AND DAY(std_entry_time)='$current_d' ORDER BY daid DESC";
          $qry_std_out_status=mysqli_query($conn,$sql_std_out_status) OR die('error');
          $row_std_out_status=mysqli_fetch_array($qry_std_out_status);
          date_default_timezone_set("Asia/Kolkata");
          $current_time=date('Y-m-d H:i:s');
          $row_std_out_status['std_out_time'];
          $lid=$row_std_out_status['daid'];

          if(empty($row_std_out_status))
          {
            $sql_daily_att="INSERT INTO `std_attend_dtl`(`std_rid`,`rfid_uid`,`std_entry_time`) VALUES ('$std_rid','$rfid_uid','$current_time')";
            $qry_daily_att=mysqli_query($conn,$sql_daily_att) OR die('error');

          }
          elseif(!empty($row_std_out_status['std_out_time']))
          {
            echo "hi";
            $sql_daily_att="INSERT INTO `std_attend_dtl`(`std_rid`,`rfid_uid`,`std_entry_time`) VALUES ('$std_rid','$rfid_uid','$current_time')";
            $qry_daily_att=mysqli_query($conn,$sql_daily_att) OR die('error');
          }
          elseif(empty($row_std_out_status['std_out_time']))
          {
            
            $sql_daily_att="UPDATE `std_attend_dtl` SET `std_out_time`='$current_time' WHERE `rfid_uid`='$rfid_uid' AND `daid`='$lid' ";
            $qry_daily_att=mysqli_query($conn,$sql_daily_att) OR die('error');
          
          }
          
        
        }
        
      
}
}
 ?>
