<?php

    //Datos provenientes de registro.php

    $mail=base64_decode($_GET["mail"]);

    $con=new mysqli("10.10.10.199","busters","1234","biblioteca");

    $sql="UPDATE usuarios SET activo_usu=1 WHERE email_usu='$mail'";

    if($con->query($sql))
    {
        $consultar = "SELECT * FROM usuarios WHERE email_usu='$mail'";
		$ejecutar = $con->query($consultar);
		$registro = $ejecutar->fetch_array();
		$cod = $registro["cod_usu"];
        
        // $cod = $con->insert_id;

        //mkdir("./images/avatares/$cod",0777);	no vamos a crear una carpeta cada vez que se registre el usuario
        
        // usuario activado, le enviamos otro correo de confirmacion

        
	$para = "$mail";
	$asunto = "Su cuenta de bookbusters se ha activado";
	$mensaje = "<h1>Bienvenido a Bookbusters</h1>
			<br>
            <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
            <br>
            <p>Ya puedes acceder a tu cuenta pinchando en el siguiente enlace</p>
            <br>
            <a href='http://10.10.10.199/bookbusters/login.html'>Accede a Bookbusters</a>
			";

	$header = "MIME-Version: 1.0 \r\n";
	$header .= "Content-type:text/html;charset=UTF-8 \r\n";
	$header .= "From: informacion@medellin.ef";
	mail($para, $asunto, $mensaje, $header);

    header("location:http://10.10.10.199/bookbusters/login.html");


    }
    else
    {
        //no se ha activado, enviamos mail de error
        $para = "$mail";
        $asunto = "Su cuenta de bookbusters NO se ha activado";
        $mensaje = "<h1>Consulte con el Administrador</h1>
                <br>
                <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
                ";

        $header = "MIME-Version: 1.0 \r\n";
        $header .= "Content-type:text/html;charset=UTF-8 \r\n";
        $header .= "From: informacion@medellin.ef";
        mail($para, $asunto, $mensaje, $header);

    }

?>