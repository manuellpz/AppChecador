<?php 
	include "conexion.php";

	if(isset($_POST['checar']))
	  {
	  	function alumno()
	  	{
	  		$server = new servidor();
			$con = $server->conectar("localhost","root","","checador");

		    $alumno = $_POST['alumnos'];

		    $sql = "SELECT prestadores.nombre AS prestador,horasrestantes,fechaChecado,entrada,salida FROM statusprestador INNER JOIN prestadores ON prestadores.idPrestador = statusprestador.prestador WHERE statusprestador.prestador = $alumno";
		    $res = $con->query($sql);
		    while($reg = $res->fetch_assoc())
		    {
		    	echo "<tr>";
		    	echo "	<td>".$reg['prestador']."</td>";
		    	echo "	<td>".$reg['horasrestantes']."</td>";
		    	echo "	<td>".$reg['fechaChecado']."</td>";
		    	echo "	<td>".$reg['entrada']."</td>";
		    	echo "	<td>".$reg['salida']."</td>";
		    	echo "</tr>";
		    }
	  	}

	  }
?>

<html>
<head>
	<title>Status Alumno</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://manuellpz.github.io/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body class="bgAdmin">
	 <center>
	 	<h1>Consulta de Alumno</h1>
		 <button onclick="window.location.href='./admin.php'" class="btn btn-sm btn-warning">Regresar</button>
	 </center><br>

	 <table class="table table-dark table-hover tabla">
	    	<th>Prestador</th>
	    	<th>Horas Restantes</th>
	    	<th>Fecha Checado</th>
	    	<th>Entrada</th>
	    	<th>Salida</th>
	    	<?php echo alumno(); ?>
	 </table>
	 <br><br>
	 <!-- <input type="button" class="btn btn-danger" id="regresar" value="Regresar"> -->
	 <script src="js/funciones.js"></script>
</body>
</html>