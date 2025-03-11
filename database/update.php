<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['Title'];
    $author = $_POST['Genre'];
    $genre = $_POST['Rating'];
    $date_published = $_POST['YearReleased'];

    
    $sql = "UPDATE movies SET 
            title='$Title', 
            Author='$Genre', 
            Genre='$Rating', 
            Date_Published='$YearReleased' 
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
