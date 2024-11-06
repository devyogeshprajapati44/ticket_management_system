<?php
/******* 
 
 * Add_user page.

 * In this page we will add the New user and it data will goes too role_assign page. 

******/
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
?>
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">ADD USER</h4>
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
              <form action="role_assign.php" method="GET">
                  <div class="card-body">
                    <h4 class="card-title">ADD USER</h4>
                    <div class="form-group row">
                      <label for="fname"class="col-sm-3 text-end control-label col-form-label">Name</label >
                      <div class="col-sm-6">
                     
                      <input type="text" class="form-control" placeholder="Name" name="names" id="names">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  for="lname" class="col-sm-3 text-end control-label col-form-label">User Name</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="UserName" name="usernames" id="usernames">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="lname"  class="col-sm-3 text-end control-label col-form-label" >Password</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="Password" name="password" id="password">
                      </div>
                    </div>
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                    <button type="submit" name="submit"  id="submit" class="btn btn-primary">NEXT</button>
                    </div>
                  </div>
                </form>
              </div>
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php include 'footer.php';?>
    <script>
      // Basic Example with form
      var form = $("#example-form");
      form.validate({
        errorPlacement: function errorPlacement(error, element) {
          element.before(error);
        },
        rules: {
          confirm: {
            equalTo: "#password",
          },
        },
      });
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
        },
        onFinishing: function (event, currentIndex) {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex) {
          alert("Submitted!");
        },
      });
    </script>

