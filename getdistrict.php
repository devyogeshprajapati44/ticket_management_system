<?php
// session_start();
// // Database connection
// include 'connection.php';
// $user_id=$_SESSION['PFC_UID'];
// // Fetch cities from database
// //$query = "SELECT * FROM `cities` WHERE `district_id` != ''";
// //$query = "SELECT * FROM `districts`";
// $query = "SELECT 
//                 r.`role_id`, 
//                 r.`user_id`, 
//                 r.`role_name`, 
//                 r.`designation`, 
//                 r.`TYPE`, 
//                 r.`district`, 
//                 r.`city`, 
//                 r.`permission`,
//                 d.`Id`,
//                 d.`district_name`,
//                 d.`status`
//             FROM 
//             `roles` r
//             LEFT JOIN `districts` d ON r.`district` = d.`Id` where r.`user_id`='".$_SESSION['PFC_UID']."'";
// $result = mysqli_query($connection, $query);

// if ($result) {
//     $cities = []; // Initialize an empty array to hold cities
//     while ($row = mysqli_fetch_assoc($result)) {
//         $cities[] = $row; // Append each row to the $cities array
//     }
//     echo '<table id="districtsTable"><thead><tr><th>District</th></tr></thead><tbody>';
//     //Output cities as HTML
//     foreach ($cities as $city) 
//     {
//       //echo "<div class='city' style='cursor: pointer;' data-cityid='{$city['Id']}'>{$city['district_name']}</div>";
//         echo "<div class='city' style='cursor: pointer;' data-districtid='{$city['Id']}'>{$city['district_name']}</div>";
//     }
//     echo '</tbody></table>';
// } else {
//     echo "Error fetching cities:" . mysqli_error($connection);
// }

session_start();
// Database connection
include 'connection.php';
$user_id = $_SESSION['PFC_UID'];
// Fetch cities from database
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
            r.`user_id`='" . $_SESSION['PFC_UID'] . "'";
$result = mysqli_query($connection, $query);

if ($result) {
    echo '<table id="districtsTable"><thead><tr><th>District</th></tr></thead><tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>";
        $districts = explode(',', $row['district']); // Explode the district value
        foreach ($districts as $district_id) {
            // Fetch district name based on the district ID
            $query_district = "SELECT `district_name` FROM `districts` WHERE `Id`='$district_id'";
            $result_district = mysqli_query($connection, $query_district);
            $row_district = mysqli_fetch_assoc($result_district);
            
            $district_name = isset($row_district['district_name']) ? $row_district['district_name'] : 'Unknown'; // Fallback if district name not found
            
            $isSelected = in_array($district_id, $districts) ? 'selected' : ''; // Check if the district is in the exploded array
            echo "<div class='city $isSelected' style='cursor: pointer;' data-districtid='{$row['Id']}'>$district_name</div>";
        }
        echo "</td></tr>";
    }
    echo '</tbody></table>';
} else {
    echo "Error fetching districts:" . mysqli_error($connection);
}
?>
