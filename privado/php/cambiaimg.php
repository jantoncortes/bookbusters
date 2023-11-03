<?php
session_start();
if(isset($_SESSION['bookbusters']))
{
    $codusuario = $_SESSION['bookbusters'];
    $imagen = $_POST["pic"];

    $conexion = new mysqli ("10.10.10.199","busters","1234","biblioteca");
    $buscaimg = "update usuarios set img_usu = '$imagen' where cod_usu = $codusuario";
    $conexion->query($buscaimg);
}
else
{
	echo "
		<script>
			alert('Area restringida');
			window.location.href='../login.html';
		</script>
	";
}

?>