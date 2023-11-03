<?php
    session_start();
	if(isset($_SESSION["bookbusters"]))
    {
        //Sentencias para dar de alta un libro de un usuario dado
        $codLib = $_POST["codigolibro"];
        $codUsu = $_POST["usuario"];
        $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
        $sqlQuery  = "SELECT * FROM favoritos WHERE cod_lib = '$codLib' AND cod_usu = '$codUsu'";
        $sqlInsert = "INSERT INTO favoritos (cod_usu,cod_lib) VALUES('$codUsu','$codLib')";
        if (! $con->query($sqlQuery)->fetch_array() )
        {
            $con->query($sqlInsert);
            echo "Añadido a favoritos";
        }
        else
        {
            echo "Ya está en favoritos";
        }
    }
    else
    {
        echo "
            <script>
                alert('Area restringida');
                window.location.href='../index.html';
            </script>
        ";
    }
?>