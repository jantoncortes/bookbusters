<?php
session_start();
if(isset($_SESSION['bookbusters']))
{
	$cod = $_GET["codlib"];

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Bookbusters</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta http-equiv="refresh" content="8;url=http://10.10.10.199/bookbusters/privado/verlibro.php?codlib=<?php echo $cod;?>">
		<link rel="stylesheet" href="./../assets/css/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
								<section id="banner">
									<div class="content">
										<header>
											<center><h1>Reserva anulada!</h1></center>
									<p><center>Hemos recibido tu anulación de la reserva del libro. Recibirás un correo confirmando la anulación reserva!</p>
										
										<img style="width: 20%;" src="./../images/Bookbusters (1).png" alt="" />
										<center>
											<a href="verlibro.php?codlib=<?php echo $cod;?>" class="button primary">Volver</a>
														
										</center>
										</header>
										
									</div>
									
										
									
								</section>

							<!-- Section -->
				</div>				

			</div>

		<!-- Scripts -->
			<script src="./../assets/js/jquery.min.js"></script>
			<script src="./../assets/js/browser.min.js"></script>
			<script src="./../assets/js/breakpoints.min.js"></script>
			<script src="./../assets/js/util.js"></script>
			<script src="./../assets/js/main.js"></script>

	</body>
</html>
<?php
}
else
{
	header("location:./../login.html");
}
?>