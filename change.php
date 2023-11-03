


<?php

//Datos provenientes de contraolvidada.php

if(isset($_GET['envio']))
{

$mail=base64_decode($_GET["envio"]);
$e = $_GET["i"];

//buscamos la variable $e en la base de datos
$con=new mysqli("10.10.10.199","busters","1234","biblioteca");
$sql="SELECT * FROM usuarios WHERE uniq_usu='$e' AND email_usu='$mail'";
$ejecutar=$con->query($sql);
    if($reg = $ejecutar->fetch_array())
        {
            $codusu=$reg["cod_usu"];
            ?>

            <html>
	<head>
		<title>Blockbusters</title>
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
										<li><a style="font-size:xx-large" href="index.php" class="fa fa-home" aria-hidden="true"><span class="label"></span></a></li>
										<li><a style="font-size:xx-large" href="registro.html" class="fa fa-user-plus" aria-hidden="true"><span class="label"></span></a></li>
										<li><a style="font-size:xx-large" href="login.html" class="fas fa-sign-in-alt" aria-hidden="true"><span class="label"></span></a></li>	
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner" style="padding-top:30px">
									<div class="content">
										<center>
												<img src="images/Bookbusters (4).png" alt="" style="border-radius:10px" />
                                                <br>
											

                    <form action="updatepass.php" method="POST">
                        <input type="hidden" name="codusu" value="<?php echo $codusu; ?>">
                        <input type="password" name="pass" placeholder="Nueva Contraseña" style="width:20%;margin-top:1%;border-radius:10px" >
                        <input type="submit" value="enviar" style="margin-top:1%">
                    </form>

                                    </center>
                                    </div>
                        </div>
                    </div>
        <!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php" style="font-size:x-large ;">Inicio</a></li>
										<li><a href="registro.html" style="font-size:x-large ;">Registro</a></li>
										<li><a href="login.html" style="font-size:x-large">Login</a></li>
										
									</ul>
								</nav>

							<!-- Section -->
								

							<!-- Section -->
								

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Bookbusters: </p>
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
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

	</body>
</html>    


        <?php
        }
        else
        {
            header("location:http://10.10.10.199/bookbusters/login.html");    
        }
}
else
    {
        header("location:http://10.10.10.199/bookbusters/login.html");
    }  
?>