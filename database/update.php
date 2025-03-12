<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $Title = $_POST['Title'];
    $Genre = $_POST['Genre'];
    $Rating = $_POST['Rating'];
    $YearReleased = $_POST['YearReleased'];

    
    $sql = "UPDATE movies SET 
            Title='$Title', 
            Genre='$Genre', 
            Rating='$Rating', 
            YearReleased='$YearReleased' 
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error: "; 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>
