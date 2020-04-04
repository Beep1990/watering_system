<?php

session_start();

require_once "connect.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    $conn = database();


    if($result = @$conn->query(sprintf("SELECT * FROM users WHERE login='%s'",
     mysqli_real_escape_string($conn,$login)))){
        $usr = $result->num_rows;
        if($usr>0)
        {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['login'] = $row['login'];
            $_SESSION['ID'] = $row['ID'];

            unset($_SESSION['error']);
            $result->close();
            header('Location: main.php');
            } else {
            
            $_SESSION['error'] = '<span style="color:red"> Nieprawidłowe dane logowania! </span>';
            header('Location: index.php');

        }
            
            
        } else {
            
            $_SESSION['error'] = '<span style="color:red"> Nieprawidłowe dane logowania! </span>';
            header('Location: index.php');

        }
    }
    
    $conn->close();


?>