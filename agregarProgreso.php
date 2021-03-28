<?php
 
include('config.php');
session_start();

if (isset($_POST['progreso'])) {
 
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

        $query = $connection->prepare("INSERT INTO progress(id_user,weight,height) VALUES (:id_user,:peso,:altura)");
        $query->bindParam("id_user", $_SESSION['user_id'], PDO::PARAM_INT);
        $query->bindParam("peso", $peso, PDO::PARAM_STR);
        $query->bindParam("altura", $altura, PDO::PARAM_STR);
        $result = $query->execute();
 
        if ($result) {
            header('Location: index.php');
                exit;
        } else {
            header('Location: index.php?errorRegister=No se puedo registrar');
            exit;
        }

}else{
    header('Location: login.php');
    exit;
}
 
?>