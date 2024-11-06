<?php
session_start();
// Database connection
include 'connection.php';
$user_id = $_SESSION['PFC_UID'];

if(isset($_GET['city'])) {
    $cityName = $_GET['city'];
// Fetch cities from database
$query = "SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM (
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM asset_air_conditioner_240
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM asset_desktop_computer_272
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_diesel_generator_272`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_idu_560`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_ip_camera_272`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_lnbc_560`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_modem_1731`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_odu_560`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_rack_3801`
WHERE City = '$cityName'
UNION ALL
SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
`Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
`Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
`Operational Status`, `Business Function`, `Description`, `Installation Date`, 
`Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
`Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
`Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
`Depreciation Type`, `Salvage Value`, `Currency`
FROM `asset_ups_13142`
WHERE City = '$cityName'
-- Add similar SELECT statements for other tables
UNION ALL
SELECT `Id`, `Asset_ID`, `Name`, `Owners`, `Requesters`, `User_Tags`, `Asset_Tags`, `Location`, `City`, `District`, `Location_State`, `Asset_State`, `Agent_Name`, `Category`, `State`, `Serial_Number`, `Status`, `Criticality`, `Service_Status`, `Operational_Status`, `Business_Function`, `Description`, `Installation_Date`, `Usage_Type`, `State_Change_Reason`, `Retire_Reason`, `Make`, `Model`, `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag_No`, `Uninstall_Date`, `Branch_Code`, `Branch_Name`, `Invoice_No`, `Part_No`, `Cost`, `Purchase_Date`, `Depreciation_Type`, `Salvage_Value`, `Currency`
FROM asset_ip_phone_272
WHERE City = '$cityName'
) AS combined_tables
WHERE UserTags='BHQ'
GROUP BY UserTags";
$result = mysqli_query($connection, $query);

if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr>";

    // Array of column names
    $columns = [
        'Id', 'Asset ID', 'Name', 'Owners', 'Requesters', 'UserTags', 'Asset Tags',
        'Location', 'City', 'District', 'Location State', 'Asset State', 'Agent Name',
        'Category', 'State', 'Serial Number', 'Status', 'Criticality', 'Service Status',
        'Operational Status', 'Business Function', 'Description', 'Installation Date',
        'Usage Type', 'State Change Reason', 'Retire Reason', 'Make', 'Model',
        'Manufacturer', 'Domain', 'Series', 'Vendor', 'Tag No', 'Uninstall date',
        'Branch code', 'Branch name', 'Invoice No', 'Part No', 'Cost', 'Purchase date',
        'Depreciation Type', 'Salvage Value', 'Currency'
    ];

    // Counter for Id
    $counter = 1;

    // Generating table headers
    foreach ($columns as $column) {
        echo "<th style='background-color:black;color:white;'>$column</th>";
    }
    echo "</tr>";

    // Fetching data rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>$counter</td>"; // Displaying the counter as the Id
        foreach (array_slice($columns, 1) as $column) {
            echo "<td>" . $row[$column] . "</td>"; // Skip the first column for the Id
        }
        echo "</tr>";
        $counter++; // Increment the counter for the next row
    }

    echo "</table>";
} else {
    echo "No data found";
}

// Close database connection
$connection->close();
}
?>