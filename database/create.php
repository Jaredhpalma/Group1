<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['Title'];
    $Author = $_POST['Genre'];
    $Genre = $_POST['Rating'];
    $Date_Published = $_POST['YearReleased'];

    
    $sql = "INSERT INTO movies (title, Author, Genre, Date_Published) VALUES ('$Title', '$Genre', '$Rating', '$YearReleased')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
    } else {
        $_SESSION['status'] = "error: "; 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>