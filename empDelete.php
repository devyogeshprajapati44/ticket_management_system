<?php
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';

$Id=$_REQUEST["Id"];

//$sql="SELECT `emp`.`Id`, `emp`.`emp_name`, `emp`.`emp_status`,`emp`.`username`, `emp`.`password`, `emp`.`original_password`,`rol`.`role_id`, `rol`.`user_id`, `rol`.`role_name`, `rol`.`designation`, `rol`.`TYPE`, `rol`.`district`, `rol`.`city`, `rol`.`permission` FROM `employee` `emp` LEFT JOIN `roles` `rol` ON `emp`.`Id`=`rol`.`user_id` where `emp`.`Id`='$Id'";
$sql="SELECT `emp`.`emp_status` FROM `employee` `emp` where `emp`.`Id`='$Id'";
$run   = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($run);

//Delete code start here.
if(isset($_POST['savestatus']))
{

$emp_status=strtoupper($_POST["status"]);
//$date_of_leaving=strtoupper($_POST["date_of_leaving"]);

//$update_status="UPDATE `employee` SET `emp_status`='$emp_status' WHERE `Id`='$EmpID'";
//echo $update_status="UPDATE `employee` SET `emp_status`='$emp_status',`date_of_leaving`='$date_of_leaving' WHERE `Id`='$EmpID'";
$update_status="UPDATE `employee` SET `emp_status`='$emp_status' WHERE `Id`='$Id'";
//die;
$run = mysqli_query($conn, $update_status);
header("location:PFC.php?PageName=EmpDel&Mgs=1&EmpID=$EmpID");
}
//Delete code start here.

?>
<!-- ============================================================== -->
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
      
        <a href="view_user.php" alt="add_user" class="btn btn-primary">BACK</a><br/><br/>
        <div class="ms-auto text-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                TMS
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
 </div>
        <!-- ============================================================== -->
<div class="container-fluid">   
   <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form action="#" method="POST">
            <div class="card-body">
             <h2 style="color:#012970;">USER STATUS</h2>
                    <div class="form-group row">
                    <label for="fname"class="col-sm-3 text-end control-label col-form-label">STATUS</label>
                        <div class="col-md-6">
                        <?php if(($_REQUEST['Id']!='')){?>
                        <select name="status" class="status  form-control" id="status">
                                <option selected>--SELECT STATUS--</option>
                                <option value="<?php if($row['emp_status']=="2"){ echo $row['emp_status']; } else {echo "2"; }?>"selected><?php if($row['emp_status']=="2"){ echo $row['emp_status']="DEACTIVE"; } else {echo "DEACTIVE"; }?></option>
                                <option value="<?php if($row['emp_status']=="1"){ echo $row['emp_status']; } else {echo "1"; }?>"selected><?php if($row['emp_status']=="1"){ echo $row['emp_status']="ACTIVE"; } else {echo "ACTIVE"; }?></option>
                        </select>
                        <?php } ?>
                         </div>
                        </div>
                       </div>
                    <div class="card-body">
                  <input type="submit" name="savestatus" id="savestatus" value="DELETE" class="btn btn-primary" style="margin-left:687px;margin-top:15px;">
              </div>
           </form>
        </div>
     </div>
  </div>
</div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
</div>

 <!-- ==============footer========== -->
<?php include 'footer.php';?>
<!-- ==============footer========== -->


