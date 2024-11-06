<?php
session_start();
// Database connection
include 'connection.php';
include 'pagi_script.php';

$user_id = $_SESSION['PFC_UID'];

if (isset($_GET['city'])) {
    $cityName = $_GET['city'];
    $limit="order by `us`.`Id` LIMIT $offset, $no_of_records_per_page";
    // Fetch cities from database
    $query = "SELECT 
                routers.`Id`, routers.`Asset ID`, routers.`Name`, routers.`UserTags`, routers.`Asset Tags`, routers.`Location`, routers.`City`, routers.`District`, routers.`Location State`, routers.`Asset State`
            FROM 
                asset_network_router_switches_11813 routers
            LEFT JOIN 
                asset_air_conditioner_240 ac ON routers.UserTags = ac.UserTags
            LEFT JOIN 
                asset_desktop_computer_272 dc ON routers.UserTags = dc.UserTags
            LEFT JOIN 
                asset_diesel_generator_272 dg ON routers.UserTags = dg.UserTags
            LEFT JOIN 
                asset_idu_560 iu ON routers.UserTags = iu.UserTags
            LEFT JOIN 
                asset_ip_camera_272 ic ON routers.UserTags = ic.UserTags
            LEFT JOIN 
                asset_lnbc_560 lnbc ON routers.UserTags = lnbc.UserTags
            LEFT JOIN 
                asset_modem_1731 modem ON routers.UserTags = modem.UserTags
            LEFT JOIN 
                asset_odu_560 odu ON routers.UserTags = odu.UserTags
            LEFT JOIN 
                asset_rack_3801 rack ON routers.UserTags = rack.UserTags
            LEFT JOIN 
                asset_ups_13142 ups ON routers.UserTags = ups.UserTags
            WHERE 
                routers.UserTags = 'SHQ' and routers.City = '$cityName','$limit";
    //GROUP BY UserTags
    $result = mysqli_query($connection, $query);

    if ($result && $result->num_rows > 0) {
        echo "<table border='1' class='table'><tr>";

        // Array of column names
        $columns = ['Id', 'Asset ID', 'Name', 'UserTags', 'Asset Tags', 'Location', 'City', 'District', 'Location State', 'Asset State'];

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

<!-- =========footer============== -->
<?php include 'footer_bkp.php';?>
  <!-- =========footer============== -->
  <script>
        $(document).ready(function() {
            $('#zero_config').DataTable();
        });
    </script>

//It will bind all the district and cities acc. to BHQ Site and user's Id.

    
