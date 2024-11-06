<?php
// Database connection
// include 'connection.php';

// if (isset($_GET['cityId'])) {
//     $cityId = $_GET['cityId'];
//     // Fetch districts for the selected city from the database based on cityId
//     $query = "SELECT * FROM `cities` WHERE `city_id` = $cityId";
//     $result = mysqli_query($connection, $query);

//     if ($result) {
//         echo '<h3>Districts</h3><ul>';
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo "<li>{$row['district']}</li>";
//         }
//         echo '</ul>';
//     } else {
//         echo "Error fetching districts: " . mysqli_error($connection);
//     }
// }


// Database connection
// include 'connection.php';

// if (isset($_GET['cityId'])) {
//     $cityId = $_GET['cityId'];
//     // Fetch districts for the selected city from the same table based on cityId
//     $query = "SELECT * FROM `cities` WHERE `district` = (SELECT `city_name` FROM `cities` WHERE `city_id` = $cityId)"; // Filtering for districts
//     $result = mysqli_query($connection, $query);

//     if ($result) {
//         echo '<table id="districtsTable" class="datatablesSimple" border="1"><thead><tr><th>District</th></tr></thead><tbody>';
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo "<tr><td>{$row['city_name']}</td></tr>";
//         }
//         echo '</tbody></table>';
//     } else {
//         echo "Error fetching districts: " . mysqli_error($connection);
//     }
// }

// Database connection
// include 'connection.php';

// if (isset($_GET['district'])) {
//     $districtName = $_GET['district'];
    
//     // Fetch all cities within the given district
//     $query = "SELECT * FROM `cities` WHERE `district` = '$districtName'";
//     $result = mysqli_query($connection, $query);

//     if ($result) {
//         echo '<table id="districtsTable" class="datatablesSimple" border="1"><thead><tr><th>City</th></tr></thead><tbody>';
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo "<tr><td>{$row['city_name']}</td></tr>";
//         }
//         echo '</tbody></table>';
//     } else {
//         echo "Error fetching cities in the district: " . mysqli_error($connection);
//     }
// }


include 'connection.php';

if (isset($_GET['districtId'])) {
    $districtId = $_GET['districtId'];
    
    // Fetch all cities within the given district from the cities table
    //$query = "SELECT * FROM `cities` WHERE `district_id` = (SELECT `Id` FROM `districts` WHERE `district_name` = '$districtName')";
    $query="SELECT * FROM `cities` where `district_id`='$districtId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo '<table id="districtsTable" class="datatablesSimple"  border="1"><thead><tr><th>City</th></tr></thead><tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td class='cityOne' style='cursor: pointer;' data-cityid='{$row['city_name']}'>{$row['city_name']}</td></tr>";
        }
        echo '</tbody></table>';
    } else {
        echo "Error fetching cities in the district: " . mysqli_error($connection);
    }
}
?>

