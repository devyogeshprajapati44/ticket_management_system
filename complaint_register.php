<?php
include 'Connection.php';
include 'complaint_register_api.php';
date_default_timezone_set('Asia/Kolkata');


//header('Content-Type: application/json'); // Set content type to JSON

// $response = array(); // Initialize response array

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST["submit"])) {
//         // Your existing code to handle form submission
//         $DID = $_REQUEST['DID'];
//         $divison_code = $_POST["divison_code"];
//         $complaint_remarks = $_POST["complaint_remarks"];
//         $complaint_register_date = date('Y-m-d');
//         $complaint_status = 'PENDING';
//         $created_on = date('Y-m-d H:i:s');

//         // Your SQL query to insert the complaint into the database
//         $insert_complaint = "INSERT INTO `complaints`(`DID`,`divison_code`, `complaint_remarks`, `complaint_register_date`, `complaint_status`, `Created_on`) 
//         VALUES ('$DID','$divison_code','$complaint_remarks','$complaint_register_date','$complaint_status','$created_on')";

//         if ($connection->query($insert_complaint) === TRUE) {
//             // Get the auto-incremented ID of the last inserted complaint
//             $lastInsertedId = $connection->insert_id;

//             // Generate the complaint number by combining the prefix 'LTS' and the auto-incremented ID
//             $complaintNumber = 'LTS' . $lastInsertedId;

//             // Update the complaint number in the database
//             $update_complaint_number = "UPDATE `complaints` SET `complaint_number`='$complaintNumber' WHERE `Id`='$lastInsertedId'";
//             $connection->query($update_complaint_number);

//             // Set the success message in the response
//             $response['status'] = 'success';
//             $response['message'] = 'Complaint registered successfully';
//             $response['complaint_number'] = $complaintNumber;
//         } else {
//             // Set the error message in the response
//             $response['status'] = 'error';
//             $response['message'] = "Error: " . $insert_complaint . "<br>" . $connection->error;
//         }
//     } else {
//         // Invalid request, no 'submit' parameter found
//         $response['status'] = 'error';
//         $response['message'] = 'Invalid request';
//     }
// }

// //echo json_encode($response); // Return the JSON response


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" BACKGROUND="dist/img/BG1.webp">
<?php
if(isset($_REQUEST["Mgs"])){
    $Mgs=$_REQUEST["Mgs"];
    if($Mgs==1){
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><i class="bi bi-check"></i> Success !</span><?php echo $_REQUEST['message'].' and You Complaint Number is '.$_REQUEST['complaint_number'];?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
    }
}
?>

<?php 
//echo $response['message'].' and You Complaint Number is '.$response['complaint_number'];
//if(!empty($response['message'])){
?>
    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><i class="bi bi-check"></i> Success !</span><?php //echo $response['message'].' and You Complaint Number is '.$response['complaint_number'];?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> -->
    <?php //}?> 
<div class="login-box">
    <!-- /.login-logo -->
    <a href="Report_1.php?DID=103" class="btn btn-primary"> BACK </a><br/><br/>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="main" class="h1"><b style="font-size: 27px;">Inventory Management</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register Your Compliant Here</p>

            <form action="complaint_register_api.php?DID=103" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Divison Code" name="divison_code" id="divison_code">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control" placeholder="complaint_remarks" name="complaint_remarks" id="complaint_remarks"></textarea>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-comments"></span>
                        </div>
                    </div>
                </div>
                <!-- <div class="row"> -->
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
