<?php
session_start();

// بررسی متد درخواست
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 400 Bad Request");
    exit;
}

// بررسی وجود فایل آپلود شده
if (!isset ($_FILES['image']) || $_FILES['image'] === "") {
    $response = ['status' => 'error', 'message' => 'فایلی برای آپلود انتخاب نشده است.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// تعریف متغیرها
$uploadDir = "../../../Data/Users/" . ($_SESSION["Username"]) . "/";
$timestamp = time();
$newFileName = 'profile.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$uploadFile = $uploadDir . $newFileName;

// بررسی نوع فایل آپلود شده
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
if (!in_array($fileExtension, $allowedExtensions)) {
    $response = ['status' => 'error', 'message' => 'فرمت فایل آپلود شده مجاز نیست.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// بررسی صحت تصویر آپلود شده
$imageInfo = getimagesize($_FILES['image']['tmp_name']);
if (!$imageInfo) {
    $response = ['status' => 'error', 'message' => 'فایل آپلود شده یه تصویر نیست.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// بررسی حجم فایل آپلود شده
$maxFileSize = 2097152; // 2 مگابایت
if ($_FILES['image']['size'] > $maxFileSize) {
    $response = ['status' => 'error', 'message' => 'حجم فایل آپلود شده بیشتر از حد مجاز است.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
    $response = ['status' => 'error', 'message' => 'خطا در آپلود تصویر.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
if (isset ($_POST["Bio"])) {
    file_put_contents("../../../Data/Users/" . ($_SESSION["Username"]) . "/Bio.txt", $_POST["Bio"]);
}
$response = ['status' => 'success', 'message' => 'تصویر با موفقیت آپلود شد.'];
file_put_contents("../../../Data/Users/" . ($_SESSION["Username"]) . "/Profile.txt", "Data/Users/" . ($_SESSION["Username"]) . "/" . $newFileName);
header('Content-Type: application/json');
echo json_encode($response);
?>