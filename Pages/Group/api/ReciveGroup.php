<?php
$response = array();
error_reporting(1);
// اتصال به دیتابیس
session_start();
include("../../config.php");
$Username = $_SESSION["Username"];
$Password = $_SESSION["Password"];
if (strpos($Username, '#') !== false or strpos($Username, "'") !== false or strpos($Username, "\"") !== false or strpos($Username, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}
if (strpos($Password, '#') !== false or strpos($Password, "'") !== false or strpos($Password, "\"") !== false or strpos($Password, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}
$conn = new mysqli($host, $user, $pass, $name_db);
$query_sen = "SELECT * FROM users";     // query sentence (ادمین نام table  میباشد)
$query = mysqli_query($conn, $query_sen);
$True = false;
if ($query) { // if query was ok
    while ($fetch = mysqli_fetch_assoc($query)) {
        if (trim($Password) == trim($fetch['Password']) && $Username == md5($fetch['Username'])) {
            Run($response); // Pass $response as a parameter
            $True = true;
            $response["UserPass"] = "true";
        }
    }
}
$conn->close();
if ($True == false) {
    $response["UserPass"] = "false";
}
echo json_encode($response);

// Modify $response within the function
function Run(&$response) {
    $response["1"] = "TestMess";
    $response["2"] = "TestMess2";
    return;
}
?>
