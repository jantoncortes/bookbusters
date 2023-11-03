<?php

	$nom = ucfirst($_POST["nombre"]);
	$ap1 = ucfirst($_POST["ap1"]);
	$ap2 = ucfirst($_POST["ap2"]);
	$ema=$_POST["email"];
	$emacod = base64_encode($_POST["email"]);
	$pass = $_POST["pass"];
	$activo = 0;
	$imagen ="http://10.10.10.199/bookbusters/images/Bookbusters (1).png";
	$falta = date("Y-m-d");

$pass = password_hash($pass, PASSWORD_DEFAULT);

$conexion = new mysqli("10.10.10.199", "busters", "1234", "biblioteca");
$consulta = "SELECT * FROM usuarios WHERE email_usu='$ema'";

$ejcon = $conexion->query($consulta);

if ($ejcon->fetch_array())
{
	//Este usuario existe
	echo 'Usuario ya existente';
	header("location:login.html");
}
else
{
	//Este usuario no existe
	$sql = "INSERT INTO usuarios(nom_usu, ap1_usu, ap2_usu, email_usu, pass_usu, activo_usu, img_usu, falta_usu) VALUES ('$nom', '$ap1', '$ap2', '$ema', '$pass', '$activo', '$imagen', '$falta')";
	$conexion->query($sql);

	$para = "$ema";
	$asunto = "Active su cuenta de Bookbusters";
	$mensaje = "<h1>Activación de cuenta</h1>
			<br>
            <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
            <br>
            <p>Para activar su cuenta pinche el siguiente enlace</p>
            <br>
            <a href='http://10.10.10.199/bookbusters/activacion.php?mail=$emacod'>Active su cuenta</a>
			";

	$header = "MIME-Version: 1.0 \r\n";
	$header .= "Content-type:text/html;charset=UTF-8 \r\n";
	$header .= "From: informacion@medellin.ef";
	mail($para, $asunto, $mensaje, $header);

    // header ("location:http://10.10.10.199/bookbusters/activacion.php");
	header ("location:http://10.10.10.199/bookbusters/registrado.html");

}

?>