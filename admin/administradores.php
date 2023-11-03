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
	</head>

	<body class="is-preload">

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Main -->
			<div id="main">
				<div class="inner">

					<!-- Header -->
					<header id="header">
						<a href="../index.php" class="logo"><img style="width: 20%;" src="./../images/logo.png"></a>
						<ul class="icons">
							<li><a href="../index.php" class=" fa fa-home"><span class="label"></span></a></li>
							<li><a href="#" class=" fa fa-dice"><span class="label"></span></a></li>
							<li><a href="./login_administrador.html" class="fa-solid fa-arrow-right-from-bracket"><span class="label"></span></a></li>
						</ul>
					</header>

					<!-- Content -->
					<section>
						<header class="main">
							<h2>Administradores</h2>
						</header>

						<div class="row" style="margin-bottom:2%;">
							<div>
								<button id="but" class="primary  col-6" onclick="desplegar_input()">Crear administrador</button>
							</div>
							<div>
								<abbr title="Volver"><i class="fa-solid fa-circle-arrow-left" style="font-size: 2.5em;cursor:pointer;" onclick="window.location.href='./index_administrador.php'"></i> </abbr>
							</div>
						</div>

						<form style="display:none;">
							<div class="row gtr-uniform col-12 ">
								<label for="" class="col-2">Nombre:</label>
								<div class="col-10 col-10-xsmall">
									<input type="text" name="nombre" id="nombre" value="" placeholder="Name" />
								</div>
								<label for="" class="col-2">Email:</label>
								<div class="col-10 col-10-xsmall">
									<input type="email" name="mail" id="mail" value="" placeholder="Email" />
								</div>
								<label for="" class="col-2">Password:</label>
								<div class="col-10 col-10-xsmall">
									<input type="password" name="pass" id="pass" value="" placeholder="Password" />
								</div>
								<div class="row">
									<div class="offset-10">
										<input type="button" value="Añadir" class="primary  col-6" onclick="anadir_adm()">
									</div>
								</div>
							</div>
						</form>

						<hr class="major" />

						<!-- Elements -->
						<div class="row gtr-200">

							<body>
								<table border="1">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
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
			$(function() {
				$.post("./php/busca_administradores.php", {}, function(echoadmin) {
					$("tbody").html(echoadmin);
				})

			});

			function borrar_administrador(id) {
				cod = id.split("_")[1];
				if(confirm("¿Esta seguro de borrar este Administrador?")){
				$.post(
					"./php/borrar_adm.php", {
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
				else{
					location.reload();
				}
			}

			function desplegar_input() {
				// $("button#but").click(function(){
				$("#but").hide(500);
				$("form").show(500);
				// });
			}

			function anadir_adm() {
				var nom = $("input#nombre").val();
				var ema = $("input#mail").val();
				var pas = $("input#pass").val();
				$.post(
					"./php/anadir_adm.php", {
						n: nom,
						e: ema,
						p: pas
					},
					function(out) {
						if (out == "Administrador grabado correctamente") {
							window.location.href = "";
						} else {
							alert(out);
						}
					}
				)
			}

			function pintar(id) {
				$("#" + id).css("color", "#ff39ba");
				// $("#"+id).css("font-size","0px");
			}

			function despintar(id) {
				$("#" + id).css("color", "grey");
				// $("#"+id).css("font-size","30px");
			}
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