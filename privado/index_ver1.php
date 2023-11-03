<?php
	session_start();
if(isset($_SESSION['bookbusters']))
	{
?>
	<!DOCTYPE HTML>
	<html>
		<head>
	<style>
	html, body {
	margin: 0;
	padding: 0;
	}

	.pic-ctn {
	width: 100vw;
	height: 300px;
	}

	@keyframes display {
	0% {
		transform: translateX(200px);
		opacity: 0;
	}
	10% {
		transform: translateX(0);
		opacity: 1;
	}
	20% {
		transform: translateX(0);
		opacity: 1;
	}
	30% {
		transform: translateX(-200px);
		opacity: 0;
	}
	100% {
		transform: translateX(-200px);
		opacity: 0;
	}
	}

	.pic-ctn {
	position: relative;
	width: 100vw;
	height: 300px;
	margin-top: 10vh;
	}

	.pic-ctn > img {
	position: absolute;
	top: 0;
	left: calc(50% - 100px);
	opacity: 0;
	animation: display 10s infinite;
	}

	img:nth-child(2) {
	animation-delay: 2s;
	}
	img:nth-child(3) {
	animation-delay: 4s;
	}
	img:nth-child(4) {
	animation-delay: 6s;
	}
	img:nth-child(5) {
	animation-delay: 8s;
	}

</style>
		<title>Bookbusters</title>
		<script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
<link rel="stylesheet" href="assets/css/estilos.css">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="./assets/css/main.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
	<body class="is-preload">
			<div id="wrapper">
					<div id="main">
						<div class="inner">
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
<section>
	<div class="carousel">
		<div class="carousel__contenedor">
			<h2>TOP LIBROS</h2>
			<div class="carousel__lista">
			<?php
			include("./php/funciones.php");
			$rec=recoge();
					foreach($rec as $reg)
					{
					$temptit=$reg["titulo_lib"];
					$tempimg=$reg["imagen_lib"];
					$tempcod=$reg["cod_lib"];

					$tempimg=$tempcod."/".$tempimg;
					//echo $tempimg;
					echo "<div class='carousel__elemento'><img src='./../images/portadas/".$tempimg."' alt='' style='width:70%;height:300px;border:none;border-radius:5px;'><p>";
					echo $temptit."</p></div>";
					}
				conex()->close();
			?>	
			</div>
			<div>
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
	<div class="pic-ctn">
		<?php
			$rec=recoge();
			foreach($rec as $reg)
			{
				$temptit=$reg["titulo_lib"];
				$tempimg=$reg["imagen_lib"];
				$tempcod=$reg["cod_lib"];
				$tempimg=$tempcod."/".$tempimg;
				//echo $tempimg;
				echo "<img src='./../images/portadas/".$tempimg."' alt='' style='width:30%;height:100px;border:none;border-radius:5px;'><p>";
				echo $temptit."</p>";
			}
			conex()->close();
		?>	
  </div>


</section>

	<section>
		<header class="major">
			<h2>Mis Libros</h2>
		</header>
			<div class="posts">
<?php
	$recibe=consulta("libros");
	foreach($recibe as $registro)
	{
		$tempimg=$registro["imagen_lib"];
		$tempcod=$registro["cod_lib"];
		$tempimg=$tempcod."/".$tempimg;
		if($registro["disponible_lib"] == 0)
		{
			echo'
				<article >
					<a href="#" class="image"><img src="./../images/portadas/'.$tempimg.'" alt="" style="width:100%;height:480px;border:none;border-radius:5px;" /></a>
					<h3>'.$registro["titulo_lib"].'</h3>
					<div style="display:flex; justify-content:space-between">
						<div>
							<a><i id="'.$registro["cod_lib"].'"  class="fa-solid fa-heart" onclick="addFavCor(this.id)"></i></a>
						</div>
						<div width="20%">
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
			echo'
				<article >
					<a href="#" class="image"><img src="./../images/portadas/'.$tempimg.'" alt="" style="width:100%;height:480px;border:none;border-radius:5px;" /></a>
					<h3>'.$registro["titulo_lib"].'</h3>
					<div style="display:flex; justify-content:space-between">
						<div>
							<a><i id="'.$registro["cod_lib"].'"  class="fa-solid fa-heart" onclick="addFavCor(this.id)"></i></a>
						</div>
						<div width="20%">
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
conex()->close();
	

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
										<li><a href="index.php">Inicio</a></li>
										<li><a href="historial.html">Historial</a></li>
										<li><a href="index_favoritos.php">Favoritos</a></li>
										<li><a href="#">Perfil</a></li>
										<li><a href="#">Juegos</a></li>
										<li><a href="#">Salir</a></li>
									</ul>
								</nav>
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
			<script src="./assets/js/favoritos.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="./assets/js/app.js"></script>
</body>
</html>
<?php

}
	else
	{
		header("location:./../login.html");
	}
	?>
