<?php
header('Content-Type: application/json');

// Include necessary files and initialize variables
include "../connection.php";

$response = [];

// Ensure that POST method is used
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Avoid any output before setting headers
    ob_start(); // Start output buffering

    //if (isset($_POST["submit"]) && isset($_POST['names']) && isset($_POST['usernames']) && isset($_POST['password'])) {
    if (isset($_POST['names']) && isset($_POST['usernames']) && isset($_POST['password'])) {
        //$name = rawurldecode($_GET['names']);
        $name = $_POST['names'];
        //$username = rawurldecode($_GET['usernames']);
        $username = $_POST['usernames'];
        //$password = rawurldecode($_GET['password']);
        $password = $_POST['password'];
        $options = array("cost" => 4);
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $emp_status = 1;

        $add_user = "INSERT INTO `employee`(`emp_name`, `username`, `password`, `original_password`, `emp_status`) 
                     VALUES ('$name', '$username', '$hashPassword', '$password', '$emp_status')";
        $run_Sub = mysqli_query($connection, $add_user);
        $last_id = mysqli_insert_id($connection);

        $USER_ID = $last_id;
        $role_name = isset($_POST["rolenames"]) ? $_POST["rolenames"] : [];
        $designation = isset($_POST["designation"]) ? $_POST["designation"] : '';
        $TYPE = isset($_POST["TYPE"]) ? $_POST["TYPE"] : '';
        $districts = isset($_POST["district"]) ? $_POST["district"] : [];
        $cities = isset($_POST["city"]) ? $_POST["city"] : [];
        $permission = 1;

        // $commaSeparated_Role_multi = implode(',', $role_name);
        // $commaSeparated_districts_multi = implode(',', $districts);
        // $commaSeparated_cities_multi = implode(',', $cities);

        $commaSeparated_Role_multi = is_array($role_name) ? implode(',', $role_name) : ($role_name ? $role_name : '');
        $commaSeparated_districts_multi = is_array($districts) ? implode(',', $districts) : ($districts ? $districts : '');
        $commaSeparated_cities_multi = is_array($cities) ? implode(',', $cities) : ($cities ? $cities : '');


        $role_assign = "INSERT INTO `roles`(`user_id`, `role_name`, `designation`, `TYPE`, `district`, `city`, `permission`) 
                        VALUES ('$USER_ID', '$commaSeparated_Role_multi', '$designation', '$TYPE', 
                        '$commaSeparated_districts_multi', '$commaSeparated_cities_multi', '$permission')";

        $run_role = mysqli_query($connection, $role_assign);

        if ($run_role) {
            $response['success'] = true;
            $response['message'] = 'Data saved successfully';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error: Data not saved';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid request parameters';
    }

    echo json_encode($response);
    ob_end_flush();
    exit();
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
    echo json_encode($response);
    exit();
}
?>
