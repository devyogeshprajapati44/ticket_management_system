<?php
header('Content-Type: application/json'); // For JSON responses.

//database connection file.
include '../connection.php';

if (isset($_GET['districtId'])) {
    $districtId = $_GET['districtId'];

    // Fetch all cities within the given district from the cities table.
    $query = "SELECT * FROM `cities` WHERE `district_id`='$districtId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $citiesData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $citiesData[] = [
                'city_id' => $row['city_id'],
                'city_name' => $row['city_name']
            ];
        }

        $response = [
            'success' => true,
            'data' => $citiesData
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error fetching cities in the district: ' . mysqli_error($connection)
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'success' => false,
        'message' => 'District ID not provided'
    ];
    echo json_encode($response);
}
?>
