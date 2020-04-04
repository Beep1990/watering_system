<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
{
    header('Location: main.php');
    exit();
}
?>
<!DOCTYPE HTML>
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

<div class="login-form">
    <form action="login.php" method="POST">
        <h2 class="text-center">Zaloguj się</h2>   
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="login" placeholder="Login" required="required">
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Hasło" required="required">
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
        </div>  
    </form>
            <p class="text-center small">Jeśli nie masz konta <a href="reg.php">Załóż je tutaj</a>.</p>   
</div>
    
            <?php require_once("index.php"); ?>

    <div class="container">
        <?php if(isset($_SESSION['msg'])): ?>
            <div class="<?= $_SESSION['alert']; ?>">
                <?= $_SESSION['msg'];
                unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>
    </div>



</body>
</html>