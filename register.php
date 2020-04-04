<?php
session_start();

$ok=TRUE;

$regLogin = $_POST['regLogin'];

if ((strlen($regLogin)<4) || (strlen($regLogin)>10)) {
    $ok=FALSE;
    $_SESSION['e_regLogin']="Login musi posiadać od 4 do 10 znaków!";
}

if (ctype_alnum($regLogin)==FALSE){
    $ok=FALSE;
    $_SESSION['e_regLogin']="Login może składaćsię tylko z liter i cyfr";
}

$regPassword = $_POST['regPassword'];

if ((strlen($regPassword)<8) || (strlen($regPassword)>20)) {
    $ok=FALSE;
    $_SESSION['e_regPassword']="Hasło musi posiadać od 8 do 20 znaków!";
}

$password1 = $_POST['regPassword'];
$password2 = $_POST['confPassword'];

if ($password1 != $password2) {
    $ok=FALSE;
    $_SESSION['e_regPassword']="Podane hasła są różne";
}

$password_hash = password_hash($password1, PASSWORD_DEFAULT);

require_once "connect.php";
$rk = $_POST['reg_key'];
$rk = htmlentities($rk, ENT_QUOTES, "UTF-8");

$conn = database();

if($result = $conn->query(sprintf("SELECT * FROM regkeys WHERE regkey='%s' && KeyActive = 1",
     mysqli_real_escape_string($conn,$rk)))){
        $keys = $result->num_rows;
        if($keys>0)
        {           
            $key = TRUE;
            $result->close();
        } else {
            
            $key = FALSE;

        }
    }
    
   


      if ($ok==TRUE && $key==TRUE) {

        $rUser = "INSERT INTO users(login, password) values(?, ?)";
        $stmt = $conn->prepare($rUser);
        $stmt->bind_param("ss", $regLogin, $password_hash);
        if ($stmt->execute()){    
            
            $conn = database();
            $rkeyQuery = "DELETE FROM regkeys WHERE ID = '1'";
            $stmt1 = $conn->prepare($rkeyQuery);
            
            $_SESSION['msg'] = "Pomyślnie zarejestrowano nowego użytkownika!";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt1->close();
        $stmt->close();

    }    else {

        header("location: blad.php");
    }
        header("location: index.php");

 $conn->close();

?>
        

