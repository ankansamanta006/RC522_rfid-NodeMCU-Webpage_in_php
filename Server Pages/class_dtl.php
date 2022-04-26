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
//print_r($row_class_dtl);
if(isset($_POST['add_class']))
{
  $class_name=$_POST['class_name'];
  $sql_class_chek="SELECT * FROM `class_dtl` WHERE class_name='$class_name'";
  $qry_class_chek=mysqli_query($conn,$sql_class_chek) OR die('error');
  $row_class_chek=mysqli_fetch_array($qry_class_chek);
  if(empty($row_class_chek))
  {

  $sql_insert_class="INSERT INTO `class_dtl`(`class_name`) VALUES ('$class_name')";
        $qry_insert_class=mysqli_query($conn,$sql_insert_class) OR die('error');
            $masg="Class  Inserted Successfully";
  }
  else
  {
    $masg="Class Already Insert";
  }
}
if(isset($_POST['update_class']))
{

  $class_name=$_POST['class_name'];
  $cid=$_POST['cid'];
  $sql_class_chek="SELECT * FROM `class_dtl` WHERE class_name='$class_name'";
  $qry_class_chek=mysqli_query($conn,$sql_class_chek) OR die('error');
  $row_class_chek=mysqli_fetch_array($qry_class_chek);
  if(empty($row_class_chek))
  {

  $sql_update_class="UPDATE `class_dtl` SET `class_name`='$class_name' WHERE cid='$cid'";
        $qry_update_class=mysqli_query($conn,$sql_update_class) OR die('error');
            $masg="Class Updated Successfully";
  }
  else
  {
    $masg="You have not changed the class";
  }
}
if(isset($_POST['class_dlt_cid']))
{
  if(!empty($_POST['class_dlt_cid']))
  {
    echo $cid=$_POST['class_dlt_cid'];
    $sql_dlt_class="UPDATE `class_dtl` SET `status`='0' WHERE cid='$cid'";
    $qry_dlt_class=mysqli_query($conn,$sql_dlt_class) OR die('error');
    $masg="Class Deleted Successfully";
    $successdata =   array('success' => TRUE,'messssage' => 'Data Successfully Inserted!');
header('Content-Type: application/json; charset=utf-8');
echo json_encode($successdata);
  }
  else
  {
    $masg="Class Not Deleted";
    $data =   array('success' => FALSE, 'message' => $masg);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>

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
              <h3 class="page-title"> Basic Tables </h3><p style="color:red;"><?php echo $masg; ?></p>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>k
              </nav>
            </div>
            <div class="row">
             <!--  -->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form method="POST">
                    <div id="show_insert">
                    <h4 class="card-title">Add Class </h4>
                    
                    <div class="input-group">
                        <input type="text" class="align-center"  name="class_name" required placeholder="Enter Class name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="submit" name="add_class" value="add_class">Add Class</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form method="POST">
                    <div id="show_edit" style="display: none;">
                    <h4 class="card-title">Update Class </h4>
                    
                    <div class="input-group">
                        <input type="text" class="align-center" required name="class_name" id="class_name" placeholder="Enter Class name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <input type="hidden" class="align-center" required name="cid" id="cid" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="submit" name="update_class" value="update_class">Update Class</button>
                          <button class="btn btn-sm btn-gradient-danger" type="button"  id="cancel">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </form>
                      <br>
                      <h4 class="card-title">All Class Name</h4>
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Class Name</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row_class_dtl=mysqli_fetch_array($qry_class_dtl)) {
                         $sl++;

                        ?>
                        <tr id="<?php echo $row_class_dtl['cid']; ?>" class="<?php echo $row_class_dtl['cid']; ?>">
                          <td><?php echo $sl; ?> </td>
                          <td id="class_name"><?php echo $row_class_dtl['class_name']; ?></td>
                          <td>
                             <button  type="button" id="class_edit_id" class="btn  btn-sm " style="background-image: linear-gradient(to right,orange,blue);color:white;border:1px solid black;" title="back"><i class="mdi mdi-lead-pencil "></i></button>
                             <button type="button" id="class_delete_id" class="btn  btn-sm " style="background-color: #e62e00;color:white;border:1px solid black;"><i class="mdi mdi-delete Icon-lg " title="Delete"></i></button>

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
          $(document).ready(function(){
           $("#table").on('click','#class_edit_id',function(){
            var cid = $(this).closest('tr').attr('class');
             var class_name=$(this).closest('tr').find('#class_name').text();
             $("#show_insert").hide();
             $("#show_edit").show();
             $("#class_name").val(class_name);
             $("#cid").val(cid);

             //alert(class_name);

          });
         });
          $("#cancel").click(function(){
            $("#show_insert").show();
             $("#show_edit").hide();


          });

          $("#table").on('click','#class_delete_id',function(){
            var cid = $(this).closest('tr').attr('class');
            if (confirm('Are you sure?')) {
              class_dlt();
              alert("Class Sccessfully Deleted");
              window.location.reload();
            } else {
              alert('ok go back');
            }
          function class_dlt(){

            $.ajax({
              type:"POST",
              url:"https://mpap.in/rfid2/class_dtl.php",
              dataType:"JSON",
              data:{class_dlt_cid:cid},
              success: function(responsedata)
              {
                
                
                
              }
            });
          }



          });
         </script>