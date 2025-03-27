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
if (isset ($_GET["mode"])) {
    $Username = $_SESSION["Username"];
    $Password = $_SESSION["Password"];
}
$conn = new mysqli($host, $user, $pass, $name_db);
$query_sen = "SELECT * FROM users";     // query sentence (ادمین نام table  میباشد)
$query = mysqli_query($conn, $query_sen);
$True = false;
if ($query) { // if query was ok
    while ($fetch = mysqli_fetch_assoc($query)) {
        if (trim($Password) == trim($fetch['Password']) && $Username == md5($fetch['Username'])) {
            Run();
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
    $Username = htmlspecialchars($_GET["UserT"]);
    if (is_dir("../../../Data/Users/" . md5($Username) . "/")) {
        echo "true";
    }
}
?>