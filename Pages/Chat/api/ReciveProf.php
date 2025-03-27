<?php
session_start();
echo htmlspecialchars(file_get_contents("../../../Data/Users/" . md5($_GET["UserT"]) . "/Profile.txt"));
?>