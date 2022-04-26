<?php 
$masg="";
ob_start();
include("connection.php");
$rid=$_GET['std_rid'];
$sql_std_dtl="SELECT * FROM std_reg INNER JOIN class_dtl ON std_reg.std_class_id = class_dtl.cid WHERE std_reg.id='$rid'";
$qry_std_dtl=mysqli_query($conn,$sql_std_dtl) OR die('error');
$row_std_dtl=mysqli_fetch_array($qry_std_dtl);
if(isset($_POST['add_card']))
{
  $rfid_uid=$_POST['std_card_number'];
  $sql_std_card_dtl="SELECT * FROM std_card_issu WHERE rfid_uid='$rfid_uid' AND status='1'";
  $qry_std_card_dtl=mysqli_query($conn,$sql_std_card_dtl) OR die('error');
  $row_std_card_dtl=mysqli_fetch_array($qry_std_card_dtl);
  if(empty($row_std_card_dtl))
  {

    date_default_timezone_set("Asia/Kolkata");
    
    $current_time=date('Y-m-d H:i:s');
    $sql_std_card_issue="INSERT INTO `std_card_issu`(`std_rid`, `rfid_uid`) VALUES ('$rid','$rfid_uid')";
    $qry_std_card_issue=mysqli_query($conn,$sql_std_card_issue) OR die('error');
    $sql_daily_att="INSERT INTO `std_attend_dtl`(`std_rid`,`rfid_uid`,`std_entry_time`) VALUES ('$rid','$rfid_uid','$current_time')";
    $qry_daily_att=mysqli_query($conn,$sql_daily_att) OR die('error');
    $masg="Successfull";
    $sql_std_card_status="UPDATE `std_reg` SET `card_status`='1' WHERE id='$rid'";
    $qry_std_card_status=mysqli_query($conn,$sql_std_card_status) OR die('error');


  }
  else
  {
    $masg="Card is registered to Other Person";
  }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
   
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <?php include("header.php") ?>
     
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <?php include("sidebar.php");?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Student Rehistration </h3><p style="color:red;"><?php echo $masg; ?></p>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
              </nav>
            </div>
            <div class="row">
             <!--  -->
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Enter Student infor mation</h4>
                    <form class="form-sample" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">RFID Card No.</label>
                            <div class="col-sm-9">
                              <input type="text" name="std_card_number" id="std_card_number" class="form-control" />
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student's Name</label>
                            <div class="col-sm-9">
                             <?php echo $row_std_dtl['std_name']; ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student's Father Name</label>
                            <div class="col-sm-9">
                              <?php echo $row_std_dtl['std_father_name']; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student  Class</label>
                            <div class="col-sm-9">
                              <?php echo $row_std_dtl['class_name']; ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Mobile No</label>
                            <div class="col-sm-9">
                              <?php echo $row_std_dtl['std_mobile_no']; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <?php echo $row_std_dtl['std_address']; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2" name="add_card" value="add_card">Issue</button>
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  
  </body>
</html>
<script type="text/javascript">
  
  setInterval(function()
{ 
    $.ajax({
      type:"GET",
      url:"https://mpap.in/rfid2/last_card.php",
      datatype:"JSON",
      success:function(data)
      {
        console.log(data.card_no);
        $('#std_card_number').val(data.card_no);
          
      }
    });
}, 2000);
</script>