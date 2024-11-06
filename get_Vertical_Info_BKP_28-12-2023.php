<?php
error_reporting(0);
// Assuming $connection is your database connection
include 'connection.php';

if (isset($_GET['cityId'])) {
    $city = $_GET['cityId']; //Getting City Id from DHQ,SHQ,BHQ,GP page using ajax request.
    
    // Fetch all cities within the given district from the cities table
    //$query = "SELECT * FROM `cities` WHERE `city_id` = '$city'";
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
     //where `District_Code`='$city'
    $result = mysqli_query($connection,$query);

    if($result) 
    {
        echo '<table id="districtsTable" class="datatablesSimple" border="1"><thead><tr><th>Id</th><th>Vertical_POP_Code</th><th>Division_Name</th><th>Division_Code</th><th>Block_Name</th><th>Block_Code</th><th>Vertical_PoP_Level</th><th>POP_Location</th><th>Router_Host_Name</th><th>Router_Asset_ID</th><th>Router_For_Vertical_Site_Serial_No</th><th>Router_For_Vertical_Site_Qty</th></tr></thead><tbody>';
        while ($row = mysqli_fetch_assoc($result)) 
        {
            echo "<tr><td data-infoid='{$row['city_id']}'>{$row['Id']}</td><td>{$row['Vertical_POP_Code']}</td><td>{$row['Division_Name']}</td><td>{$row['Division_Code']}</td><td>{$row['Block_Name']}</td><td>{$row['Block_Code']}</td><td>{$row['Vertical_PoP_Level']}</td><td>{$row['POP_Location']}</td><td>{$row['Router_Host_Name']}</td><td>{$row['Router_Asset_ID']}</td><td>{$row['Router_For_Vertical_Site_Serial_No']}</td><td>{$row['Router_For_Vertical_Site_Qty']}</td></tr>";
        }
        echo '</tbody></table>';
    } 
    else 
    {
        echo "Error fetching cities in the district: " . mysqli_error($connection);
    }
}
?>
