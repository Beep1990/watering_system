<?php

    function database(){
        
        $host = "localhost";
        $db_user = "root";
        $db_password ="M@rco12345";
        $db_name ="watering_system";

        try{
            $conn = new mysqli ($host, $db_user, $db_password, $db_name);

            if ($conn->connect_errno!=0){
                echo "Error: ".$conn->connect_errno. " Opis: ". $conn->connect_error;
            } else {
                return $conn;
            }
        }
        catch (RuntimeException $e) {
            echo $e->getMessage();
        }
       
    }

?>

