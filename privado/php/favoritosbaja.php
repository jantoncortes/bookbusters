<?php
    session_start();
	if(isset($_SESSION["bookbusters"]))
    {
        //Sentencias para borrar de favorito un libro de un usuario dado
        $bajacodlib = $_POST["codigolibro"];
        $bajauser = $_POST["usuario"];
        $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
        $sqlborrar = "DELETE FROM favoritos WHERE cod_lib='$bajacodlib' AND cod_usu='$bajauser'";
        $ejesqlborrar=$con->query($sqlborrar);
        $sqlcomprobar = "SELECT * FROM favoritos WHERE cod_lib='$bajacodlib' AND cod_usu='$bajauser'";
        if(! $con->query($sqlcomprobar)->fetch_array())
        {
            //No existe el libro y usuario en favoritos
            echo "Libro borrado de favoritos";
        }
        else
        {
            echo "No se ha borrado el libro de favoritos";
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