<?php
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';

$Id=$_REQUEST["Id"];
$message='';
$sql="SELECT `emp`.`Id`, `emp`.`emp_name`, `emp`.`emp_status`,`emp`.`username`, `emp`.`password`, `emp`.`original_password`,`rol`.`role_id`, `rol`.`user_id`, `rol`.`role_name`, `rol`.`designation`, `rol`.`TYPE`, `rol`.`district`, `rol`.`city`, `rol`.`permission` FROM `employee` `emp` LEFT JOIN `roles` `rol` ON `emp`.`Id`=`rol`.`user_id` where `emp`.`Id`='$Id'";
$run   = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($run);
$sites=explode(',',$row["role_name"]);
$district_nam=explode(',',$row["district"]);
$city_nam=explode(',',$row["city"]);
//print_r($sites);

//Update User code.
if(isset($_POST["submit"]))
{
  if(isset($_POST["names"]))
  {
    $name=$_POST["names"];
    $username=$_POST["usernames"];
    $password = $_POST['password'];//Get the password from the URL,here we have use rawurldecode tooo get data from URL as it is.
    $options  = array("cost"=>4);
    $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);//BCRYPT the Password for security purpose.
    
    $add_user="INSERT INTO `employee`(`emp_name`,`username`, `password`, `original_password`)VALUES('$name','$username','$hashPassword','$password')";
    $run_Sub = mysqli_query($connection,$add_user);
    $last_id = mysqli_insert_id($connection);
    //$last_id='Test1234';
  }

$USER_ID=$last_id;     //Last inserted Id saved in the variable from the add_user data.
$role_name=$_POST["rolenames"];   //Role names from the role  assign Form.
$designation=$_POST["designation"]; //Designation from the role  assign Form.
$TYPE=$_POST["TYPE"]; //Type from the role  assign Form.
$districts=$_POST["district"]; //District from the role  assign Form.
$cities=$_POST["city"]; //city from the role  assign Form.

foreach($role_name as $role_value)
{   
    $Role_multi[]=$role_value; //Getting Multiple data of Role Name.
}
foreach($districts as $districts_value)
{   
    $districts_multi[]=$districts_value; //Getting Multiple data of District.
}
foreach($cities as $cities_value)
{   
    $cities_multi[]=$cities_value; //Getting Multiple data of City.
}

$commaSeparated_Role_multi = implode(',',$Role_multi);//Getting together Multiple data of Role Name.
$commaSeparated_districts_multi = implode(',',$districts_multi);//Getting together Multiple data of Role Name.
$commaSeparated_cities_multi = implode(',',$cities_multi);//Getting together Multiple data of Role Name.

    // Perform SQL insertion.
    $role_assign="INSERT INTO `roles`(`user_id`, `role_name`, `designation`, `TYPE`, `district`, `city`) VALUES ('$USER_ID','$commaSeparated_Role_multi','$designation','$TYPE','$commaSeparated_districts_multi','$commaSeparated_cities_multi')";
    //die;
    $run_role = mysqli_query($connection,$role_assign);
    if($run_role > '0')
    {
        $message="Data Save";
        //header("Location:role_assign.php");
    }
    else
    {
        $message="Data Not Save";
        //header("Location:role_assign.php");
    }

    // Set headers for redirection
    header("Location: empEdit.php?Mgs=1");
    ob_end_flush(); // Send the output buffer and redirect
    exit(); // Ensure no further code executes after the redirection
}
//Update User code.
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
<?php echo "<h4>".$message."</h4>"; ?>
          <?php
if(isset($_REQUEST["Mgs"])){
    $Mgs=$_REQUEST["Mgs"];
    if($Mgs==1){
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><i class="bi bi-check"></i> Success !</span>Data Saved.</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
    }
}
?>
   <div class="row">
     <div class="col-md-12">
       <div class="card">
         <form action="#" method="POST">
           <div class="card-body">
             <h2 style="color:#012970;">EDIT USER</h2>
               <div class="form-group row">
                 <label for="fname"class="col-sm-3 text-end control-label col-form-label">Name</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="Name" name="names" id="names" value="<?php echo $row["emp_name"];?>">
                      </div>
                     </div>
                     <div class="form-group row">
                      <label  for="lname" class="col-sm-3 text-end control-label col-form-label">User Name</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="UserName" name="usernames" id="usernames" value="<?php echo $row["username"];?>">
                      </div>
                      </div>
                       <div class="form-group row">
                         <label for="lname"  class="col-sm-3 text-end control-label col-form-label" >Password</label>
                            <div class="col-sm-6">
                          <input type="text" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $row["original_password"];?>">
                       </div>
                     </div>
                
              <div class="form-group row">
                <label for="fname"class="col-sm-3 text-end control-label col-form-label">Role Name</label>
                 <div class="col-md-6">
                  <select class="select2 form-select shadow-none mt-3"  name="rolenames[]" multiple="multiple"  style="height: 36px; width: 100%">
                      <option value="NA">--SELECT--</option>
                      <?php 
                                    $sqlsite="SELECT * FROM `sites`";
                                    $result = mysqli_query($connection,$sqlsite);
                                    while( $row_site = mysqli_fetch_array($result))
                                    {
                      ?>
                                  <option value="<?php echo $row_site["sites"];?>"<?php if(in_array($row_site["sites"],$sites)) {echo 'selected'; }?>><?php echo $row_site["sites"];?></option>
                  <?php } ?>
                  </select>
               </div>
               </div>
                  <div class="form-group row">
                      <label for="fname"class="col-sm-3 text-end control-label col-form-label">Designation</label>
                        <div class="col-md-6">
                         <select class="form-control" name="designation" id="designation" >
                          <option value="NA">--SELECT--</option>
<?php
                                    $desig="SELECT * FROM `designation`";
                                    $result = mysqli_query($connection,$desig);
                                    while( $row_desig = mysqli_fetch_array($result))
                                    {
                      ?>
                                  <option value="<?php echo $row_desig["desig_id"];?>"<?php if($row_desig["desig_id"]==$row["designation"]) {echo 'selected'; }?>><?php echo $row_desig["Designation"];?></option>
                  <?php } ?>
                         </select>
                       </div>
                  </div>
                 <div class="form-group row">
                   <label for="fname"class="col-sm-3 text-end control-label col-form-label">TYPE</label>
                     <div class="col-md-6">
                      <select class="form-control" name="TYPE" id="TYPE">
                        <option value="NA">--SELECT--</option>
                        <?php 
                                    $site_row="SELECT * FROM `sites`";
                                    $result = mysqli_query($connection,$site_row);
                                    while( $row_site= mysqli_fetch_array($result))
                                    {
                      ?>
                                  <option value="<?php echo $row_site["Id"];?>"<?php if($row_site["Id"]==$row["TYPE"]) {echo 'selected'; }?>><?php echo $row_site["sites"];?></option>
                  <?php } ?>
                       </select>
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="fname"class="col-sm-3 text-end control-label col-form-label">District</label>
                      <div class="col-md-6">
                       <select class="district form-select shadow-none mt-3" name="district[]" id="district" multiple="multiple"  style="height: 36px; width: 100%">
                          <option value="NA">--SELECT--</option>
                          <?php 
                                    $districts="SELECT * FROM `districts` where `status`=1";
                                    $result = mysqli_query($connection,$districts);
                                    while( $row_districts = mysqli_fetch_array($result))
                                    {
                      ?>
                                  <option value="<?php echo $row_districts["Id"];?>"<?php if(in_array($row_districts["Id"],$district_nam)) {echo 'selected'; }?>><?php echo $row_districts["district_name"];?></option>
                  <?php } ?>
                         </select>
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="fname"class="col-sm-3 text-end control-label col-form-label">City</label>
                      <div class="col-md-6">
                       <select class="city form-select shadow-none mt-3"  name="city[]" id="city" multiple="multiple"  style="height: 36px; width: 100%">
                          <option value="NA">--SELECT--</option>
                          <?php 
                                    $cities="SELECT * FROM `cities`";
                                    $result = mysqli_query($connection,$cities);
                                    while( $row_cities = mysqli_fetch_array($result))
                                    {
                      ?>
                                  <option value="<?php echo $row_cities["city_id"];?>"<?php if(in_array($row_cities["city_id"],$city_nam)) {echo 'selected'; }?>><?php echo $row_cities["city_name"];?></option>
                  <?php } ?>
                         </select>
                        </div>
                      </div>
                     
                     </div>
                      <div class="border-top">
                      <div class="card-body">
                      <button type="submit" name="submit"  id="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                  </div>
                </form>
              </div>
           </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
<style>
  .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    color: black;
}
</style>
 <!-- ==============footer========== -->
<?php include 'footer.php';?>
<!-- ==============footer========== -->
<script>
      //***********************************//
      // For select 2
      //***********************************//
      $(".select2").select2();

      $(".district").select2();
      $(".city").select2();
      

      /*colorpicker*/
      $(".demo").each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr("data-control") || "hue",
          position: $(this).attr("data-position") || "bottom left",

          change: function (value, opacity) {
            if (!value) return;
            if (opacity) value += ", " + opacity;
            if (typeof console === "object") {
              console.log(value);
            }
          },
          theme: "bootstrap",
        });
      });
      /*datwpicker*/
      jQuery(".mydatepicker").datepicker();
      jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
      });
      var quill = new Quill("#editor", {
        theme: "snow",
      });
    </script>
    

