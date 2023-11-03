<?php



	$para = "alfonso@medellin.ef";
	$asunto = "Holaaaaa";
	$mensaje = "<h1>mensaje de prueba</h1>
			<br>
			<p>Estamos encantados</p>
			<img src='https://images.hola.com/imagenes/mascotas/20221020219416/razas-perros-toy/1-154-385/razas-de-perro-toy-t.jpg' style='width:20%'>
	";

	$header = "MIME-Version: 1.0 \r\n";
	$header .= "Content-type:text/html;charset=UTF-8 \r\n";
	$header .= "From: informacion@medellin.ef";
	mail($para, $asunto, $mensaje, $header);



?>