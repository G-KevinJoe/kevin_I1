<?php
include 'db.php';
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $conn->prepare("DELETE FROM courses WHERE id=?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
?>