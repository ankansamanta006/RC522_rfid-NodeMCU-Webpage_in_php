<?php 
$masg="";
ob_start();
include("connection.php");
session_start();
if(isset($_POST['login']))
{
  $admin_user_id=$_POST['admin_user_id'];
  $admin_pass=$_POST['admin_pass'];
  $en_pass=md5($admin_pass);
  $sql_admin_dtl="SELECT * FROM admin_dtl WHERE admin_user_id='$admin_user_id' AND admin_pass='$en_pass' AND status='1'";
$qry_admin_dtl=mysqli_query($conn,$sql_admin_dtl) OR die('error');
$row_admin_dtl=mysqli_fetch_array($qry_admin_dtl);
if(!empty($row_admin_dtl))
{
  $_SESSION["login_dtl"] = $row_admin_dtl;
  header("location:dashboard.php");
}
else
{
  $masg="Password Or UserName is Not Currect";
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
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="assets/images/logo.svg">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light" style="color:red;"><?php echo $masg; ?></h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="text"name="admin_user_id" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password"  name="admin_pass" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                   <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" id="show_pass"> Show Password </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button  name="login" type="submit" value="submit"class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href=>SIGN IN</button>
                  </div>
                </form>
                 USERNAME:admin <br>
                 PASSWORD:admin
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
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
    <script type="text/javascript">
      $("#show_pass").change(function(){
    if($('#show_pass').is(':checked'))
    {

      // alert("hi");
      // console.log("hi");
      $("#exampleInputPassword1").attr('type', 'text');
    }
    else
    {
      $("#exampleInputPassword1").attr('type', 'password');

    }
  });

    </script>
  </body>
</html>