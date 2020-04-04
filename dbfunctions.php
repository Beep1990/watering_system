<?php
session_start();

if (isset($_POST['save_plant'])){
    if (!empty($_POST['name']) && !empty($_POST['number'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];

        require_once 'connect.php';
        $conn = database();
        $sql = "INSERT INTO plants(name, number) values(?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $number);
        if ($stmt->execute()){
            $_SESSION['msg'] = "Dodano nową roślinę!";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else {
        $_SESSION['msg'] = "Coś poszło nie tak :(";
        $_SESSION['alert'] = "alert alert-warning";
    }
    header("location: plants.php");
}

if (isset($_POST['delete_plant'])) {
    $pid = $_POST['delete_plant'];

    require_once 'connect.php';
    $conn = database();
    $dQuery = "DELETE FROM plants WHERE id = ?";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $pid);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "Wpis został usunięty";
        $_SESSION['alert'] = "alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location: plants.php");
}

if (isset($_POST['edit_plant'])) {
    if (!empty($_POST['name']) && !empty($_POST['number'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $pid = $_POST['edit_plant'];

        require_once 'connect.php';
        $conn = database();
        $uQuery = "UPDATE plants SET name = ?, number = ? WHERE id = ?";
        $stmt = $conn->prepare($uQuery);
        $stmt->bind_param('ssi', $name, $number, $pid);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Pomyślnie zaktualizowano wpis.";
            $_SESSION['alert'] = "alert alert-success";
        }

        $stmt->close();
        $conn->close();
    }
    else {
            $_SESSION['msg'] = "Coś poszło nie tak :(";
            $_SESSION['alert'] = "alert alert-warning";
    }
    header("location: plants.php");
}

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

if (isset($_POST['delete_task'])) {
    $tid = $_POST['delete_task'];

    require_once 'connect.php';
    $conn = database();
    $dQuery = "DELETE FROM todo WHERE id = ?";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $tid);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "Wpis został usunięty";
        $_SESSION['alert'] = "alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location: todo.php");
}

if (isset($_POST['edit_task'])) {
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];
        $tid = $_POST['edit_task'];

        require_once 'connect.php';
        $conn = database();
        $uQuery = "UPDATE todo SET task = ? WHERE id = ?";
        $stmt = $conn->prepare($uQuery);
        $stmt->bind_param('si', $task, $tid);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Pomyślnie zaktualizowano wpis.";
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

if (isset($_POST['done_task'])) {
    $doneId = $_POST['done_task'];

    require_once 'connect.php';
    $conn = database();
    $dQuery = "UPDATE todo SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $doneId);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "Zakończono zadanie.";
        $_SESSION['alert'] = "alert alert-success";
    }
    $stmt->close();
    $conn->close();
    header("location: todo.php");
}

if (isset($_POST['restore_task'])) {
    $restoreId = $_POST['restore_task'];

    require_once 'connect.php';
    $conn = database();
    $rQuery = "UPDATE todo SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($rQuery);
    $stmt->bind_param('i', $restoreId);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "Przywrócono zadanie.";
        $_SESSION['alert'] = "alert alert-success";
    }
    $stmt->close();
    $conn->close();
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