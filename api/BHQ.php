<?php
header('Content-Type: application/json');// For JSON responses.

// database connection file
include '../connection.php';

// Perform the query
$query = "SELECT 
                `segment` AS 'Segment',
                COUNT(*)  AS 'Total_Count',
                MAX(CASE WHEN `devices` = 'Router' THEN 'Router' END) AS 'Router',
                SUM(CASE WHEN `devices` = 'Router' AND status = 'connected' THEN 1 ELSE 0 END) AS 'Router_Connected',
                SUM(CASE WHEN `devices` = 'Router' AND status = 'Not connected' THEN 1 ELSE 0 END) AS 'Router_Not_Connected',

                MAX(CASE WHEN `devices` = 'switch' THEN 'Switches' END) AS 'Switches',
                SUM(CASE WHEN `devices` = 'switch' AND status = 'connected' THEN 1 ELSE 0 END) AS 'Switches_Connected',
                SUM(CASE WHEN `devices` = 'switch' AND status = 'Not connected' THEN 1 ELSE 0 END) AS 'Switches_Not_Connected',

                MAX(CASE WHEN `devices` = 'CPU' THEN 'CPU' END) AS 'CPU',
                SUM(CASE WHEN `devices` = 'CPU' AND status = 'connected' THEN 1 ELSE 0 END) AS 'CPU_Connected',
                SUM(CASE WHEN `devices` = 'CPU' AND status = 'Not connected' THEN 1 ELSE 0 END) AS 'CPU_Not_Connected',

                MAX(CASE WHEN `devices` = 'Webcam' THEN 'Webcam' END) AS 'Webcam',
                SUM(CASE WHEN `devices` = 'Webcam' AND status = 'connected' THEN 1 ELSE 0 END) AS 'Webcam_Connected',
                SUM(CASE WHEN `devices` = 'Webcam' AND status = 'Not connected' THEN 1 ELSE 0 END) AS 'Webcam_Not_Connected',

                SUM(CASE WHEN `segment` = 'DHQ' THEN 1 ELSE 0 END)  AS 'DHQ_Count',
                SUM(CASE WHEN `segment` = 'BHQ' THEN 1 ELSE 0 END)  AS 'BHQ_Count',
                SUM(CASE WHEN `segment` = 'SHQ' THEN 1 ELSE 0 END)  AS 'SHQ_Count',
                SUM(CASE WHEN `segment` = 'GP'  THEN 1 ELSE 0 END)  AS 'GP_Count'
            FROM 
                `segment`  where segment = 'BHQ'
            GROUP BY 
                segment";

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
