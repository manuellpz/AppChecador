<?php  
	class servidor
	{
		public $con;
		public function conectar($server,$user,$pass,$bd)
		{
			$con = new mysqli($server,$user,$pass,$bd);
			if($con->connect_errno)
			{
				echo "<script>alert('Ha Ocurrido Un Error en La Base de Datos!!');</script>";
			}
			else
			{
				return $con;
			}
			
		}
	}
?>