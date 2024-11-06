<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../connection.php"; // database connection file.

header('Content-Type: application/json'); // For JSON responses.

if(isset($_POST['email']) && $_POST['password']!="") 
{
    $UserName =  trim($_POST['email']);
    $UserPassword =  trim($_POST['password']);
    
    $UserName = mysqli_real_escape_string($connection, $UserName);
    $UserPassword = mysqli_real_escape_string($connection, $UserPassword);

    $qry = "SELECT * FROM `employee` WHERE `username`='$UserName' AND `emp_status`='1'";
    $run = mysqli_query($connection, $qry);
    $count = mysqli_num_rows($run);

    if($count == 1) {
        $row = mysqli_fetch_array($run);
        if(password_verify($UserPassword, $row['password'])) {
            // Authentication successful
            $response = array(
                'success' => true,
                'message' => 'Login successful'
                // Add any additional data you want to send back
            );
        } else {
            // Incorrect password
            $response = array(
                'success' => false,
                'message' => 'Incorrect password'
            );
        }
    } else {
        // Username not found
        $response = array(
            'success' => false,
            'message' => 'Username not found'
        );
    }

    mysqli_close($connection);

    echo json_encode($response);
}
?>
