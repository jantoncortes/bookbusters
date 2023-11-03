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
							<h2>Gestión de Usuarios</h2>
							<div>
								<abbr title="Volver"><i class="fa-solid fa-circle-arrow-left" style="font-size: 2.5em;cursor:pointer;" onclick="window.location.href='./index_administrador.php'"></i> </abbr>
							</div>
						</header>

						<hr class="major" />

						<!-- Elements -->
						<div class="row gtr-200">

							<body>
								<table border="1" style="margin-left:5%;margin-right:5%">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Apellidos</th>
											<th>Email</th>
											<th>
												<abr title="Activo(1) Inactivo(0)">Activo</abr>
											</th>
											<th>Faltas</th>
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



		<script>
			$(function() {
				$.post("./php/busca_usuarios.php", {}, function(echoadmin) {
					$("tbody").html(echoadmin);
				})

			});

			function borrar_usuario(id) {
				cod = id.split("_")[1];

				// Funcion de alert de confirmacion
				Swal.fire({
					title: 'Está seguro de borrar el usuario?',
					showDenyButton: false,
					showCancelButton: true,
					confirmButtonText: 'SI',
					denyButtonText: `Don't save`,
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						Swal.fire('Borrado!', '', 'success')
						// borradoooooo
						$.post(
						"./php/borrar_usu.php", {
							codigo: cod
						},
						function(out) {
							if (out != "Ha ocurrido un error en el borrado") {
								$("#campo_" + cod).hide();
							}
						}
					);

					} else if (result.isDenied) {
						Swal.fire('Changes are not saved', '', 'info')
					}
				})

				// if (confirm("Está seguro de borrar el usuario")) {
				// 	$.post(
				// 		"./php/borrar_usu.php", {
				// 			codigo: cod
				// 		},
				// 		function(out) {
				// 			alert(out);
				// 			if (out != "Ha ocurrido un error en el borrado") {
				// 				$("#campo_" + cod).hide();
				// 			}
				// 		}
				// 	);
				// }
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

			function enlace_activar(id) {
				var codigo = id.split("_")[1];

				$.post(
					"./php/enlace_activar.php", {
						c: codigo
					},
					function(recoger) {
						alert(recoger)
					}
				);
			}

			function cambio_contusu(e) {
				$.post(
					"./../contraolvidada.php", {
						email: e
					},
					function(vuelta) {
						alert("Eviado mail de cambio de contraseña.");
					}
				);
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