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
if (isset($_GET["mode"])) {
    $Username = md5($_GET["Username"]);
    $Password = md5($_GET["Password"]);
}
$conn = new mysqli($host, $user, $pass, $name_db);
$query_sen = "SELECT * FROM users";     // query sentence (ادمین نام table  میباشد)
$query = mysqli_query($conn, $query_sen);
$True = false;
if ($query) { // if query was ok
    while ($fetch = mysqli_fetch_assoc($query)) {
        if (($Password) == ($fetch['Password']) && $Username == md5($fetch['Username'])) {
            Run();
            $_SESSION["id"] = $fetch["id"];
            $True = true;
        }
    }
}
$conn->close();
if ($True == false) {
    echo "Wrong";
}
function Run()
{
    if (isset($_GET["mode"])) {
        $Username = md5($_GET["Username"]);
        $Password = md5($_GET["Password"]);
    } else {
        $Username = $_SESSION["Username"];
    }
    include ("../../config.php");
    $conn = new mysqli($host, $user, $pass, $name_db);
    $sql = "SELECT DISTINCT sender_id, receiver_id FROM private_messages";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["sender_id"] == $_SESSION["id"]) {
                $user_id = $row["receiver_id"];
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $prof = file_get_contents("../../../Data/Users/" . md5($row["Username"]) . "/Profile.txt");
                        echo "<button class='.UserT' id='UserT' title=$row[Username] onclick=ReciveMess('$row[Username]','load')>
                        <img id='ProfPic' src='$prof'>
                        <pre id='UsernameT'> $row[Username] </pre>
                        </button>";
                    }
                }
                //
                $user_id = $row["sender_id"];
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $prof = file_get_contents("../../../Data/Users/" . md5($row["Username"]) . "/Profile.txt");
                        echo "<button id='UserT' title=$row[Username] onclick=ReciveMess('$row[Username]','load')>
                        <img id='ProfPic' src='$prof'>
                        <pre id='UsernameT'> $row[Username] </pre>
                        </button>";
                    }
                }
            }
        }
    } else {
    }
}
?>