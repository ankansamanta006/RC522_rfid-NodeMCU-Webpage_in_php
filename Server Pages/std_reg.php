<?php 
ob_start();
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}
include("connection.php");
$masg="";
$sql_class_dtl="SELECT * FROM `class_dtl` WHERE status='1'";
$qry_class_dtl=mysqli_query($conn,$sql_class_dtl) OR die('error');
//$row_class_dtl=mysqli_fetch_array($qry_class_dtl);
if(isset($_POST['add_std']))
{
  $std_name=$_POST['std_name'];
  $std_father_name=$_POST['std_father_name'];
  $std_class_id=$_POST['std_class_id'];
  $std_mobile_no=$_POST['std_mobile_no'];
  $std_address=$_POST['std_address'];

  $sql_add_std="INSERT INTO `std_reg`(`std_name`, `std_father_name`, `std_class_id`, `std_mobile_no`, `std_address`) VALUES ('$std_name','$std_father_name','$std_class_id','$std_mobile_no','$std_address')";
  $qry_add_std=mysqli_query($conn,$sql_add_std) OR die('error');
  $masg="Student Successfully Registerd";

  
}
else
{
  $masg="";
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
                            <label class="col-sm-3 col-form-label">Student's Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="std_name" class="form-control" required />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student's Father Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="std_father_name" class="form-control" required />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Select Class</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="std_class_id" required>
                                <option value="">Select An Option</option>
                                <?php
                        while ($row_class_dtl=mysqli_fetch_array($qry_class_dtl)) {
                         

                        ?>
                                <option value="<?php echo $row_class_dtl['cid']; ?>"><?php echo $row_class_dtl['class_name']; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Mobile No</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="std_mobile_no" required  />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="std_address" required />
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                      <button type="submit" class="btn btn-gradient-primary me-2" name="add_std" value="add_std">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <?php include("footer.php"); ?>