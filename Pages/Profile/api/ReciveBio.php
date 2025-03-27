<?php
error_reporting(0);
session_start();
$Username = $_SESSION["Username"];
if (isset ($_GET["mode"])) {
    if ($_GET["mode"] == "desktop") {
        $Username = md5($_GET["Username"]);
    }
}
echo htmlspecialchars(file_get_contents("../../../Data/Users/" . ($Username) . "/Bio.txt"));
?>