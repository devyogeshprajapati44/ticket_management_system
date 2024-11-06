<?php 
/******* 
 * Role Assign In this will page we get the Data from Add_user page and insert the data of Both form 
 * add_user adn role assign.
******/

//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Avoid any output before setting headers
ob_start(); // Start output buffering
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
$message='';
//For role table data.
if(isset($_POST["submit"]))
{
//For user table data.
if(isset($_GET['names'])) 
{
    $name     = rawurldecode($_GET['names']);//Get the name from the URL,here we have use rawurldecode tooo get data from URL as it is.
    $username = rawurldecode($_GET['usernames']);//Get the usernames from the URL,here we have use rawurldecode tooo get data from URL as it is.
    $password = rawurldecode($_GET['password']);//Get the password from the URL,here we have use rawurldecode tooo get data from URL as it is.
    $options  = array("cost"=>4);
    $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);//BCRYPT the Password for security purpose.
    $emp_status   = 1; //employee status means is Active.
    //echo "Hello, $name!";
    $add_user="INSERT INTO `employee`(`emp_name`,`username`, `password`, `original_password`,`emp_status`)VALUES('$name','$username','$hashPassword','$password','$emp_status')";
    $run_Sub = mysqli_query($connection,$add_user);
    $last_id = mysqli_insert_id($connection);
} 
else 
{
    echo "No name received.";
}
//For user table data.
    $USER_ID=$last_id;     //Last inserted Id saved in the variable from the add_user data.
    $role_name=$_POST["rolenames"];   //Role names from the role  assign Form.
    $designation=$_POST["designation"]; //Designation from the role  assign Form.
    $TYPE=$_POST["TYPE"]; //Type from the role  assign Form.
    $districts=$_POST["district"]; //District from the role  assign Form.
    $cities=$_POST["city"]; //city from the role  assign Form.
    $permission=1; //Permission for Role assign data means permission is granted.


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
  $role_assign="INSERT INTO `roles`(`user_id`, `role_name`, `designation`, `TYPE`, `district`, `city`,`permission`) VALUES ('$USER_ID','$commaSeparated_Role_multi','$designation','$TYPE','$commaSeparated_districts_multi','$commaSeparated_cities_multi','$permission')";
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
    header("Location: role_assign.php?Mgs=1");
    ob_end_flush(); // Send the output buffer and redirect
    exit(); // Ensure no further code executes after the redirection
}
?>

<?php //include 'sidebar.php';?>
<style>
  .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    color: black;
}
</style>

      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <!-- <h4 class="page-title">Role Assign</h4> -->
              <a href="add_user.php" alt="add_user" class="btn btn-primary">BACK</a><br/><br/>
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
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
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
          <h4 class="page-title">Role Assign</h4>
          <div class="row">
            <div class="col-md-12">

              <div class="card">
                <form class="form-horizontal" method="POST">
                  <div class="card-body">
                    <h4 class="card-title">Role Assign</h4>
                    <div class="form-group row">
                    <label class="col-md-3 mt-3">Role Name</label>
                      <div class="col-md-6">
                       <select class="select2 form-select shadow-none mt-3"  name="rolenames[]" multiple="multiple"  style="height: 36px; width: 100%">
                              <option value="NA">--SELECT--</option>
                                <option value='DHQ'>DHQ</option>
                                <option value='BHQ'>BHQ</option>
                                <option value='SHQ'>SHQ</option>
                                <option value='GP'>GP</option>
                         </select>
                      </div>
                    </div>
                  <div class="form-group row">
                      <label class="col-md-3 mt-3">Designation</label>
                        <div class="col-md-6">
                         <select class="form-control" name="designation" id="designation" >
                          <option value="NA">--SELECT--</option>
                          <option value="2">SITE ENGINEER</option>
                          <option value="3">NETWORK ENGINEER</option>
                         </select>
                       </div>
                  </div>

                 <div class="form-group row">
                   <label class="col-md-3 mt-3">TYPE</label>
                          <div class="col-md-6">
                          <select class="form-control" name="TYPE" id="TYPE">
                            <option value="NA">--SELECT--</option>
                            <option value="DHQ">DHQ</option>
                            <option value="SHQ">SHQ</option>
                            <option value="BHQ">BHQ</option>
                            <option value="GP">GP</option>
                    </select>
                      </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-3 mt-3">District</label>
                      <div class="col-md-6">
                       <select class="district form-select shadow-none mt-3" name="district[]" id="district" multiple="multiple"  style="height: 36px; width: 100%">
                                 <option value="NA">--SELECT--</option>
                                  <option value="1">Jaipur</option>
                                  <option value="2">Jodhpur</option>
                         </select>
                      </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-3 mt-3">CITY</label>
                      <div class="col-md-6">
                       <select class="city form-select shadow-none mt-3"  name="city[]" id="city" multiple="multiple"  style="height: 36px; width: 100%">
                            <option value="NA">--SELECT--</option>
                            <option value="1">Jaipur</option>
                            <option value="2">Jodhpur</option>
                         </select>
                      </div>
                    </div>
                   </div>
                   <div class="border-top">
                    <div class="card-body">
                    <button type="submit" name="submit"  id="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
         </div>
      </div>

    <!-- ========================Footer========================= -->
    <?php include 'footer.php';?>
     <!-- ========================Footer========================= -->
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
    
 
