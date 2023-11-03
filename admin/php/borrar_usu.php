<?php
session_start();
if (isset($_SESSION["admin"]))
{
    $cod = $_POST["codigo"];
    $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
    $sql_consulta = "SELECT * FROM usuarios WHERE cod_usu = '$cod'";
    $tup = $con->query($sql_consulta)->fetch_array();
    $nom = $tup["nom_usu"];
    $sql_borrar   = "DELETE FROM usuarios WHERE cod_usu = '$cod'";
    if ($run = $con->query($sql_borrar))
    {
        echo "$nom ha sido borrado correctamente";
    }
    else
    {
        echo "Ha ocurrido un error en el borrado";
    }
}
else
{
	echo "
		<script>
			alert('Area restringida');
			window.location.href='./login_administrador.html';
		</script>
	";
}
?>