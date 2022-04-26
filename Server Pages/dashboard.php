<?php
include("connection.php");
ob_start();
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}


date_default_timezone_set("Asia/Kolkata");
$current_y=date('Y');
$current_m=date('m');
$current_d=date('d');
$sql_daily_att_dtl="SELECT MAX(class_dtl.class_name) AS class_name,MAX(class_dtl.cid) AS class_id,COUNT(DISTINCT std_attend_dtl.std_rid) AS att_student FROM std_reg LEFT JOIN class_dtl ON std_reg.std_class_id=class_dtl.cid INNER JOIN std_attend_dtl ON std_reg.id=std_attend_dtl.std_rid  WHERE YEAR(std_attend_dtl.std_entry_time)='$current_y' AND MONTH(std_attend_dtl.std_entry_time)='$current_m' AND DAY(std_attend_dtl.std_entry_time)='$current_d' AND std_reg.status='1' GROUP BY class_dtl.cid;";
$qry_dily_att_dtl=mysqli_query($conn,$sql_daily_att_dtl) OR die('error');
$sql_std_dily_att_total="SELECT COUNT(DISTINCT std_attend_dtl.std_rid) AS att_student, (SELECT COUNT(*) FROM std_reg WHERE status='1') AS aa FROM std_reg RIGHT JOIN std_attend_dtl ON std_reg.id=std_attend_dtl.std_rid WHERE YEAR(std_attend_dtl.std_entry_time)='$current_y' AND MONTH(std_attend_dtl.std_entry_time)='$current_m' AND DAY(std_attend_dtl.std_entry_time)='$current_d' AND std_reg.status='1'";
$qry_std_dily_att_total=mysqli_query($conn,$sql_std_dily_att_total) OR die('error');
$row_std_dily_att_total=mysqli_fetch_array($qry_std_dily_att_total);
$present_std=$row_std_dily_att_total['att_student'];
$total_std=$row_std_dily_att_total['aa'];
$percentage=($present_std*100)/$total_std;

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
      
      <!-- partial:partials/_navbar.html -->
       <?php include("header.php") ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include("sidebar.php");?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <?php while($row_dily_att_dtl=mysqli_fetch_array($qry_dily_att_dtl))
              {
               ?>
              <div class="col-md-2 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                   <!--  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3"> Class &nbsp; <?php echo $row_dily_att_dtl['0']; ?>
                    </h4>
                    <h2 class="mb-5"><?php echo $row_dily_att_dtl['1']; ?></h2>
                    <h6 class="card-text">Student Present</h6>
                    <a  href="std_today.php?class_id=<?php echo $row_dily_att_dtl['class_id'] ?>" class="btn  btn-sm " style="background-color: #000099;color:white;border:1px solid black;"><i class="mdi mdi-lead-pencil Icon-lg " title="Edit"></i></a>
                    <!-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                  </div>

                </div>
              </div>

            <?php } ?>

              <!-- <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body float-middle">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3"> Total Present Student <i class="mdi mdi-diamond mdi-24px float-center"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo  $row_std_dily_att_total['att_student']; ?> / <?php echo  $row_std_dily_att_total['aa']; ?></h2>
                    <h6 class="card-text">
                      <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>


                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
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
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>