<?php
session_start();

if (!isset($_SESSION['logged'])){
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Podlewaczka</title>
    </head>
    
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/popper.min.js" type="text/javascript"></script>
        <script src="boobootstrap.js" type="text/javascript"></script>
        <nav class="nav nav-pills nav-fill" style="background-color: white;">
            <a class="nav-item nav-link" href="main.php">Strona główna</a>
            <a class="nav-item nav-link" href="archive.php">Archiwalne dane pogodowe</a>
            <a class="nav-item nav-link" href="rows.php">Wykresy</a>
            <a class="nav-item nav-link active" href="history.php">Historia podlewania</a>
  
        </nav>
        
        
         <div class="container mt-2 mb-4 p-2 shadow bg-white">
            <table class="table table-striped">
            <tr>
                <th>
                    Data Nawadniania
                </th>
                <th>
                    Długość nawadniania
                </th>
            </tr>
            <tbody id="myTable">
            <form action="dbfunctions.php" method="POST">
                <?php
                require_once 'connect.php';
                $conn = database();
                $sql = "SELECT * FROM `wh` ORDER BY `wdate` DESC";
                $result = @$conn->query($sql);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td>'.$row["wdate"].' </td><td>'.$row["duration"].'</td></tr>'; 
                    }
                }

                $conn->close();
                ?>
                </form>
            </tbody>
        </table>
        </div>
</div>