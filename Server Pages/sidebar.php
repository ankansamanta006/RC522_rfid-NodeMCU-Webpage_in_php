<?php
ob_start();
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}
$login_dtl=$_SESSION['login_dtl'];
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                 <div class="nav-profile-image">
                  <i class="mdi mdi-account-circle mdi-36px"></i>
                 </div>
                  <span class="font-weight-bold mb-2"><?php echo $login_dtl['admin_name']; ?></span>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Student Section</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="std_dtl.php">Student Details</a></li>
                  <li class="nav-item"> <a class="nav-link" href="std_reg.php">Student Registration</a></li>
                  <li class="nav-item"> <a class="nav-link" href="std_reg_dtl.php">Student Issue Card</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="class_dtl.php">
                <span class="menu-title">Class Details</span>
                <i class="mdi mdi-settings menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>