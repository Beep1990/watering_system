<?php

    function database(){
        
        $host = "localhost";
        $db_user = "beep21";
        $db_password ="password";
        $db_name ="dht11";

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

