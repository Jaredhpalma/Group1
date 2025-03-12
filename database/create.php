<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Title = $_POST['Title'];
    $Genre = $_POST['Genre'];
    $Rating = $_POST['Rating'];
    $YearReleased = $_POST['YearReleased'];

    
    $sql = "INSERT INTO movies (Title, Genre, Rating, YearReleased) VALUES ('$Title', '$Genre', '$Rating', '$YearReleased')";

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