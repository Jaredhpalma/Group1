<?php   
    $server_name = "localhost";
    $db_name = "movies_system";
    $username = "root";
    $password = "";

    $conn = new mysqli($server_name, $username, $password, $db_name);

    if($conn->connect_error){
        die("Database Connection Failed. " . $conn->connect_error);
     }else{
        echo "Database Connection Successful. ";
     }
     
     $query = "SELECT * FROM movies ORDER BY id ASC"; // Ensure ordered display
     $result = $conn->query($query);
     
     $counter = 1;
?>
