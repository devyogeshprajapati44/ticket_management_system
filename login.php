<?php
session_start();
include 'connection.php';

if(isset($_POST['submit']))
{
  //$UserName =  trim(strtoupper($_POST['username']));
  $UserName     =  trim($_POST['email']);
  $UserPassword =  trim($_POST['password']);
  //echo $qry = "SELECT * FROM `employee` where `username`='$UserName' and `password`='$UserPassword' and `emp_status`='active'";
  $qry   = "SELECT * FROM `employee` where `username`='$UserName' and `emp_status`='1'";
  //die;
  $run   = mysqli_query($connection,$qry);
  $count = mysqli_num_rows($run); 

  //echo $qry2   = "SELECT `emp`.*,`rol`.* FROM `employee` `emp` LEFT JOIN `roles` `rol` ON `emp`.`Id`=`rol`.`user_id` where `emp`.`username`='$UserName' and `emp`.`emp_status`='1'";
  //$run2   = mysqli_query($connection,$qry2);
  
  if($count == 1)
  //if($count)
  {
      $row = mysqli_fetch_array($run);
    if(password_verify($UserPassword,$row['password']))   //Checking Password Encrypted form using password_verify() method.
  //if($UserPassword == $row['original_password'])
      {
        $User_Id=$row['Id'];
        $user_name=$row['username'];
        $Emp_Id=$row['emp_code'];
        $Emp_Name=$row['emp_name'];
        //$role_id=$row['role_id'];
        $User_status=$row['emp_status'];

          $_SESSION['username']=$user_name;
          $_SESSION['PFC_UID']=$User_Id;
          $_SESSION['PFC_EmpName']=$Emp_Name;
          //$_SESSION['PFC_EmpRole']=$role_id;
          $_SESSION['PFC_EmpStatus']=$User_status;
          $_SESSION['PFC_EmpID']=$Emp_Id;
          $LoginTime = $_SERVER['REQUEST_TIME'];
          $_SESSION['LAST_ACTIVITY'] = $LoginTime;
          $LoginIpAddress = getenv('REMOTE_ADDR');
          $_SESSION['IpAddress']=$LoginIpAddress;
                    
            if($count == 1) 
              { 
                $_SESSION["loggedin"]=true;
                header('location:dashboard.php');
                //header('location:PFC.php');
                //echo '<script>alert("you are logged in");</script>';?EmployeeName='.$_SESSION['PFC_EmpName'];
              }                  
          }
          else 
          {
              //echo '<script>alert("User Name And Password Not Match.");</script>'; 
              //header("location:login.php?Mgs=1");
              //$error_message="<p style='margin-left: 41px;color: red;'>UserName And Password Not Match.</p>";
              header("location:login.php?Mgs=1");
          }

    }
    else
    {
      //$error_message="<p style='margin-left: 41px;color: red;'>UserName And Password Are Not Match.</p>";
      header("location:login.php?Mgs=1");
    }    
}
?>

<!DOCTYPE html>
<html dir="ltr">
  <head>

    <title>TMS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logoo.png"/>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-4/assets/css/login-4.css" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
	<script src="js/jquery-1.10.2.min.js"></script>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
    <style>
      body 
       {
           background-image: url("assets/images/tms_image.jpg");
           background-size: cover; /* Makes the background image cover the entire container */
           background-position: center; /* Centers the background image */
       }
       .button {
       width: 16%;
       margin-left: 233px;
       }
       @media (min-width: 1400px){
     .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
         max-width: 1600px;
         max-height: 2000px;
         margin-top: 17px;
     }
     .h-100 {
         height: 48%!important;
     }
     .login input[type="submit"] {
         font-size: 20px;
         font-weight: 400;
         color: #fff;
         outline: none;
         padding: 10px 15px;
         background: url("assets/images/icons.png") no-repeat 13px -33px;
         width: 58%;
         border: 2px solid #ea4c89;
         background: #8d35c5;
         margin-left: 250px;
       }
     }
     .login input[type="text"]
     {
        background: url("assets/images/iconsimh.jpg") no-repeat 13px -33px;   
        width: 157%;
        padding: 0.9em 1em 0.9em 4em;
        color: #777;
        font-size: 15px;
        outline: none;
        font-weight: 400;
        border: 1px solid #ddd;
        margin: 0.3em 0;
        font-family: 'Roboto', sans-serif;
        margin-left: 65px;
     }

     .login input[type="password"] {
          background: url("assets/images/icons.png") no-repeat 13px -33px;   
          width: 157%;
         padding: 0.9em 1em 0.9em 4em;
         color: #777;
         font-size: 15px;
         outline: none;
         font-weight: 400;
         border: 1px solid #ddd;
         margin: 0.3em 0;
         font-family: 'Roboto', sans-serif;
         margin-left: 65px;
     }
     .field-icon {
       float: right;
         margin-top: -29px;
         margin-right: -331px;
         position: relative;
         z-index: 2;
     }
     .field-icons {
       float: right;
         margin-top: -31px;
         margin-right: 398px;
         position: relative;
         z-index: 2;
     }
     .container{
       padding-top:50px;
       margin: auto;
     }
      </style>
  </head>

  <body>
    <section class="p-3 p-md-4 p-xl-5">
          <div class="col-8 col-md-6" style="margin-right:-97px;">
              <img class="img-fluid rounded-start w-200 h-100 " loading="lazy" src="assets/images/light_blue_image.jpg" alt="" style="width:664px; margin-top: 145px;"><br>
               </div>
      <div class="container"><br><br><br>
  
              <div class="card border-light-sum" style="height:443px;margin-left: 556px; margin-top: -554px;">
                <div class="row g-0" >
                   <div class="col-12 col-md-6">
                 <div class="login">
                    <div class="buttons login">
                    <h3 class="inner-tittle t-inner" style="color:black;margin-left: 179px;margin-top: 31px;">Ticket Management System</h3><br><br><br>
                       </div>
                       <?php //echo $_SERVER['PHP_SELF']?>
                        <form method="POST"> 
                        <input type="text" name="email" class="form-control" id="email" required>
                          <span toggle="#password-field" class="fa fa-user field-icons" style="font-size:20px;color:red"></span>
                          
                           <br><br>
                           <input type="password" name="password" class="form-control" id="yourPassword" required>
                             <span toggle="#password-field" class="fas fa-lock field-icons toggle-password" style="font-size:20px;color:red"></span>
                              
                                 <div class="submit">
                              <input type="submit" style="margin-top: 17px;"  class="button"  value="Login" name="submit" ></div>
                              <div class="clearfix"></div>
                              <div class="new">
                          <!-- <a href="forgot-password.php">Forgot Password</a>&nbsp;&nbsp;
                          <a href="../index.php" >Back Home!!</a> -->
                           <div class="clearfix"></div>
                        </div>
                       </form>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
      $(".toggle-password").click(function() {
      
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "Password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "Password");
      }
      });
        </script>
  </body>
</html>
