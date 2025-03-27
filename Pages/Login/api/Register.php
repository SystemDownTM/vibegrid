<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

error_reporting(0);
include ("../../config.php");
$Username = ($_GET["Username"]);
$Password = base64_decode($_GET["Password"]);
if (strpos($Username, '#') !== false or strpos($Username, "'") !== false or strpos($Username, "\"") !== false or strpos($Username, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}
if (strpos($Password, '#') !== false or strpos($Password, "'") !== false or strpos($Password, "\"") !== false or strpos($Password, "/") !== false) {
    echo "Unauthorized character code=1";
    exit;
}

$conn = new mysqli($host, $user, $pass, $name_db);
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}
$username = $_GET['Username'];
$password = md5(base64_decode($_GET['Password']));
$email = base64_decode($_GET['Email']);
if (strlen($password) < 8 || strlen($username) < 5) {
    $response = array('success' => false, 'message' => 'lenght');
    echo json_encode($response);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = array('success' => false, 'message' => 'email');
    echo json_encode($response);
    exit();
}

if (preg_match('/[|\/?&\"\'<>]/', $username) || preg_match('/[|\/?&\"\'<>]/', $email)) {
    $response = array('success' => false, 'message' => 'یوزرنیم و ایمیل نمی‌توانند شامل علایم خاص مانند | / ? " باشند.');
    echo json_encode($response);
    exit();
}

$sql = "SELECT * FROM users WHERE Username='$username' OR Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response = array('success' => false, 'message' => 'AlerUser');
    echo json_encode($response);
    exit();
}

// درج اطلاعات کاربر در جدول
$sql = "INSERT INTO users (Username, Password, Email) VALUES ('$username', '$password', '$email')";
if ($conn->query($sql) === TRUE) {
    $response = array('success' => true, 'message' => 'ok');
    mkdir("../../../Data/Users/" . md5($Username) . "/");
    mkdir("../../../Data/Users/" . md5($Username) . "/Posts");
    mkdir("../../../Data/Users/" . md5($Username) . "/Chats");
    file_put_contents("../../../Data/Users/" . md5($Username) . "/Chats/chat.txt", "");
    file_put_contents("../../../Data/Users/" . md5($Username) . "/Bio.txt", "i'm Using VibeGrid");
    file_put_contents("../../../Data/Users/" . md5($Username) . "/Profile.txt", "ico/profile.png");
    echo json_encode($response);
    require '../../../api/PHPMailer/src/Exception.php';
    require '../../../api/PHPMailer/src/PHPMailer.php';
    require '../../../api/PHPMailer/src/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.vibegrid.ir';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@vibegrid.ir';
        $mail->Password = '8q8QmR4WS2*vl!';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('support@vibegrid.ir', 'Vibe Grid Social Network');
        $mail->addAddress('' . $email . '', 'User'); // Add a recipient
        $mail->addAddress('' . $email . ''); // Name is optional
        $mail->addReplyTo('support@vibegrid.ir.com', 'Information');
        $mail->addCC('' . $email . '');
        $mail->addBCC('' . $email . '');
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $mail->isHTML(true);
        $mail->Subject = ' Welcome To Vibe Grid';
        $mail->Body = 'Hi ' . $Username . ' <br>Welcome to the Vibe Grid social network';
        $mail->send();
    } catch (Exception $e) {
        echo "";
    }
} else {
    $response = array('success' => false, 'message' => 'error');
    echo json_encode($response);
}

$conn->close();
?>