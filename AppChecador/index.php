<?php  
	include "conexion.php";
	$server = new servidor();
	$con = $server->conectar("127.0.0.1","root","","checador");

	function lista()
	{
        global $server, $con;

		$sql = "SELECT idPrestador,nombre FROM prestadores";
		$res = $con->query($sql);

		while($reg = $res->fetch_assoc())
		{
			echo "<option value=".$reg['idPrestador'].">".$reg['nombre']."</option>";
		}
	}

    function lastStatus($prestador)
    {
        global $con;
        $sql = "SELECT MAX(idStatus) AS idStatus FROM statusprestador WHERE prestador=$prestador";
        $result = $con->query($sql);
        while($reg = $result->fetch_assoc())
        {
            $id = $reg['idStatus'];
        }
        return $id;
    }

    function checkInput($prestador)
    {
        global $con;
        $fecha = date("Y-m-d");
        $sql = "SELECT entrada FROM statusprestador WHERE prestador=$prestador AND fechaChecado=$fecha";
        $resultado = $con->query($sql);
        while($registro = $resultado->fetch_assoc())
        {
            if(empty($registro['entrada']))
            {
                return false;
            }else
            {
                return true;
            }
        }
    }

    function existPrestador($prestador)
    {
        global $con;
        $sql = "SELECT * FROM statusprestador WHERE prestador=$prestador";
        $resultado = $con->query($sql);
        if(mysqli_num_rows($resultado))
        {
            $existe = true;
        }
        return $existe;       
    }

    function checkExit($prestador)
    {
        global $con;
        $fecha = date("Y-m-d");
        $sql = "SELECT salida FROM statusprestador WHERE prestador=$prestador AND fechaChecado='$fecha'";
        $resultado = $con->query($sql);
        while($registro = $resultado->fetch_assoc())
        {
            if(empty($registro['salida']))
            {
                $checo = false;
            }
            else
            {
                $checo = true;
            }
        }
        return $checo;
    }

    function subtractHours($prestador)
    {
        global $con;
        $sql = "SELECT horasrestantes,entrada,salida FROM statusprestador WHERE prestador=$prestador";
        $resultado = $con->query($sql);
        while($reg = $resultado->fetch_assoc())
        {
            $entrada = $reg['entrada'];
            $salida = $reg['salida'];
            $horasrestantes = $reg['horasrestantes'];
            
            $es = $salida - $entrada;
            
            $hr = $horasrestantes - $es;
        }
        $sql = "UPDATE statusprestador SET horasrestantes=$hr WHERE prestador=$prestador";
        $con->query($sql);
    }

    function checkFecha($prestador)
    {
        global $con;
        $sql = "SELECT MAX(fechaChecado) AS fechaChecado FROM statusprestador WHERE prestador=$prestador";
        $res = $con->query($sql);
        while($reg = $res->fetch_assoc())
        {
            $date = $reg['fechaChecado'];
        }
        return $date;
    }

    

    function statusAlumnos()
    {
            global $con;
            date_default_timezone_set('America/Mazatlan');
            $fecha = date("Y-m-d");

            $sql = "SELECT prestadores.nombre AS prestador,horasrestantes,fechaChecado,entrada,salida FROM statusprestador INNER JOIN prestadores ON prestadores.idPrestador = statusprestador.prestador WHERE statusprestador.fechaChecado='$fecha'";
            $res = $con->query($sql);

            while($reg = $res->fetch_assoc())
            {
                echo "<tr>";
                echo "  <td>".$reg['prestador']."</td>";
                echo "  <td>".$reg['horasrestantes']."</td>";
                echo "  <td>".$reg['fechaChecado']."</td>";
                echo "  <td>".$reg['entrada']."</td>";
                echo "  <td>".$reg['salida']."</td>";
                echo "</tr>";
            }
    }

    function getHours($prestador)
    {
        global $con;

        $sql = "SELECT MIN(horasrestantes) AS horasrestantes FROM statusprestador WHERE prestador=$prestador";
        $result = $con->query($sql);

        while($reg = $result->fetch_assoc())
        {
            $hr = $reg['horasrestantes'];
        }
        return $hr;
    }

    function getAllHours($prestador)
    {
        global $con;

        $sql = "SELECT totalhoras FROM prestadores WHERE idPrestador=$prestador";
        $result = $con->query($sql);
        while($reg = $result->fetch_assoc())
        {
            $hr = $reg['totalhoras'];
        }
        return $hr;
    }
?>

<html>
<head>
	<title>Checador</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://manuellpz.github.io/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <input type="button" value="Administrador" class="btn btn-success" id="btnLogin">
	<img src="img/logoUAS.png" class="imagen">
	<center>
		<div class="contenedor">
		    <form action="" method="post">
		        <span id="hora" class="reloj"></span><span class="reloj">:</span>
		        <span id="min" class="reloj"></span><span class="reloj">:</span>
		        <span id="seg" class="reloj"></span><br>
		        <select name="prestadores" class="form-control lista">
		        	<?= lista(); ?>
		        </select>
		        <input type="hidden" name="h" id="h">
			    <input type="hidden" name="m" id="m">
			    <input type="hidden" name="s" id="s">
			    <input type="submit" value="Checar" name="check" id="check" class="btn btn-danger">
		    </form>
		</div>
        <br><br><br><br>
            <table class="table table-dark tabla">
                <thead>
                    <tr>
                        <th>Prestador</th>
                        <th>Horas Restantes</th>
                        <th>Fecha Checado</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?= statusAlumnos(); ?>
                </tbody>              
                
             </table>
	</center>
	<script src="js/funciones.js"></script>
</body>
</html>


<?php
    if(isset($_POST['check']))
    {
        global $con;
        date_default_timezone_set("America/Mazatlan");
        
        $prestador = $_POST['prestadores'];
        $horaChecado = date("G:i:s");
        $fechaChecado = date("Y-m-d");
        $hr = getHours($prestador);
        $allHr = getAllHours($prestador);
        
        if(!existPrestador($prestador)) //Si es la primera vez que se checa un usuario
        {
            $sql = "INSERT INTO statusprestador(prestador,horasrestantes,fechaChecado,entrada,salida) VALUES('$prestador','$allHr','$fechaChecado','$horaChecado','')";
            $con->query($sql);

            print "<h3 class='alert-success text-center'>Has checado tu entrada!</h3>";
        }
       else if(checkInput($prestador)==true) //Si ya checo la entrada
       {
           $sql = "INSERT INTO statusprestador(prestador,horasrestantes,fechaChecado,entrada,salida) VALUES($prestador,'$hr','$fechaChecado','$horaChecado','')";
           $con->query($sql);
           print "<h3 class='alert-success text-center'>Has Checado Tu Entrada!!</h3>";
       }
        else if(checkFecha($prestador) != $fechaChecado)
        {
            $sql = "INSERT INTO statusprestador(prestador,horasrestantes,fechaChecado,entrada,salida) VALUES($prestador,$hr,'$fechaChecado','$horaChecado','')";
            $con->query($sql);

            //print "<script>alert('Has checado tu entrada')</script>";
            print "<h3 class='alert-success text-center'>Has checado tu entrada!!</h3>";
        }
        else if(checkExit($prestador)==false) //Si no ha checado la salida
        {
            $sql = "UPDATE statusprestador SET salida='$horaChecado' WHERE prestador=$prestador";
            $con->query($sql);
            print "<script>alert('Has checado la salida!!');</script>";
            subtractHours($prestador);
        }else if(checkInput($prestador)==true && checkExit($prestador)==true) //Si ya checo la entrada y salida ya no puede checar màs.
        {
            print "<h3 class='alert-danger text-center'>No puedes volver a checar la salida, Intentalo Mañana!!</h3>";
            return false;
        }
        else
        {
            print "<h3 class='alert-danger text-center'>No puedes volver a checar la salida, Intentalo Mañana!!</h3>";
            return false;
        }
        header("Location:index.php");

    }
?>