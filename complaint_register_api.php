<?php
error_reporting(0);
session_start();
include 'Connection.php';
date_default_timezone_set('Asia/Kolkata');
$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["submit"])) {
        // Your existing code to handle form submission
        $DID = $_REQUEST['DID'];

        $asset_router=$_POST["Router_Asset_ID"];
        $Router_Asset=implode(",",$asset_router);
        // $asset_router = $_POST["Router_Asset_ID"];
        $complaint_remarks = $_POST["complaint_remarks"];
        $complaint_register_date = date('Y-m-d');
        $complaint_status = $_POST['complaint_status'];
        $created_on = date('Y-m-d H:i:s');

        // Your SQL query to insert the complaint into the database
      echo   $insert_complaint = "INSERT INTO `complaints`(`DID`,`Router_Asset_ID`, `complaint_remarks`, `complaint_register_date`, `complaint_status`, `Created_on`) 
        VALUES ('$DID','$Router_Asset','$complaint_remarks','$complaint_register_date','$complaint_status','$created_on')";

        if ($connection->query($insert_complaint) === TRUE) {
            // Get the auto-incremented ID of the last inserted complaint
            $lastInsertedId = $connection->insert_id;

            // Generate the complaint number by combining the prefix 'LTS' and the auto-incremented ID
            $complaintNumber = 'LTS' . $lastInsertedId;

            // Update the complaint number in the database
            $update_complaint_number = "UPDATE `complaints` SET `complaint_number`='$complaintNumber' WHERE `Id`='$lastInsertedId'";
            $connection->query($update_complaint_number);

            // Set the success message in the response
            $response['status'] = 'success';
            $response['message'] = 'Complaint registered successfully';
            $response['complaint_number'] = $complaintNumber;
        } else {
            // Set the error message in the response
            $response['status'] = 'error';
            $response['message'] = "Error: " . $insert_complaint . "<br>" . $connection->error;
        }
    } else {
        // Invalid request, no 'submit' parameter found
        $response['status'] = 'error';
        $response['message'] = 'Invalid request';
    }
}

$_SESSION['message']=$response['message'];
$_SESSION['complaint_number']=$response['complaint_number'];
//echo json_encode($response); // Return the JSON response

if(!empty($response['status']))
{
    header("location:complaint_register.php?Mgs=1&message=".$_SESSION['message']."&complaint_number=".$_SESSION['complaint_number']);
}
?>