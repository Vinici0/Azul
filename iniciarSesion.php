<?php
 
include('config.php');
session_start();
 
if (isset($_POST['login'])) {
 
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        header('Location: login.php?errorLogin=Correo electronico no existe');
            exit;
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            $todaydate = date("Y-m-d");
            $sqlDate = date('Y-m-d', strtotime($todaydate));
            $query = $connection->prepare("UPDATE users  set  last_login=:today  WHERE id=:user_id");
            $query->bindParam("user_id", $_SESSION['user_id'], PDO::PARAM_INT);
            $query->bindParam("today",  $sqlDate, PDO::PARAM_STR);
            $query->execute();
            header('Location: index.php');
            exit;
        } else {
            header('Location: login.php?errorLogin=Contraseña incorrecta');
            exit;
        }
    }
}else{
    header('Location: login.php');
    exit;
}
 
?>