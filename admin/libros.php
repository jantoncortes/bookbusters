<?php
session_start();
if (isset($_SESSION["admin"])) {
?>

	<!DOCTYPE HTML>
	<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
	<html>

	<head>
		<title>Administradores</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.4.0/jquery.quicksearch.min.js" integrity="sha512-EftvELo+CRsl6dER2p2FfP6JnueIg2g4i9zz3P42S5eTrtMLybcJ7D4+Sk9BlztI6sGutndC2vx2Pd4FcjgDhQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<style>
			tr.datos:hover {
				background-color: lightgrey;
			}
		</style>
	</head>

	<body class="is-preload">

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Main -->
			<div id="main">
				<div class="inner">

					<!-- Header -->
					<header id="header">
						<a href="./index_administrador.php" class="logo"><img style="width: 20%;" src="./../images/logo.png"></a>
						<ul class="icons">
							<li><a href="./index_administrador.php" class=" fa fa-home"><span class="label"></span></a></li>
							<li><a href="#" class=" fa fa-dice"><span class="label"></span></a></li>
							<li><a href="./login_administrador.html" class="fa-solid fa-arrow-right-from-bracket"><span class="label"></span></a></li>
						</ul>
					</header>

					<!-- Content -->
					<section>
						<header class="main">
							<h2>Libros</h2>
							<div class="row">
								<div class="col-1">
								<abbr title="Volver"><i class="fa-solid fa-circle-arrow-left" style="font-size: 2.5em;cursor:pointer;" onclick="window.location.href='./index_administrador.php'"></i> </abbr>
								</div>
								<div class="col-9">
									<input type="text" name="aut" placeholder="Buscar..." >
								</div>
								<div class="col-2">
								<button class="primary" style="width: 100%;" onclick="window.location.href='altalibrosform.php'">Alta libro</button> 
								</div>								
														
							</div>
						</header>

						<hr class="major" />

						<!-- Elements -->
						<div class="row gtr-200">

							<body>
								<table border="1" style="margin-left:5%;margin-right:5%">
									<thead>
										<tr>
											<th>#</th>
											<th>Portada</th>
											<th>ISBN</th>
											<th>Título</th>
											<th>Disponible</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$contador = 0;
											$conexion=new mysqli("10.10.10.199","busters","1234","biblioteca");
											$buslib = "SELECT cod_lib, isbn_lib, titulo_lib, disponible_lib, imagen_lib FROM libros";
											$ejlib = $conexion->query($buslib);
											foreach ($ejlib as $reglib) 
											{
													$contador++;
													$portada = "./../images/portadas/".$reglib['cod_lib']."/".$reglib['imagen_lib'];
													if($reglib["disponible_lib"]==0)
													{
														$icono = '<font color="green"><i class="fa-solid fa-circle"></i>';
													} 
													else
													{
														$icono = '<font color="red"><i class="fa-solid fa-circle"></i>';	
													}	
											?>
											<tr>
												<td><?php echo $contador;?></td>
												<td style="margin:5px, "><?php echo "<img src='$portada' height='50' style='border-radius: 10px; vertical-align: middle'>" ?></td>
												<td><?php echo $reglib["isbn_lib"];?></td>
                        						<td><?php echo $reglib["titulo_lib"];?></td>
                        						<td><?php echo $icono;?></td>
                        						<td>
                        							<i  class="fa-solid fa-edit" style="cursor:pointer;" onclick="" onmouseover="pintar(this.id)" ></i>
                                        			<i  class="fa-solid fa-trash-can bs-danger" style="cursor:pointer;" onclick = "" ></i>
                            					</td>
                        					</tr>	
                        			<?php
                        					}
                        			?>
										
										
									</tbody>
								</table>

							</body>
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

		</div>

		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/browser.min.js"></script>
		<script src="../assets/js/breakpoints.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>



		<script>

		</script>
	</body>

	</html>
<?php
} else {
	echo "
		<script>
			alert('Area restringida');
			window.location.href='./login_administrador.html';
		</script>
	";
}
?>