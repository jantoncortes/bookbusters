<?php
	session_start();
	if(isset($_SESSION["bookbusters"])) {
    ?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Detalle_libro</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
							<header id="header">
                                    <a href="index.php" class="logo"><img style="width: 20%;" src="./../images/logo.png"></a>
									<ul class="icons">
                                        <li><a href="index.php" class=" fa fa-home"><span class="label"></span></a></li>
										<li><a href="notificaciones.php" class=" fa fa-bell"><span class="label"></span></a></li>
										<li><a href="prestamos.php" class=" fa fa-book"><span class="label"></span></a></li>
										<li><a href="index_favoritos.php" class=" fa fa-heart"><span class="label"></span></a></li>
										<li><a href="perfil.php" class=" fa fa-user"><span class="label"></span></a></li>
										<li><a href="juegos.php" class=" fa fa-dice"><span class="label"></span></a></li>
										<li><a href="exit.php" class="fa-solid fa-arrow-right-from-bracket"><span class="label"></span></a></li>
									</ul>
								</header>

							<!-- Banner -->
								

							<!-- Section -->
								<section>
								<div id="acciones" style="width:100%;float:left">
								<?php
    //Se recoge el código del libro recibido por GET de los documentos /privado/index.php y /privado/index_favoritos.php
    $codlibro=$_GET["codlib"]; 
        //Para pruebas sin tener código libro
        //$codlibro=5; 
    //Se obtiene el código de usuario de la sesión denominada bookbusters  
    $codusuario=$_SESSION["bookbusters"];
        //Para pruebas sin tener el código de usuario de la sesión
        //$codusuario=5;
    $conexion=new mysqli("10.10.10.199","busters","1234","biblioteca");
    
    //SQL consulta tabla prestamos para saber si el usuario tiene algún libro prestado sin devolver
    $sqlconsultaprestamo="SELECT * FROM prestamos INNER JOIN libros USING(cod_lib) WHERE cod_usu='$codusuario' AND fentrega_pres!='0000-00-00' AND fdevolucion_pres='0000-00-00'";

    if($regdevolucion = $conexion->query($sqlconsultaprestamo)->fetch_array())
    {
        $codlibdevolucion=$regdevolucion["cod_lib"];
        $titulodevolucion=$regdevolucion["titulo_lib"];
        $fpredevo=explode("-",$regdevolucion["fprevista_pres"]);
        $fechaprevistadevolucion="$fpredevo[2]/$fpredevo[1]/$fpredevo[0]";

?>        
        <label for="" style="color:red">Tienes prestado otro libro pendiente de devolver. Titulo: <?php echo $titulodevolucion;?>, fecha prevista devolución: <?php echo $fechaprevistadevolucion;?></label>
        <br><br>
        <abbr title="Para poder solicitar préstamo de un libro se debe devolver el o los libros prestados anteriormente. Si deseas ver el historial de préstamos haz clic">        
        <button onclick="window.location.href='./historial.html'" style="color:red;">TIENES ALGÚN LIBRO PRESTADO SIN DEVOLVER</button></abbr>
<?php
    }
    else
    {
        //El usuario no tiene ningún libro recogido (entregado al usuario), o no tiene ningún libro pendiente de devolver

        //SQL comprobar si el usuario ya tiene una reserva de préstamo de otro libro pendiente de recoger, de ser entregado al usuario
        $sqlconsultareser="SELECT * FROM prestamos WHERE cod_usu='$codusuario' AND cod_lib!='$codlibro' AND freserva_pres!='0000-00-00' AND fentrega_pres='0000-00-00'";
        if($conexion->query($sqlconsultareser)->fetch_array())
        {
            //El usuario ya tiene reservado un préstamo de otro libro pendiente de ser recogido, ser entregado al usuario, por lo que no puede reservar otro
            //SQL para obtener el nombre del libro reservado y la fecha de reserva
            $sqlreserva="SELECT * FROM prestamos INNER JOIN libros ON prestamos.cod_lib=libros.cod_lib WHERE cod_usu='$codusuario' AND freserva_pres!='0000-00-00' AND fentrega_pres='0000-00-00'";
            $ejesqlreserva=$conexion->query($sqlreserva);
            $regreserva=$ejesqlreserva->fetch_array(); 
            $codlibreserva=$regreserva["cod_lib"];
            $tituloreserva=$regreserva["titulo_lib"];
            $freserva=explode("-",$regreserva["freserva_pres"]);
            $fechareserva="$freserva[2]/$freserva[1]/$freserva[0]";
?>
            <input type="hidden" id="codigootrolibro" value="<?php echo $codlibreserva; ?>">
            <label for="" style="color:red">Tienes reservado préstamo de otro libro pendiente recoger. Titulo: <?php echo $tituloreserva?>, fecha reserva: <?php echo $fechareserva?>. Si lo deseas puedes anular esa reserva.</label>
            <br><br>
            <abbr title="Tienes reservado préstamo de otro libro pendiente de recoger. No se puede realizar esta reserva a no ser que anules la anterior reserva">
            <button onclick="anularotrareservaprestamo()">ANULAR RESERVA PRÉSTAMO OTRO LIBRO</button></abbr>  
            
<?php
        }
        else
        {
            //El usuario no tiene ninguna reserva de libro pendiente, ni tiene ningún libro pendiente de devolver
        
            //SQL consulta si el libro si está disponible (0) o no está disponible (1)
            $sqllibrodis="SELECT * FROM libros WHERE cod_lib='$codlibro' AND disponible_lib=0";
            $ejesqllibrodis=$conexion->query($sqllibrodis);          
            if($ejesqllibrodis->fetch_array())
            {
                //Libro disponible (campo disponible_lib=0 de la tabla libros)       
?>
                <label for="" style="color:green">Si deseas reservar préstamo de este libro haz clic en "SOLICITAR PRÉSTAMO LIBRO"</label>
                <br><br>
                <button onclick="reservaprestamo()">SOLICITAR PRÉSTAMO LIBRO</button>          
<?php
            }
            else
            {
                //Libro no disponible (campo disponible_lib=1 de la tabla libros)

                //Se comprueba en la tabla prestamos si el libro ya había sido entretado, prestado, o acaba de ser reservado 
                //por el usuario que está consultando el detalle del libro (verlibro.php), para dar opción a anular reserva
                //SQL tabla préstamos consultando por código de libro, código usuario y si no tiene echa entrega,
                //es decir, este usuario ha reservado el libro, que no ha sido entregado, dándo la opción de anular reserva
                $sqlprestamo = "SELECT * FROM prestamos WHERE cod_usu='$codusuario' AND cod_lib='$codlibro' AND fentrega_pres='0000-00-00'";
                $ejesqlprestamo = $conexion->query($sqlprestamo);
                if($ejesqlprestamo->fetch_array())
                {
                    //El libro ya había sido reservado por el usuario y no ha sido entregado, no ha sido recogido. Se permite anular la reserva.
?>
                    <label for="" style="color:red">Tienes reservado préstamo de este libro pendiente de recoger. Si lo deseas puedes anular esta reserva.</label>
                    <br><br>
                    <abbr title="Tienes reservado el préstamo de este libro que está pendiente de ser recogido (la reserva la acabas de realizar o ya la la habías realizado anteriormente). Si lo deseas puedes anular esta reserva">
                    <button onclick="anularreservaprestamo()">ANULAR RESERVA PRÉSTAMO LIBRO</button></abbr>
<?php
                }
                else
                {
                    //El libro no está disponible, no ha sido reservado por el usuario, no se ha devuelto
?>            
                    <label for="" style="color:red">Este libro ya está prestado o está reservado por otro usuario. Puedes solicitar reserva préstamo de otro libro haciendo clic en "LIBRO NO DISPONIBLE" o ir a Indice</label>
                    <br><br>
                    <abbr title="Ir a Indice para seleccionar libro disponible">
                    <button onclick="window.location.href='./index.php'">LIBRO NO DISPONIBLE</button></abbr>    
<?php
                }        

            }
        }    
    }    
    //SQL consulta si el usuario ya tiene este libro como favorito
    $sqlfavorito="SELECT * FROM favoritos WHERE cod_usu='$codusuario' AND cod_lib='$codlibro'";
    $ejesqlfavorito=$conexion->query($sqlfavorito);
    if($ejesqlfavorito->fetch_array())
    {
        //El usuario ya tiene este libro como favorito. Se da como opción quitar de la lista de favoritos del usuario.
?>
        <abbr title="libro en favoritos (haz clic para dar de baja de favortios)">
            <i class="fa fa-heart-circle-minus fa-2xl" id="favoritobaja" onclick="quitarfavoritos()" style="color:red;"></i></abbr>
        <hr>       
<?php
    }
    else
    {
        //El usuario no tiene este libro como favorito y lo puede añadir a la lista de favoritos del usuario.
?>
        <abbr title="añadir a favoritos"><i class="fa fa-heart-circle-plus fa-2xl" id="favoritoalta" onclick="favorito()"></i></abbr>
        <hr>        
<?php
    }

    //SQL consulta datos del libro tabla libros 
    $sqllibro="SELECT * FROM libros WHERE cod_lib='$codlibro'";
    $ejesqllibro=$conexion->query($sqllibro);
    $reg=$ejesqllibro->fetch_array();
    //Obetener del array (fetch_array()) los datos a presentar
    $isbnlibro=$reg["isbn_lib"];      
    $titlibro=$reg["titulo_lib"];
    $subtitlibro=$reg["subtitulo_lib"];    
    $autorlibro=$reg["autor_lib"];
    $editlibro=$reg["editorial_lib"];      
    $genlibro=$reg["genero_lib"];
    $resumenlibro=$reg["resumen_lib"];
    $idiomalibro=$reg["idioma_lib"];
    $pagslibro=$reg["paginas_lib"];
    $imgagenlibro=$reg["imagen_lib"];

    //SQL consulta el género del libro en la tabla generos
    $sqlcateg="SELECT * FROM generos WHERE genero_lib='$genlibro'";
    $ejecateg=$conexion->query($sqlcateg);
    $regcat=$ejecateg->fetch_array();
    //Obetener del array (fetch_array()) el nombre del género a presentar
    $nomgenlibro=$regcat["nom_gen"];
    
    //Para probar mientras no se tenga nombre de imagen en BBDD
        //$imgagenlibro= "libro.jpg";
    
?>     
    <!-- Etiquetas input's ocultas (hidden) para las variables código libro y código usuario 
        (que se obtiene de la sesión, para las funciones JavaScript) -->
    <input type="hidden" id="codigolibro" value="<?php echo $codlibro; ?>">
    <input type="hidden" id="usuar" value="<?php echo $codusuario; ?>">
	</div>




	<div id="imglibro" style="float:left;margin-right:5%;">
        <img src="../images/portadas/<?php echo $codlibro; ?>/<?php echo $imgagenlibro; ?>" style="max-width:80%" alt="">     
    </div>
    <div id="datos1" style="margin-right: 20%; float:left;">
        <label>Título</label><p><?php echo $titlibro; ?></p>
        <label>Subtítulo</label><p><?php echo $subtitlibro; ?></p>
        <label>Autor</label><p><?php echo $autorlibro; ?></p>
        <label>Género</label><p><?php echo $nomgenlibro; ?></p>  
    </div>
    <div id="datos2" style="margin-left: 5%;">
        <label>Editorial</label><p><?php echo $editlibro; ?></p>
        <label>ISBN</label><p><?php echo $isbnlibro; ?></p>
        <label>Páginas</label><p><?php echo $pagslibro; ?></p>
        <label>Idioma</label><p><?php echo $idiomalibro; ?></p>    
    </div>
    <div id="datos3">
    <label>Resumen</label><p><?php echo $resumenlibro; ?></p>
    </div>






						</section>
				</div>
		</div>

				<!-- Sidebar -->
                <div id="sidebar" class="inactive">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="#">
										<input type="text" name="query" id="query" placeholder="Search" />
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php">Inicio</a></li>
										<li><a href="historial.html">Historial</a></li>
										<li><a href="index_favoritos.phhp">Favoritos</a></li>
										<li><a href="perfil.php">Perfil</a></li>
										<li><a href="#">Juegos</a></li>
										<li><a href="exit.php">Salir</a></li>
									</ul>
								</nav>
                                <section>
									<header class="major">
										<h2>Contáctanos</h2>
									</header>
									<p>Estamos abiertos en horario lectivo de la Escuela de Finanzas EFF Bussines School de Oleiros</p>
									<ul class="contact">
                                    <li class="icon solid fa-envelope"><a href="C:\Program Files\Mozilla Thunderbird\thunderbird.exe">alfonso@medellin.ef</a></li>
										<li class="icon solid fa-phone">(981) 87 86 34</li>
										<li class="icon solid fa-home">Dirección: Rúa Salvador de Madariaga, 50, 15173 Oleiros, A Coruña</li>
										<li class="icon solid fa-book"><a href="terminosuso.php">Terminos de uso</a></li>	
										<li class="icon solid fa-newspaper"><a href="polpriv.php">Politica de Privacidad</a></li>
								</section>
								<footer id="footer">
									<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            <script>
    //Función para dar de alta solicitud reserva préstamo libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)   
    function reservaprestamo()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamos.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                window.location.href='reservado.php?codlib='+codlib;                
            }
        );
    }

    //Función para anular reserva préstamo libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function anularreservaprestamo()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                window.location.href='reservaanulacion.php?codlib='+codlib;               
            }
        );
    }

    //Función para anular la reserva préstamo de otro libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function anularotrareservaprestamo()
    {
        var codlib = $("#codigootrolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                window.location.href='reservaanulacion.php?codlib='+codlib;   
            }
        );
    }

    //Función para dar de alta como favorito el libro en tabla favoritos BBDD biblioteca
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)  
    function favorito()
    {
    
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();
        $.post(
            "./php/favoritosalta.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                window.location.href='favoritoalta.php?codlib='+codlib;
                // alert(respuesta);
                // window.location.href='./verlibro.php';
            }
        );
    }

    //Función para dar de baja como favorito el libro en tabla favoritos BBDD biblioteca
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function quitarfavoritos()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();
        $.post(
            "./php/favoritosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                window.location.href='favoritobaja.php?codlib='+codlib;
                // alert(respuesta);
                // window.location.href='./verlibro.php';
            }           
        );
    }
</script>  

	</body>
</html>
<?php
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