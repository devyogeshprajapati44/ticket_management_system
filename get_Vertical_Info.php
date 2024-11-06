<?php
error_reporting(0);
// Assuming $connection is your database connection
include 'connection.php';

if (isset($_GET['cityId'])) {
    $cityName = $_GET['cityId']; //Getting City Id from DHQ,SHQ,BHQ,GP page using ajax request.
    $sitename = $_GET['sites'];
    // Fetch all cities within the given district from the cities table
    //$query = "SELECT * FROM `cities` WHERE `city_id` = '$city'";
   $query = "SELECT `Id`,`Asset ID`, `Name`, `UserTags`,`Asset Tags`, `Category`, `Serial Number`, `Make`, `Model`,`Location`,`City`,`District`, `Location State`
   FROM (
   SELECT `Id`, `Asset ID`, `Name`,`UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`,`Location State`
   FROM `asset_air_conditioner_240`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`,`Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`, `Make`, `Model`,`Location`, `City`, `District`,`Location State`
   FROM `asset_desktop_computer_272`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_diesel_generator_272`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_idu_560`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_ip_camera_272`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_lnbc_560`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_modem_1731`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_odu_560`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_rack_3801`
   WHERE City = '$cityName'
   UNION
   SELECT `Id`, `Asset ID`, `Name`, `UserTags`,`Asset Tags`,`Category`,`Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location State`
   FROM `asset_ups_13142`
   WHERE City = '$cityName'
   -- Add similar SELECT statements for other tables
   UNION
   SELECT `Id`, `Asset_ID` as `Asset ID`, `Name`,`User_Tags` as `UserTags`,`Asset_Tags` as `Asset Tags`,`Category`,`Serial_Number` as `Serial Number`,`Make`, `Model`,`Location`, `City`, `District`, `Location_State` as `Location State`
   FROM `asset_ip_phone_272`
   WHERE City = '$cityName'
   ) AS combined_tables
   WHERE UserTags='$sitename'";
     //where `District_Code`='$city'
    $result = mysqli_query($connection,$query);
$counter=1;

    if($result) 
    {
        echo '<table id="districtssTable"  style="margin-left:-19px;" class="datatablesSimple" border="1" ><thead><tr><th style="background:black;color:white;">Id</th><th style="background:black;color:white;">Asset ID</th><th style="background:black;color:white;">Name</th><th style="background:black;color:white;">UserTags</th><th style="background:black;color:white;">Asset Tags</th><th style="background:black;color:white;">Category</th><th style="background:black;color:white;">Serial Number</th><th style="background:black;color:white;">Make</th><th style="background:black;color:white;">Model</th><th style="background:black;color:white;">Location</th><th style="background:black;color:white;">City</th><th style="background:black;color:white;">District</th><th style="background:black;color:white;">Location State</th></tr></thead><tbody>';        while ($row = mysqli_fetch_assoc($result)) 
        {
            echo "<tr ><td data-infoid='{$row['city_id']}'>{$counter}</td><td>{$row['Asset ID']}</td><td>{$row['Name']}</td><td>{$row['UserTags']}</td><td>{$row['Asset Tags']}</td><td>{$row['Category']}</td><td>{$row['Serial Number']}</td><td>{$row['Make']}</td><td>{$row['Model']}</td><td>{$row['Location']}</td><td>{$row['City']}</td><td>{$row['District']}</td><td>{$row['Location State']}</td></tr>";
            $counter++; 
        }
        echo '</tbody></table>';
    } 
    else 
    {
        echo "Error fetching cities in the district: " . mysqli_error($connection);
    }
}
?>

<script>
 new DataTable('#districtssTable');
</script>