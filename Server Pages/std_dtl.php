<?php 
ob_start();
include("connection.php");
session_start();
if(empty($_SESSION['login_dtl']))
{
  header("location:index.php");
}
$masg="";
$sql_class_dtl="SELECT * FROM `class_dtl` WHERE status='1'";
$qry_class_dtl=mysqli_query($conn,$sql_class_dtl) OR die('error');

if(isset($_POST['filter_class']))
{
   $std_class_id=$_POST['std_class_id'];
  $sql_std_dtl="SELECT * FROM std_reg INNER JOIN class_dtl ON std_reg.std_class_id = class_dtl.cid 
INNER JOIN std_card_issu ON std_reg.id=std_card_issu.std_rid
WHERE std_class_id='$std_class_id' AND std_reg.status='1';";
  $qry_std_dtl=mysqli_query($conn,$sql_std_dtl) OR die('error');
  
}
else
{
  $sql_std_dtl="SELECT * FROM std_reg INNER JOIN class_dtl ON std_reg.std_class_id = class_dtl.cid 
INNER JOIN std_card_issu ON std_reg.id=std_card_issu.std_rid
WHERE std_reg.status='1';";
$qry_std_dtl=mysqli_query($conn,$sql_std_dtl) OR die('error');
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
                    <h4 class="card-title">Filter Class </h4>
                    
                    <div class="input-group">
                        <select name="std_class_id">
                          <option>Select An Option</option>
                                <?php
                        while ($row_class_dtl=mysqli_fetch_array($qry_class_dtl)) {
                         

                        ?>
                                <option value="<?php echo $row_class_dtl['cid']; ?>"><?php echo $row_class_dtl['class_name']; ?></option>
                              <?php } ?>
                        </select>
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="submit" name="filter_class" value="filter_class">Add Class</button>
                        </div>
                      </div>
                      <br>
                      <h4 class="card-title">All Student Details</h4>
                    <table class="table table-bordered" id="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Student Name</th>
                          <th> Student Father Name</th>
                           <th> Student Class</th>
                            <th> Student Mobile</th>
                           <th> Student RFID </th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row_std_dtl=mysqli_fetch_array($qry_std_dtl)) {
                         $sl++;

                        ?>
                        <tr <?php if($row_std_dtl['card_status']=='0'){ echo 'style="background-color:red;"'; } ?> class="<?php echo $row_std_dtl['id']; ?>">
                          <td><?php echo $sl; ?> </td>
                          <td><?php echo $row_std_dtl['std_name']; ?></td>
                          <td><?php echo $row_std_dtl['std_father_name']; ?></td>
                          <td><?php echo $row_std_dtl['class_name']; ?></td>
                          <td><?php echo $row_std_dtl['std_mobile_no']; ?></td>
                          <td><?php echo $row_std_dtl['rfid_uid']; ?></td>
                          <td>
                            <?php if($row_std_dtl['card_status']=='0'){ 
                           echo '<a  href="https://mpap.in/rfid2/std_card_issue.php?std_rid='.$row_std_dtl['id'].'"class="btn  btn-sm " style="background-image: linear-gradient(to right, blue , yellow);color:white;border:1px solid black;"><i class="mdi mdi-credit-card-scan Icon-lg "></i></a>';
                         }
                        
                         echo '<a  href="https://mpap.in/rfid2/std_att_dtl.php?std_rid='.$row_std_dtl['id'].'" class="btn  btn-sm " style="background-color:#77b300;color:white;border:1px solid black;"><i class="mdi mdi-library-books Icon-lg " title="Attendance Details"></i></a>';
                            
                             ?>
                             <a  href="std_edit.php?std_rid=<?php echo $row_std_dtl['id'] ?>" class="btn  btn-sm " style="background-color: #000099;color:white;border:1px solid black;"><i class="mdi mdi-lead-pencil Icon-lg " title="Edit"></i></a>
                             <button type="button" id="std_delete_id" class="btn  btn-sm " style="background-color: #e62e00;color:white;border:1px solid black;"><i class="mdi mdi-delete Icon-lg " title="Delete"></i></button>

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
            $("#table").on('click','#std_delete_id',function(){
            var cid = $(this).closest('tr').attr('class');
            if (confirm('Are you sure?')) {
              class_dlt();
              // alert(cid);
              // alert("Class Sccessfully Deleted");
              
            } else {
              alert('ok go back');
            }
          function class_dlt(){
            //alert(cid);

            $.ajax({
              type:"POST",
              url:"https://mpap.in/rfid2/std_dlt.php",
              dataType:"JSON",
              data:{std_rid:cid},
              success: function(responsedata)
              {
                //console.log(responsedata.message)
                alert(responsedata.message);
                window.location.reload();
                
                
              }
            });
          }



          });
          </script>