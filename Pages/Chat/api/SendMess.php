<?php
error_reporting(1);
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
        if (md5(trim(htmlspecialchars($_GET["UserT"]))) == md5(trim($fetch['Username']))) {
            $_SESSION["receiver_id"] = $fetch['id'];
        }
        if (($Password) == ($fetch['Password']) && $Username == md5($fetch['Username'])) {
            $_SESSION["UserReal"] = $fetch['Username'];
            $_SESSION["sender_id"] = $fetch['id'];
            $True = true;
        }
    }
}
$conn->close();
if ($True == false) {
    echo "Wrong";
    exit();
} else {
    Run();
}
function Run()
{
    $response = array();
    $response["Error"] = "false";
    echo "ss";
    include ("../../config.php");
    $receiver_id = $_SESSION["receiver_id"];
    $sender_id = $_SESSION["sender_id"];
    $conn = new mysqli($host, $user, $pass, $name_db);
    if ($conn->connect_error) {
        $response["Error"] = "true";
        die("اتصال ناموفق: " . $conn->connect_error);
    }
    $message = $_GET['message'];
    if (strlen($message) > 3 && trim($receiver_id) != "" && ($_GET["Clear"] !== "true")) {
        $sql = "INSERT INTO private_messages (type,sender_id, receiver_id, message) VALUES ('text',?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        if ($stmt->execute()) {
            //echo "sent";
        } else {
            echo "error" . $sql . "<br>" . $conn->error;
            $response["Error"] = "true";
        }
        $stmt->close();
        $conn->close();
    }
    try {
        function generateStrongPassword($length = 16)
        {
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{};':\"\\|,.<>/?";
            $password = "";
            $character_length = strlen($characters);
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[random_int(0, $character_length - 1)];
            }
            return $password;
        }
        if (isset($_FILES['file']) && trim($receiver_id) != "" && ($_GET["Clear"] !== "true")) {
            $conn = new mysqli($host, $user, $pass, $name_db);
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            if ($fileType == "image/png") {
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $password = generateStrongPassword(20);
                $uploadPath = '../../../Data/Chat/Upload/';
                $encryptedFilePath = $uploadPath . $fileName . '.enc';
                $encryptedData = openssl_encrypt(file_get_contents($fileTmpName), 'AES-256-CBC', $password, 0, '1234567812345678');
                file_put_contents($encryptedFilePath, $encryptedData);
                $sql = "INSERT INTO private_messages (type, sender_id, receiver_id, message, password_file) VALUES ('file', $sender_id, $receiver_id, '$encryptedFilePath', '%s')";
                $sql = sprintf($sql, $password);
                $stmt = $conn->prepare($sql);
                if ($stmt->execute()) {
                    // echo "sent";
                } else {
                    $response["Error"] = "true";
                    echo "error" . $sql . "<br>" . $conn->error;
                }
                $stmt->close();
                $conn->close();
            } else {
                $response["Error"] = "excet";
            }
        }
    } catch (Exception $e) {
    }
    if ($_GET["Clear"] == "true") {
        $conn = new mysqli($host, $user, $pass, $name_db);
        if ($conn->connect_error) {
            $response["Error"] = "true";
            die("اتصال ناموفق: " . $conn->connect_error);
        }
        $sql = "DELETE FROM private_messages WHERE receiver_id = $receiver_id AND sender_id = $sender_id";
        if ($conn->query($sql) === TRUE) {
            //echo "cleared";
        } else {
            echo "error " . $conn->error;
            $response["Error"] = "true";
        }
        $conn->close();
    }
    $_SESSION["UserReal"] = null;
    $_SESSION["receiver_id"] = null;
    $_SESSION["sender_id"] = null;
    echo json_encode($response);
}
?>