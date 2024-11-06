<?php
session_start();
header('Content-Type: application/json');// For JSON responses.

// database connection file
include '../connection.php';

// Ensuring session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Checking if user is logged in.
// if (!isset($_SESSION['PFC_UID'])) {
//     $response = [
//         'success' => false,
//         'message' => 'User not authenticated'
//     ];
//     echo json_encode($response);
//     exit();
// }

// Perform the query
$query = "SELECT 
            r.`role_id`, 
            r.`user_id`, 
            r.`role_name`, 
            r.`designation`, 
            r.`TYPE`, 
            r.`district`, 
            r.`city`, 
            r.`permission`,
            d.`Id`,
            d.`district_name`,
            d.`status`
          FROM 
            `roles` r
          LEFT JOIN 
            `districts` d ON r.`district` = d.`Id` 
          WHERE 
            r.`user_id`='" . $_GET['PFC_UID'] . "'";
//$_SESSION['PFC_UID']
$result = mysqli_query($connection, $query);

if (!$result) {
    $response = [
        'success' => false,
        'message' => 'Query execution failed'
    ];
    echo json_encode($response);
    exit();
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$response = [
    'success' => true,
    'data' => $data
];

echo json_encode($response);
?>
