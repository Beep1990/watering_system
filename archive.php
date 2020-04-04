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
            <a class="nav-item nav-link active" href="archive.php">Archiwalne dane pogodowe</a>
            <a class="nav-item nav-link" href="rows.php">Wykresy</a>
            <a class="nav-item nav-link" href="plants.php">Rośliny</a>
            <a class="nav-item nav-link" href="todo.php">Lista zadań</a>
            <a class="nav-item nav-link" href="history.php">Historia podlewania</a>
  
        </nav>


    <script>

            $(document).ready(function(){
            $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
             });
         });

    </script> 

         <div class="container mt-2 mb-4 p-2 shadow bg-white">
            <input id="myInput" type="text" class="form-control" placeholder="Szukaj..">
            <table class="table table-striped">
            <tr>
                <th>
                    Data
                </th>
                <th>
                    Temperatura powietrza
                </th>
                <th>
                    Wilgotność
                </th>
            </tr>
            <tbody id="myTable">
                <?php
                require_once 'connect.php';
                $conn = database();
                $sql = "SELECT * FROM `sensor` ORDER BY `data` DESC";
                $result = @$conn->query($sql);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td><br />'.$row["data"].' </td><td>'.$row["temp"].' &#8451 </td><td>'.$row["hum"].' %</td></tr>'; 
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        </div>
    </body>
</html>
