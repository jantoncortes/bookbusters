<?php
	session_start();
	if(isset($_SESSION['bookbusters']))
	{
	$codusuario = $_SESSION['bookbusters'];
	?>
<!DOCTYPE HTML>
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
<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
	<body class="is-preload">
			<div id="wrapper">
					<div id="main">
						<div class="inner">
								<header id="header">
									<a href="index.php" class="logo"><img style="width: 20%;" src="./../images/logo.png"></a>
									<ul class="icons">
										<li><a href="index.php" class=" fa fa-home" title="Ir a índice"><span class="label"></span></a></abbr></li>										
										<li><a href="#" class=" fa fa-bell" title="Ir a notificaciones"><span class="label"></span></a></abbr></li>
										<li><a href="historial.html" class=" fa fa-book" title="Ir a historial"><span class="label"></span></a></abbr></li>
										<li><a href="index_favoritos.php" class=" fa fa-heart" title="Ir a favoritos"><span class="label"></span></a></abbr></li>
										<li><a href="perfil.php" class=" fa fa-user" title="Ir a perfil"><span class="label"></span></a></abbr></li>
										<li><a href="#" class=" fa fa-dice" title="Ir a juegos"><span class="label"></span></a></abbr></li>
										<li><a href="exit.php" class="fa-solid fa-arrow-right-from-bracket" title="Salir sesión"><span class="label"></span></a></li>
									</ul>
								</header>
<section>
	<div class="carousel">
		<div class="carousel__contenedor">
			<h2>TOP LIBROS</h2>
			<div class="carousel__lista">
			<?php
			include("./php/funciones.php");
			$rec=recoge();
					foreach($rec as $reg){
					$temptit=$reg["titulo_lib"];
					$tempimg=$reg["imagen_lib"];
					$tempcod=$reg["cod_lib"];
					$tempimg=$tempcod."/".$tempimg;
			echo "<div class='carousel__elemento'><img src='./../images/portadas/".$tempimg."' alt='' style='width:40%;border:none;border-radius:5px;'><p>";
			echo $temptit."</p></div>
					";
				}
			?>	
			</div>
			<button aria-label="Anterior" class="carousel__anterior">
				<i class="fas fa-chevron-left"></i>
			</button>
			<button aria-label="Siguiente" class="carousel__siguiente">
				<i class="fas fa-chevron-right"></i>
			</button>
		</div>
		<div role="tablist" class="carousel__indicadores"></div>
	</div>
</section>
	<section>
		<header class="major">
			<h2>Mis Libros</h2>
		</header>
			<div class="posts">
<?php
			$recibe=consulta("libros");
foreach($recibe as $registro){
	$codigodellibromia = $registro["cod_lib"];
	$mirarfavoritos = consulta("favoritos WHERE cod_usu='$codusuario' AND cod_lib='$codigodellibromia'");
	if($mirarfavoritos->fetch_array())
	{
		$apintarcorazon = '<a><font color="red"><i id="'.$registro["cod_lib"].'"  class="fa-solid fa-heart" onclick="addFavCor(this.id)"></i></font></a>';
	}
	else
	{
		$apintarcorazon = '<a><i id="'.$registro["cod_lib"].'"  class="fa-regular fa-heart" onclick="addFavCor(this.id)"></i></a>';
	}
	//sacamos codigo de libro
	//tenemos el codigo de usuario
	// consultadmos a favoritos por libro y usuario
	// crar variable con el corazon
	if($registro["disponible_lib"] == 0)
	{
		//Libro disponbile
		echo'
			<article style="display:flex;flex-direction:column;align-items:center;">
				<a href="verlibro.php?codlib='.$registro["cod_lib"].'" class="image"><img src="./../images/'.$registro["imagen_lib"].'" alt="" /></a>
				<h3>'.$registro["titulo_lib"].'</h3>
				<div style="display:flex; justify-content:space-between">
					<div>
						'.$apintarcorazon.'
					</div>
					<div>
						'.estrella($registro["cod_lib"]).'
					</div>			
				</div>
				<ul class="actions">
					<li><a href="verlibro.php?codlib='.$registro["cod_lib"].'" class="button">Ver</a></li>
					<li style="float:right;margin-left:50%;margin-top:10px;color:lime"><abbr title="Libro disponible">
					<i class="fa fa-book-open fa-beat fa-xl" ></i></abbr></li>			
				</ul>		

			</article>
		';
	}
	else
	{
		//Libro no disponible
		echo'
			<article style="display:flex;flex-direction:column;align-items:center;"">
				<a href="verlibro.php?codlib='.$registro["cod_lib"].'" class="image"><img src="./../images/'.$registro["imagen_lib"].'" alt="" /></a>
				<h3>'.$registro["titulo_lib"].'</h3>
				<div style="display:flex; justify-content:space-between">
					<div>
					'.$apintarcorazon.'
					</div>
					<div>
						'.estrella($registro["cod_lib"]).'
					</div>			
				</div>
				<ul class="actions">
					<li><a href="verlibro.php?codlib='.$registro["cod_lib"].'" class="button">Ver</a></li>
					<li style="float:right;margin-left:50%;margin-top:10px;color:red"><abbr title="Libro NO disponible">
					<i class="fa fa-book-open-reader fa-xl"></i></abbr></li>			
				</ul>		

			</article>
		';
	}
}

?>
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
										<li><a href="./index.php">Inicio</a></li>
										<li><a href="./historial.html">Historial</a></li>
										<li><a href="./index_favoritos.php">Favoritos</a></li>
										<li><a href="./perfil.php">Perfil</a></li>
										<li><a href="#">Juegos</a></li>									
										<li><a href="./exit.php" style='color:red'>Salir</a></li>									
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
									</ul>
								</section>

							
							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>

						</div>
					</div>
			</div>
		<!-- Scripts -->
			<script src="./assets/js/jquery.min.js"></script>
			<script src="./assets/js/browser.min.js"></script>
			<script src="./assets/js/breakpoints.min.js"></script>
			<script src="./assets/js/util.js"></script>
			<script src="./assets/js/main.js"></script>
			<script src="./../assets/js/favoritos.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="./assets/js/app.js"></script>



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