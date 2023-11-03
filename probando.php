<?php
$para = "acmoriscloud@gmail.com";
                                        $asunto = "Valora el libro Bookbusters leido";
                                        $mensaje = '
                                        <html>
                                        <head>
		<title>Editorial by HTML5 UP</title>
		<script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
<link rel="stylesheet" href="assets/css/estilos.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="./assets/css/main.css" />
</head>'."<br>
                                        <div style='display:flex'>
                                                <div>
                                                <img width=5% src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
                                                </div>
                                                <div>
                                                <img width=30% src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>
                                                </div>
                                        </div>
                                        
                                        
                                        
                                        <a href='http://10.10.10.199/bookbusters/mirar.php?c=1'>hdhdhdhd</a>
                                        <i onclick='window.location.href=`http://10.10.10.199/bookbusters/mirar.php?c=2`' class='fa-regular fa-star' style='color:#ff39ba;' aria-hidden='true'></i>
                                        <i onclick='rellena_estrellas(3)' class='fa-regular fa-star' style='color:#ff39ba;' aria-hidden='true'></i>
                                        <i onclick='rellena_estrellas(4)' class='fa-regular fa-star' style='color:#ff39ba;' aria-hidden='true'></i>
                                        <i onclick='rellena_estrellas(5)' class='fa-regular fa-star' style='color:#ff39ba;' aria-hidden='true'></i>
                                        
                                        
                                        ";
                                        $header = "MIME-Version: 1.0 \r\n";
                                        $header .= "Content-type:text/html;charset=UTF-8 \r\n";
                                        $header .= "From: dani@medellin.ef";
                                        mail($para, $asunto, $mensaje, $header);
                                    ?>    