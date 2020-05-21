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
         <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
         <?php 
            if (isset($_POST['wON']))
            {
                exec('sudo python /var/www/html/rpi_scripts/wateringON.py');
            }
            if (isset($_POST['wOFF']))
            {
                exec('sudo python /var/www/html/rpi_scripts/wateringOFF.py');
            }
            if (isset($_POST['wON15']))
            {
                exec('sudo python /var/www/html/rpi_scripts/wateringON15.py');
            }
            if (isset($_POST['wON30']))
            {
                exec('sudo python /var/www/html/rpi_scripts/wateringON30.py');
            }
            if (isset($_POST['wON50']))
            {
                exec('sudo python /var/www/html/rpi_scripts/wateringON50.py');
            }
        ?>
        
        <title>Podlewaczka</title>

    </head>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/popper.min.js" type="text/javascript"></script>
        <script src="boobootstrap.js" type="text/javascript"></script>
        <nav class="nav nav-pills nav-fill" style="background-color: white;">
            <a class="nav-item nav-link active" href="main.php">Strona główna</a>
            <a class="nav-item nav-link" href="archive.php">Archiwalne dane pogodowe</a>
            <a class="nav-item nav-link" href="rows.php">Wykresy</a>
            <a class="nav-item nav-link" href="history.php">Historia podlewania</a>
        </nav>


        <script type="text/javascript">
            $(Document).ready(function(){
                    setInterval(function(){$("#temp").load('main.php #temp')
                    }, 2000 );
                });
        </script>

       <div class="container mt-2 m b-4 p-2 shadow bg-white" id="wt" style="margin: auto; text-align: center;">

        <?php
            echo "<p> Witaj ".$_SESSION['login']."!";
        ?>
 
        <h1> Aktualne warunki pogodowe:</h1>
        <br />
        <h1>Temperatura powietrza:  

        <?php

        require_once 'connect.php';
        $conn = database();
        $sql = "SELECT `temp` FROM `sensor` ORDER BY `data` DESC LIMIT 1";
        $result = @$conn->query($sql);
         if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
            echo $row["temp"]; 
         
        }
    }

    $conn->close();

        ?><font color="red">&#8451</font>

        </h1>

        <br />


<h1>Wilgotność powietrza:
  <?php
        require_once 'connect.php';
        $conn = database();
        $sql = "SELECT `hum` FROM `sensor` ORDER BY `data` DESC LIMIT 1";
        $result = @$conn->query($sql);
         if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
            echo $row["hum"]; 
         
        }
    }

    $conn->close();
        ?><font color="blue">%</font>
</h1>
        </div>  

    <br />
    <br />

        <div class="container mt-2 m b-4 p-2 shadow bg-white" method="POST" style="margin: auto; text-align: center;">
        <form method="POST">
        <h1>Sterowanie podlewaniem:</h1>
        <button  name="wON"    class="btn btn-primary">Włącz</button>
        <button  name="wON15"  class="btn btn-primary">Włącz podlewanie na 15 minut</button>
        <button  name="wON30"  class="btn btn-primary">Włącz podlewanie na 30 minut</button>
        <button  name="wON50"  class="btn btn-primary">Włącz podlewanie na 50 minut</button>
        <button  name="wOFF"   class="btn btn-danger">Wyłącz</button>
        </form>
        </div>

        <br />
        <br />

        <div class="container mt-2 m b-4 p-2 shadow bg-white" style="margin: auto; text-align: center;">
    <?php
        $watering_status = exec('gpio -g read 4'); 
    ?>
        <h1>Aktualny status: <?php echo $watering_status ?></h1>
        </div>

              
    </body>
</html>
