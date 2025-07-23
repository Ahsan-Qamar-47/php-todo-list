<?php
$db_SERVER = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "todo_app";

$conn = mysqli_connect($db_SERVER, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
