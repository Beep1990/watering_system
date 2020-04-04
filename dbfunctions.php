<?php
session_start();

if (isset($_POST['save_task'])){
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];
        $id = $_SESSION['ID'];
        $date = date('Y-m-d H:i:s');

        require_once 'connect.php';
        $conn = database();
        $sql = "INSERT INTO todo(date, task, owner, status) values(?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $date, $task, $id);
        if ($stmt->execute()){
            $_SESSION['msg'] = "Dodano nowe zadanie!";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else {
        $_SESSION['msg'] = "Coś poszło nie tak :(";
        $_SESSION['alert'] = "alert alert-warning";
    }
    header("location: todo.php");
}

if (isset($_POST['wON'])){

        $owner = $_SESSION['login'];
        $duration = 'Sterowanie manualne';
        $watering_date = date('Y-m-d H:i:s');

        require_once 'connect.php';
        $conn = database();
        $sql = "INSERT INTO wh (wdate, bywho, duration) values(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $watering_date, $owner, $duration);
        $stmt->close();
        $conn->close();
        header("location: main.php");
    }



?>