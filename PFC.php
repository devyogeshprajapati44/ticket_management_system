<?php
//This is a Header page.
include_once 'connection.php';
session_start();
date_default_timezone_set("Asia/Kolkata");
// include_once 'Session.php';

// if(isset($_REQUEST['PageName']))
// {
//     $PageName=$_REQUEST['PageName'];
//     $PageName=explode("?",$PageName);
//     $PageName= $PageName[0];
//     $PageName=$PageName.".php";
//     $file_pointer = "./Pages/$PageName";
//     if (file_exists($file_pointer)) {
//     }else {
//         $PageName="404.php";
//     }
// }elseif(!(isset($_REQUEST['PageName']))){
//     $PageName="dashboard.php";
// }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta
      name="description"
      content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>TMS</title>
    <!-- Favicon icon -->
    <linkrel="icon" type="image/png" sizes="16x16" href="./assets/images/logoo.png" />
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" type="text/css"  href="assets/libs/jquery-minicolors/jquery.minicolors.css"/>
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"/>

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.5.0/responsive.bootstrap4.css">

    <!-- <link href="dist/css/fstdropdown.css" rel="stylesheet" />
    <link href="dist/css/fstdropdown.min.css" rel="stylesheet" />
    <link href="dist/css/select2.min.css" rel="stylesheet" /> -->
    
  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div  id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" style="background: darkcornflowerblue;">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="dashboard.php"  style="background: darkblue;">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="assets/images/logoo.png" alt="homepage" class="light-logo"  width="25"/>
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2" style="font-size: 15px;">
                <!-- dark Logo text -->
                <!-- TMS1 -->
                Ticket Management System
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
              <ul class="navbar-nav float-start me-auto">
                  <li class="nav-item d-none d-lg-block">
                     <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                      <i class="mdi mdi-menu font-24"></i>
                    </a>
                  </li>
                </ul>
              
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
             
                  
            
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            
                 <a class=" nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                      href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="assets/images/logoo.png" alt="user" class="rounded-circle" width="31"/>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown" >
                  <b style="margin-left: 52px;">WELCOME :- </b><?php echo $_SESSION["PFC_EmpName"];?>
                  <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="login.php"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                 </ul>
                </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->