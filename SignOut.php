<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Outed</title>
</head>

<body>

</body>

</html>
<script>
    document.cookie = "User=;";
    document.cookie = "Pass=;";
    document.cookie = "Email=;";
    document.cookie = "NewsShowed=;";
    document.cookie = "PHPSESSID=;";
    document.cookie = "OnLoad=;";
    function deleteAllCookies() {
        const cookies = document.cookie.split(";");
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i];
            const eqPos = cookie.indexOf("=");
            const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
    }
    deleteAllCookies();
    window.location.href = "./";
</script>
<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['Password']);
unset($_SESSION['LOGIN']);
unset($_SESSION['Email']);
unset($_SESSION['TOKEN']);
?>