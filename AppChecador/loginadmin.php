<?php
	include "conexion.php";
	$server = new servidor();
	$con = $server->conectar("localhost","root","","checador");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Administrador</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://manuellpz.github.io/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body class="bgAdmin">
	<center>
		<div class="contain containLogin">
			<form method="post" action="">
				<h3>INICIAR SESION</h3><br>
				<input type="text" name="user" placeholder="Usuario: " class="form-control" required><br>
				<input type="password" name="pass" placeholder="Contraseña: " class="form-control" required><br>
				<input type="submit" name="ingresar" class="btn btn-primary btn-block" value="Ingresar">
			</form>
		</div>
	</center>
</body>
</html>

<?php
	
	if(isset($_POST['ingresar']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if ($user == "christian" && $pass == "cctur2019") {
			header("Location:admin.php");
		}
		else
		{
			echo "<script>¡Usuario y/o contraseña incorrectos favor de verificar!</script>";
			return false;
		}
	}
	
?>