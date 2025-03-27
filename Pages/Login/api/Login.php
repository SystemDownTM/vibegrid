<?php
// اتصال به دیتابیس
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

error_reporting(0);
session_start();
include ("../../config.php");
$Username = ($_GET["Username"]);
$Password = md5(base64_decode($_GET["Password"]));
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
        if (trim($Password) == trim($fetch['Password']) && $Username == $fetch['Username']) {
            echo "true";
            $_SESSION["Username"] = md5(($Username));
            $_SESSION["Password"] = (($Password));
            $True = true;
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
                $mail->addAddress('' . $fetch["Email"] . '', 'User'); // Add a recipient
                $mail->addAddress('' . $fetch["Email"] . ''); // Name is optional
                $mail->addReplyTo('support@vibegrid.ir.com', 'Information');
                $mail->addCC('' . $fetch["Email"] . '');
                $mail->addBCC('' . $fetch["Email"] . '');
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $ip_address = $_SERVER['REMOTE_ADDR'];
                //$mail->addAttachment('/home/cpanelusername/attachment.txt'); // Add attachments
                //  $mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg'); // Optional name
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = ' New sign-in to your account on Vibe Grid';
                $mail->Body = 'Hi ' . $Username . ' <br>
                This email is to notify you that there was a new sign-in to your account on Vibe Grid from a new device. <br>
                Date and time : ' . date('Y-m-d H:i:s') . '<br>
                IP address : ' . $ip_address . '<br>
                Browser & OS : ' . $browser . '<br>';
                $mail->AltBody = "";
                $mail->send();
            } catch (Exception $e) {
            }
        }
    }
}
$conn->close();
if ($True == false) {
    echo "Wrong";
}
?>