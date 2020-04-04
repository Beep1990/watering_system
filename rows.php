<?php
session_start();

if (!isset($_SESSION['logged'])){
    header('Location: index.php');
    exit();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Podlewaczka</title>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/Chart.bundle.js" type="text/javascript"></script>

    <?php
                require_once 'connect.php';
                $conn = database();
                
                $sql = "SELECT `temp` FROM `sensor` ORDER BY `data` DESC";
                $sql1 = "SELECT `data` FROM `sensor` ORDER BY `data` DESC";
                $sql2 = "SELECT `hum` FROM `sensor` ORDER BY `data` DESC";
                
                 $result = $conn->query($sql);
                 $result1 = $conn->query($sql1);
                 $result2 = $conn->query($sql2);
                 $temp = array();
                 $data = array();
                 $hum = array();
                 if ($result->num_rows > 0) {
                                   
                while($row = $result->fetch_assoc()) {
                   $temp[] = $row["temp"];
               }}
               if ($result1->num_rows > 0) {
                                   
                while($row = $result1->fetch_assoc()) {
                   $data[] = $row["data"];
               }}
               if ($result2->num_rows > 0) {
                                   
                while($row = $result2->fetch_assoc()) {
                   $hum[] = $row["hum"];
               }}
                 
                 
                $temp_j = json_encode($temp, true);
                $data_j = json_encode($data,true);
                $hum_j = json_encode($hum, true);
                $conn->close();
                
               
        ?>
    </head>
    
    <body>
         <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
         <link rel="stylesheet" type="text/css" href="style.css">
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/popper.min.js" type="text/javascript"></script>
        <script src="boobootstrap.js" type="text/javascript"></script>
        <nav class="nav nav-pills nav-fill" style="background-color: white;">
            <a class="nav-item nav-link" href="main.php">Strona główna</a>
            <a class="nav-item nav-link" href="archive.php">Archiwalne dane pogodowe</a>
            <a class="nav-item nav-link active" href="rows.php">Wykresy</a>
            <a class="nav-item nav-link" href="history.php">Historia podlewania</a>
        </nav>
        
        
        <canvas id="tempwyk" with="80" height="70">
           
        </canvas>
       <canvas id="humwyk" with="80" height="70">
           
        </canvas>
        
     
    </body>
    <script type="text/javascript">
             
             var temp = <?php echo $temp_j; ?>;
              var data = <?php echo $data_j; ?>;
              var hum = <?php echo $hum_j; ?>;
             
        var ctx = document.getElementById("tempwyk").getContext('2d');
        var tempwyk = new Chart(ctx, {
            type : 'line',
            
            data:{
              labels: data,  
              datasets:[{
                      data: temp,
                      label: "Temperatura",
                      borderColor: "#FF0000",
                      fill: false
                      
              }
          ]
            
        },
         options:{
             title: {
                 display: true,
                 text: 'Temperatura czujnika w czasie'
             }
         }   
        });
        
         var ctx = document.getElementById("humwyk").getContext('2d');
        var tempwyk = new Chart(ctx, {
            type : 'line',
            
            data:{
              labels: data,  
              datasets:[{
                      data: hum,
                      label: "Wilgotność",
                      borderColor: "#0000FF",
                      fill: false
                      
              }
          ]
            
        },
         options:{
             title: {
                 display: true,
                 text: 'Wilgotność czujnika w czasie'
             }
         }   
        });
       </script>
      
       
</html>
