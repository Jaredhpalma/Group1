<?php   
    $server_name = "localhost";
    $db_name = "movies_system";
    $db_username = "root";
    $db_password = "";

    $conn = new mysqli($server_name,$db_username,$db_password);

    if($conn->connect_error){
        die("Database Connection Failed. " . $conn->connect_error);
     }else{
        echo "Database Connection Successful. ";
     }

?>