<?php
header('Content-Type: application/json');// For JSON responses.
//database connection file
include '../connection.php';

if (isset($_GET['cityId'])) {
    $cityId = $_GET['cityId'];

    // Fetch data based on the given city ID.
    $query = "SELECT 
                `Id`, 
                `Vertical_POP_Code`, 
                `Division_Name`, 
                `Division_Code`, 
                `Block_Name`, 
                `Block_Code`, 
                `Vertical_PoP_Level`, 
                `POP_Location`, 
                `Router_Host_Name`, 
                `Router_Asset_ID`, 
                `Router_For_Vertical_Site_Serial_No`, 
                `Router_For_Vertical_Site_Qty` 
              FROM `dhq_inventory_with_assetid`"; 
//WHERE `city_id`='$cityId'
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                'Id' => $row['Id'],
                'Vertical_POP_Code' => $row['Vertical_POP_Code'],
                'Division_Name' => $row['Division_Name'],
                'Division_Code' => $row['Division_Code'],
                'Block_Name' => $row['Block_Name'],
                'Block_Code' => $row['Block_Code'],
                'Vertical_PoP_Level' => $row['Vertical_PoP_Level'],
                'POP_Location' => $row['POP_Location'],
                'Router_Host_Name' => $row['Router_Host_Name'],
                'Router_Asset_ID' => $row['Router_Asset_ID'],
                'Router_For_Vertical_Site_Serial_No' => $row['Router_For_Vertical_Site_Serial_No'],
                'Router_For_Vertical_Site_Qty' => $row['Router_For_Vertical_Site_Qty']
            ];
        }

        $response = [
            'success' => true,
            'data' => $data
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error fetching data: ' . mysqli_error($connection)
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'success' => false,
        'message' => 'City ID not provided'
    ];
    echo json_encode($response);
}
?>
