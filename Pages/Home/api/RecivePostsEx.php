<?php
error_reporting(0);
// اتصال به دیتابیس
session_start();
include ("../../config.php");
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
$c = 0;
if ($query) { // if query was ok
    while ($fetch = mysqli_fetch_assoc($query)) {
        if (trim($Password) == trim($fetch['Password']) && $Username == md5(($fetch['Username']))) {
            $response = array();
            $query_sen = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 250;";     // query sentence (ادمین نام table  میباشد)
            $query = mysqli_query($conn, $query_sen);
            if ($query) {
                while ($fetch = mysqli_fetch_assoc($query)) {
                    $True = true;
                    $user_id = $fetch["user_id"];
                    $sql = "SELECT Username FROM users WHERE id = '$user_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Fetch the first row as an associative array
                        $row = $result->fetch_assoc();
                    } else {
                        // echo "No results found";
                    }
                    $response[] = "<img src='" . file_get_contents("../../../Data/Users/" . ($Username) . "/Profile.txt") . "'>" . "<b>" . htmlspecialchars(strval($row["Username"])) . " : </b>" . "<p>" . htmlspecialchars(($fetch["content"]) . "");
                    if ($c > 100) {
                        break;
                    }
                    $c++;
                }
            }
            echo json_encode($response);
            $True = true;
        }
    }
}
$conn->close();
if ($True == false) {
    echo "Wrong code=3";
}
function Run()
{
}
?>