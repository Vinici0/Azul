<?php
session_start();
 
if(isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
} else {
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>


<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form method="post" action="registrar.php" name="register">
			<h1>Crear Cuenta</h1>
            <p><?php 
            if(isset($_GET['errorRegister'])){
                echo $_GET['errorRegister'];
            }
            ?></p>
			<input type="text" name="username" placeholder="Nombre" required/>
			<input type="email" name="email" placeholder="Correo" required/>
			<input type="password" name="password" placeholder="Contraseña" required/>
			<button type="submit" name="register" value="register">Registrar</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form method="post" action="iniciarSesion.php" name="login" >
			<h1>Iniciar Sesión</h1>
            <p><?php 
            if(isset($_GET['errorLogin'])){
                echo $_GET['errorLogin'];
            }
            ?></p>
			<input type="email" name="email"  placeholder="Correo" required/>
			<input type="password" name="password" placeholder="Contraseña" required/>
<!-- 			<a href="#">Olvidaste la contraseña?</a> -->
			<button type="submit" name="login" value="login">Entrar</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>¡Bienvenido de nuevo!</h1>
				<p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
				<button class="ghost" id="signIn">Iniciar Sesión</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>¡Hola, Amigo!</h1>
				<p>Ingrese sus datos personales y comience una vida saludable con nosotros</p>
				<button class="ghost" id="signUp">Registrarse</button>
			</div>
		</div>
	</div>
</div>

<script >
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</body>
</html>
<?php 
}
?>