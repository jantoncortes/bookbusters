<?php



	session_start();
	if(isset($_SESSION['bookbusters']))
	{
		 $con=$_POST["contrasena"];
		 $hash= password_hash($con, PASSWORD_DEFAULT);

		$codusuario = $_SESSION['bookbusters'];
	

		$conexion = new mysqli ("10.10.10.199","busters","1234","biblioteca");

		$sql= "UPDATE usuarios SET pass_usu ='$hash' Where cod_usu='$codusuario'";
	if($conexion->query($sql))
		{
		
		echo "<script> alert('Contraseña Cambiada con éxito'); </script>";
		
		}


		else
		{
			echo"Ha ocurrido un error";
		}

	}
	
	$var = "Hola Pepe";


	
		

?>
<html>
			<center><button onclick="window.location.href='perfil.php'">VOLVER</button></center>

	</html>
