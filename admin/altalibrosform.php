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
		<title>Admin-Alta Libros</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
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
							<h2>Alta Libro</h2>
							
								<div class="col-12">
								<abbr title="Volver"><i class="fa-solid fa-circle-arrow-left" style="font-size: 2.5em;cursor:pointer;" onclick="window.location.href='./libros.php'"></i> </abbr>
								</div>
															
														
							
						</header>

						<!-- <hr class="major" /> -->

						<!-- Elements -->
						<div >

							


								
                                <form action="altalibros.php" method="POST" enctype="multipart/form-data">
                                	<div class="row gtr-uniform">
															<div class="col-2 col-12-xsmall">
																<input type="text" name="isbn" placeholder="ISBN" required>
															</div>
															<div class="col-5 col-12-xsmall">
																<input type="text" name="tit" placeholder="Titulo del libro" required>									
															</div>
															<div class="col-5 col-12-xsmall">
																<input type="text" name="subt" placeholder="Subtitulo del libro" required>
															</div>


															<div class="col-4 col-12-xsmall">
																<input type="text" name="aut" placeholder="Autor" required>
															</div>
															<div class="col-4 col-12-xsmall">
																<input type="text" name="edit" placeholder="Editorial" required>									
															</div>
															<div class="col-4 col-12-xsmall">
																<select name="gen" required>
								                                    <?php
								                                    $conexion=new mysqli("10.10.10.199","busters","1234","biblioteca");
								                                    $sql="SELECT * FROM generos";
								                                    $ejecutar=$conexion->query($sql);
								                                    echo "<option>Selecicone el género</option>";
								                                    
								                                    foreach($ejecutar as $registro)
								                                    {
								                                        $genero=$registro["nom_gen"];
								                                        $cgenero=$registro["cod_gen"];
								                                        echo "<option value=$cgenero>$genero</option>";
								                                    }
								                                    ?>
								                                </select> 
															</div>

															<div class="col-12">
																 <textarea name="res" placeholder="Resumen del libro" required rows=6 style="resize:none"></textarea>
															</div>

															
															<!-- Break -->
															<div class="col-4 col-12-xsmall">
																<select name="idi" required>
								                                    <option value="Español">Español</option>
								                                    <option value="Inglés">Inglés</option>
								                                    <option value="Francés">Francés</option>
								                                    <option value="Portugués">Portugués</option>
								                                </select>  
															</div>
															<div class="col-4 col-12-xsmall">
																<input type="text" name="pag" placeholder="Nº Páginas" required>
															</div>
															<div class="col-4 col-12-xsmall">
																<input type="file" name="img" required class="form-control" style="display: none;">
																<a  href="javascript:void" onclick="$('input[type=file]').click()" class="button" style="width:100%;">Elegir portada</a>
															</div>
															<div class="col-12">
																<ul class="actions">
																	<li><input type="submit" value="Alta libro" class="primary" /></li>
																	
																</ul>
															</div>
														</div>

                                </form>
								

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



		<!-- <script>
			$(function() {
				$.post("./php/busca_usuarios.php", {}, function(echoadmin) {
					$("tbody").html(echoadmin);
				})

			});

			function borrar_usuario(id) {
				cod = id.split("_")[1];
				if (confirm("Está seguro de borrar el usuario")) {
					$.post(
						"./php/borrar_usu.php", {
							codigo: cod
						},
						function(out) {
							alert(out);
							if (out != "Ha ocurrido un error en el borrado") {
								$("#campo_" + cod).hide();
							}
						}
					);
				}
			}

			function pintar(id) {
				$("#" + id).css("color", "#ff39ba");
				// $("#"+id).css("font-size","0px");
			}

			function despintar(id) {
				$("#" + id).css("color", "grey");
				// $("#"+id).css("font-size","30px");
			}

			function modif_usu(id) {
				// cogemos el id but_$cod de buscausuarios lo explotamos por la _ para extraer la id
				var iden;
				iden = id.split("_");
				$(".datos").show();
				$(".cambio_datos").hide();
				$("#escondido_" + iden[1]).show();
				$("#campo_" + iden[1]).hide();

			}

			function modif_total(id) {
				var codigo = id.split("_")[1];
				var nombre = $("#nom_" + codigo).val();
				var apellido1 = $("#ap1_" + codigo).val();
				var apellido2 = $("#ap2_" + codigo).val();
				var email = $("#mail_" + codigo).val();
				$.post(
					"./php/modif_total.php", {
						c: codigo,
						n: nombre,
						a1: apellido1,
						a2: apellido2,
						e: email,
					},
					function(vuelta) {
						$(".cambio_datos").hide();
						window.location.href = "./gestion_usu.php";
					}
				);
			}
		</script> -->
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