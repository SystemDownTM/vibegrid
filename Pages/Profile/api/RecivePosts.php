<?php
error_reporting(0);
session_start();
include ("../../config.php");
$conn = new mysqli($host, $user, $pass, $name_db);
try {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    $response = array();
    $text = $_SESSION["Username"];
    if (is_dir("../../../Data/Users/" . ($text) . "/") == true) {
        $query_sen = "SELECT * FROM users";     // query sentence (ادمین نام table  میباشد)
        $query = mysqli_query($conn, $query_sen);
        $True = false;
        $c = 0;
        if ($query) {
            while ($fetch = mysqli_fetch_assoc($query)) {
                if ($text == md5(trim($fetch['Username']))) {
                    $user_id = $fetch["id"];
                    $sql_posts = "SELECT content FROM posts WHERE user_id = '$user_id'";
                    $result_posts = $conn->query($sql_posts);
                    if ($result_posts->num_rows > 0) {
                        while ($row_posts = $result_posts->fetch_assoc()) {
                            if ($row_posts["content"] != "") {
                                $response[] = $row_posts["content"];
                            }
                        }
                    } else {
                        echo "";//Not Found Record
                    }
                }
            }
        }
    } else {
        $response["notfound"] = "true";
    }
    echo json_encode($response);
} catch (Exception $ex) {
    $response = array();
    $response["error"] = "true";
    echo json_encode($response);
}
?>