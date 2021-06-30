<?php
    include "conexion.php";
    $server = new servidor();
    $con = $server->conectar("localhost","root","","checador");

    function alumnos()
    {
        global $server;
        global $con;

      $sql = "SELECT idPrestador,nombre FROM prestadores";
      $resultado = $con->query($sql);

      while($reg = $resultado->fetch_assoc())
      {
        echo "<option value=".$reg['idPrestador'].">".$reg['nombre']."</option>";
      }
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://manuellpz.github.io/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="bgAdmin">
    <center>
       <div class="contain">
          <h2>Administrador</h2><br><br>
           <form action="" method="post">
               <input type="text" name="name" class="form-control" placeholder="Nombre Completo: " required><br>
               <input type="text" name="horasPrestar" placeholder="Horas a prestar: " class="form-control" required><br>
               <input type="text" name="school" placeholder="Escuela: " class="form-control" required><br>
               <label>Fecha Inicio: </label><input type="date" name="fechainicio" class="form-control" placeholder="Fecha inicio" required><br>
               <label>Fecha Finalizaciòn: </label><input type="date" name="fechafinal" class="form-control" placeholder="Fecha Final" required><br>
               <input type="submit" name="add" value="Agregar" class="btn btn-success">
               <input type="button" value="Salir" id="exit" class="btn btn-danger">   
           </form>
           <br><br><br>
           <form action="consultaAlumno.php" method="post">
             <select name="alumnos" class="form-control">
               <?= alumnos(); ?>
             </select>
             <input type="submit" name="checar" class="btn btn-danger" value="Checar">
           </form>
       </div>
    </center>
    <script>
        let btn = document.getElementById("exit");

        btn.addEventListener("click",()=>{
            let salir = confirm("Estas seguro de salir? ");
            if(salir)
            {
                window.location.href = "index.php";
            }
        });
    </script>
</body>
</html>

<?php
  if(isset($_POST['add']))
  {
    $name = $_POST['name'];
    $hp = $_POST['horasPrestar'];
    $escuela = $_POST['school'];
    $fi = $_POST['fechainicio'];
    $ff = $_POST['fechafinal'];
    

    $sql = "INSERT INTO prestadores(nombre,totalhoras,escuela,fechaInicio,fechaFin) VALUES('$name','$hp','$escuela','$fi','$ff')";
    $con->query($sql);

    echo "<script>alert('¡Has agregado un nuevo prestador!');</script>";
    mysqli_close($con);
  }
?>