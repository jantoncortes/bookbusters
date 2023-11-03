<!DOCTYPE HTML>
<!-- 
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
 -->
<html>
	<head>
		<title>BookBuster</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><img style="width: 20%;" src="./images/logo.png"></a>
									<ul class="icons">
										<li><a style="font-size:large" href="index.php" class="fa fa-home" aria-hidden="true"><span class="label"></span></a></li>
										<li><a style="font-size:large" href="registro.html" class="fa fa-user-plus" aria-hidden="true"><span class="label"></span></a></li>
										<li><a style="font-size:large" href="login.html" class="fas fa-sign-in-alt" aria-hidden="true"><span class="label"></span></a></li>	
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Bienvenido a "Bookbusters" <br />
											Aquí podrás encontrar tus libros para préstamo </h1>
											<h2>A continuación, te mostramos los libros más demandados</h2>
										</header>
										<p></p>
										<!-- <ul class="actions">
											<li><a href="#" class="button big">Learn More</a></li>
										</ul> -->
									</div>
									<span style=" height:25%; width:25%">
									
										<img src="images/Bookbusters (4)_transparente (1).png" alt="" />
									</span>
								</section>

							<!-- Section -->
								<!-- <section>
									
								</section> -->

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Top 8 libros</h2>
									</header>
									<div class="posts">			
						
                                    <?php
                                            $con=new mysqli("10.10.10.199","busters","1234","biblioteca");

											//cuando existan favoritos, cambiaremos el enlace a la tabla libros, por el de la tabla favoritos
											
                                            // $sql="SELECT * FROM libros ORDER BY RAND() LIMIT 8";
											$sql="SELECT *,count(cod_lib) as cuenta FROM libros INNER JOIN prestamos  using(cod_lib) group By cod_lib ORDER BY cod_lib DESC limit 8";
                                            $ejecutar=$con->query($sql);

                                            foreach($ejecutar as $registro)
                                            {
												$titulo=$registro["titulo_lib"];
												$imagen=$registro["imagen_lib"];
												$codigo=$registro["cod_lib"];
												$imagenmuestra="./images/portadas/$codigo/$imagen";

                                    ?>
												<article>
														<a href="#" class="image"><img src="<?php echo $imagenmuestra ; ?>"></a>
														<h3>Accede</h3>    											
													<ul class="actions">
														<li><a href="login.html" class="button">Login</a></li>
													</ul>
												</article>
                                        	<?php
                                            }
                                            ?>
									</div>
								</section>

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search
								

							<!- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php" style="font-size:medium ;">Inicio</a></li>
										<li><a href="registro.html" style="font-size:medium ;">Registro</a></li>
										<li><a href="login.html" style="font-size:medium">Login</a></li>
									</ul>
								</nav>
								<a href="./admin/login_administrador.html" class="fa fa-lock" style="font-size:30px"></a>
							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Bookbuster</p>
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

	</body>
</html>