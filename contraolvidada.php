<?php

    $ema=$_POST["email"];
    $emacod = base64_encode($_POST["email"]);

    $codunico=uniqid(); //hay que grabarlo en usuarios 

    $con=new mysqli("10.10.10.199","busters","1234","biblioteca");


    $sql="SELECT * FROM usuarios WHERE email_usu='$ema'";
    $ejecutar=$con->query($sql);

    if($registro=$ejecutar->fetch_array())
    {
        $nombre=$registro["nom_usu"];
        $codusu=$registro["cod_usu"];
        $sqlcodunico="UPDATE usuarios SET uniq_usu='$codunico' WHERE cod_usu=$codusu";
        $con->query($sqlcodunico);
        $para = "$ema";
        $asunto = "Generación de nueva contraseña";
        $mensaje = "<h1>Hola $nombre, pincha en el siguiente enlace para cambiar tu contraseña</h1>
                <br>
                <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
                <br>
                <a href='http://10.10.10.199/bookbusters/change.php?envio=$emacod&i=$codunico'>Modifica tu contraseña</a>
                ";

        $header = "MIME-Version: 1.0 \r\n";
        $header .= "Content-type:text/html;charset=UTF-8 \r\n";
        $header .= "From: informacion@medellin.ef";
        mail($para, $asunto, $mensaje, $header);

        header("location:http://10.10.10.199/bookbusters/cambiarpass.html");
    }
    else
    {
        echo "No estás registrado en nuestra web, puedes registrarte ahora";
        header("location:http://10.10.10.199/bookbusters/registro.html");
    }




?>