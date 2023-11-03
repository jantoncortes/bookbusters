<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Menu de Administrador</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="../index_administrador.php" class="logo"><img style="width: 20%;" src="./../images/logo.png"></a>
									<ul class="icons">
										<li><a href="../index_administrador.php" class=" fa fa-home"><span class="label"></span></a></li>
										<li><a href="#" class=" fa fa-dice"><span class="label"></span></a></li>
										<li><a href="./login_administrador.html" class="fa-solid fa-arrow-right-from-bracket"><span class="label"></span></a></li>
									</ul>
								</header>
								<?php
										session_start();
										if (isset($_SESSION["admin"]))
										{
											$cod = $_SESSION["admin"];
											$con = new mysqli("10.10.10.199", "busters", "1234", "biblioteca");
											$sql = $sql = "SELECT * FROM administradores WHERE cod_adm = '$cod'";
											$tup = $con->query($sql)->fetch_array();
											$nom = $tup["nom_adm"];
											?>
												<h3 class="center-text">Bienvenido, <?php echo $nom ?></h3>
											<?php
										}
										else
										{
											?>
												<script>
													alert("No puedes entrar aquí sin abrir sesión");
													window.location.href="./login_administrador.html";
												</script>
											<?php
											// header("location: './login_administrador.html'");
										}
									?>
							<!-- Section -->
								<section>
									<header class="major">
										<h2>MENÚ DE ADMINISTRADOR</h2>
									</header>
									<div class="features">
										<article>
											<a href="administradores.php"><span class="icon fa-user"></span></a>
											<a href="administradores.php">
												<div class="content">
												<h3>ADMINISTRADORES</h3>
												
												</div>
											</a>
										</article>
										<article>
											<a href="gestion_usu.php"><span class="icon solid fa-users"></span></a>
											<a href="gestion_usu.php">
												<div class="content">
												<h3>GESTIÓN USUARIOS</h3>
												
												</div>
											</a>
										</article>
										<article>
											<a href="./libros.php"><span class="icon solid fa-book"></span></a>
											<a href="./libros.php">
												<div class="content">
												<h3>LIBROS</h3>
												
												</div>
											</a>
										</article>
										<article>
											<a href="entregas_devoluciones.html"><span class="icon solid fa-repeat"></span></a>
											<a href="entregas_devoluciones.html">
												<div class="content">
												<h3>ENTREGAS Y DEVOLUCIONES</h3>
												
												</div>
											</a>
										</article>
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
									<li><a href="../index.php">Inicio</a></li>
									<li><a href="#">Juegos</a></li>
									<li><a href="./login_administrador.html">Salir</a></li>
								</ul>
							</nav>
							<footer id="footer">
								<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
							</footer>
					</div>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>

	</body>
</html>