<?php
error_reporting(0);
// اتصال به دیتابیس
session_start();
include ("../../config.php");
$Username = $_SESSION["Username"];
$Password = $_SESSION["Password"];
if (strpos($Username, '#') !== false or strpos($Username, "'") !== false or strpos($Username, "\"") !== false or strpos($Username, "/") !== false) {
    $response = array();
    $response['error'] = true;
    echo json_encode($response); // if username or password is wrong, return error message.
    exit();
}
if (strpos($Password, '#') !== false or strpos($Password, "'") !== false or strpos($Password, "\"") !== false or strpos($Password, "/") !== false) {
    $response = array();
    $response['error'] = true;
    echo json_encode($response); // if username or password is wrong, return error message.
    exit();
}
if (isset($_GET["mode"])) {
    if ($_GET["mode"] == "desktop") {
        $Username = md5($_GET["Username"]);
        $Password = md5($_GET["Password"]);
    }
}
$conn = new mysqli($host, $user, $pass, $name_db);
$query_sen = "SELECT * FROM users";     // query sentence (ادمین نام table  میباشد)
$query = mysqli_query($conn, $query_sen);
$True = false;
if ($query) { // if query was ok
    while ($fetch = mysqli_fetch_assoc($query)) {
        if (($Password) == ($fetch['Password']) && $Username == md5($fetch['Username'])) {
            $True = true;
            $_SESSION["sender_id"] = $fetch["id"];
        }
        if (htmlspecialchars($_GET['UserT']) == $fetch["Username"]) {
            $_SESSION["receiver_id"] = $fetch["id"];
        }
    }
}
$conn->close();
if ($True == false) {
    $response = array();
    $response['error'] = true;
    echo json_encode($response); // if username or password is wrong, return error message.
    exit();
} else {
    Run();
}
function Run()
{
    include ("../../config.php");
    $response["id"] = $_SESSION["sender_id"];
    $CO = 100;
    $C = 0;
    $CR = 1;
    $receiver_id = $_SESSION["receiver_id"];
    $sender_id = $_SESSION["sender_id"];
    $Username = ($_SESSION["Username"]);
    $conn = new mysqli($host, $user, $pass, $name_db);

    if ($conn->connect_error) {
        die("اتصال ناموفق: " . $conn->connect_error);
    }
    if ($_GET["mode"] == "load") {
        $sql = "SELECT * FROM private_messages WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) OR (receiver_id = $sender_id AND sender_id = $receiver_id) ORDER BY timestamp ASC LIMIT 100";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CR++;
                if ($row["type"] == "file") {
                    $fileName = 'download';
                    $decryptedData = openssl_decrypt(file_get_contents($row["message"]), 'AES-256-CBC', $row["password_file"], 0, '1234567812345678');
                    $base64Data = base64_encode($decryptedData);
                    $row["message"] = "" . ($base64Data);
                    $response[] = $row;
                } else {
                    $response[] = $row;
                }
            }
        } else {
            //  echo "هیچ پیامی یافت نشد.";
        }
    } else {
        $sql = "SELECT * FROM private_messages WHERE ((sender_id = $sender_id AND receiver_id = $receiver_id) OR (receiver_id = $sender_id AND sender_id = $receiver_id)) AND timestamp > DATE_SUB(NOW(), INTERVAL 3 SECOND) ORDER BY timestamp ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CR++;
                if ($CR < $CO & $CR > $C) {
                    if ($row["type"] == "file") {
                        $fileName = 'download';
                        $decryptedData = openssl_decrypt(file_get_contents($row["message"]), 'AES-256-CBC', $row["password_file"], 0, '1234567812345678');
                        $base64Data = base64_encode($decryptedData);
                        $row["message"] = "" . ($base64Data);
                        $response[] = $row;
                    } else {
                        $response[] = $row;
                    }
                }
            }
        } else {
            // echo "هیچ پیامی یافت نشد.";
        }
    }
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
}
fclose($file);
?>