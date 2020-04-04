<?php
session_start();
?>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <title>Podlewaczka</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<div class="register-form">
    <form action="register.php" method="POST"> 
        <h2 class="text-center">Rejestracja</h2>   
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="regLogin" placeholder="Login">
            </div>
        </div>
      
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="regPassword"  placeholder="Hasło" >
            </div>
        </div>   

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="confPassword"  placeholder="Powtórz hasło" >
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="text" class="form-control" name="reg_key"  placeholder="Klucz rejestracji" >
            </div>
        </div>    

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Zarejestruj się</button>
        </div>  
    </form>
</div>
    

<?php
if(isset($SESSION['error']))  echo $_SESSION['error'];
?>

</body>
</html>