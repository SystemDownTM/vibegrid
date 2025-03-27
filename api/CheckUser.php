<?php
// اتصال به دیتابیس
session_start();
include("config.php");
$Username = md5($_GET["Username"]);
$Password = md5(($_GET["Password"]));
if (strpos($Username, '#') !== false or strpos($Username, "'") !== false or strpos($Username, "\"") !== false or strpos($Username, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}
if (strpos($Password, '#') !== false or strpos($Password, "'") !== false or strpos($Password, "\"") !== false or strpos($Password, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}
if (isset($_GET["mode"])) {
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
            echo "true";
            $_SESSION["Username"] = (($Username));
            $_SESSION["Password"] = (($Password));
            $True = true;
        }
    }
}
$conn->close();
if ($True == false) {
    echo "Wrong code=3";
}
?>