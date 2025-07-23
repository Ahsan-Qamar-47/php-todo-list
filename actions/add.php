<?php
include '../includes/db.php';

if (isset($_POST['title'])) { // title is given 
    $title = trim($_POST['title']);//remove extra  white spaces back and forth the title 
    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
        $stmt->bind_param("s", $title);
        $stmt->execute();
    }
}

header("Location: ../index.php");
exit;
?>
