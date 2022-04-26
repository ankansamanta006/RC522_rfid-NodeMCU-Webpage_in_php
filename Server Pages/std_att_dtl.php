<?php 
ob_start();
include("connection.php");
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}
$masg="";
$rid=$_GET['std_rid'];
$sql_std_attend_dtl="SELECT * FROM `std_attend_dtl` WHERE status='1' AND std_rid='$rid' ORDER BY daid DESC";
$qry_std_attend_dtl=mysqli_query($conn,$sql_std_attend_dtl) OR die('error');

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
    <form method="POST">
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
              <h3 class="page-title"> Basic Tables </h3><p style="color:red;"><?php echo $masg; ?></p>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
              </nav>
            </div>
            <div class="row">
             <!--  -->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">All Student Details</h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Entry Time & Date</th>
                           <th> Exit Time & Date</th>
                           <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row_std_attend_dtl=mysqli_fetch_array($qry_std_attend_dtl)) {
                         $sl++;

                        ?>
                        <tr>
                          <td><?php echo $sl; ?> </td>
                          <td><?php echo $row_std_attend_dtl['std_entry_time']; ?></td>
                          <td><?php echo $row_std_attend_dtl['std_out_time']; ?></td>
                          <td>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <?php include("footer.php"); ?>
          <script type="text/javascript">
            window.setTimeout( function() {
  window.location.reload();
}, 3000);
          </script>