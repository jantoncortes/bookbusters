<?php

$isbn=$_POST["isbn"];
$titulo=$_POST["tit"];
$subtit=$_POST["subt"];
$autor=$_POST["aut"];
$editorial=$_POST["edit"];
$genero=$_POST["gen"];
$resumen=$_POST["res"];
$idioma=$_POST["idi"];
$paginas=$_POST["pag"];
$img=$_FILES["img"]["name"];


$falta=date("Y-m-d");

$conexion=new mysqli("10.10.10.199","busters","1234","biblioteca");

$busisbn = "SELECT cod_lib FROM libros WHERE isbn_lib='$isbn'";
$ejisbns = $conexion->query($busisbn);
if($ejisbns->fetch_array())
{
    echo"<script>
            alert('Este ISBN ya se encuentra registrado');
            window.location.href='altalibrosform.php';
    </script>";
}
$sql="INSERT INTO libros (isbn_lib,titulo_lib,subtitulo_lib,autor_lib,editorial_lib,genero_lib,resumen_lib,idioma_lib,paginas_lib,imagen_lib,falta_lib) 
VALUES ('$isbn','$titulo','$subtit','$autor','$editorial','$genero','$resumen','$idioma','$paginas','$img','$falta')";

if($conexion->query($sql))
{
    $codlib=$conexion->insert_id;
    $ruta="./../images/portadas/$codlib";
    mkdir($ruta,0777);
    $destino= "./../images/portadas/$codlib/$img";
    move_uploaded_file($_FILES["img"]["tmp_name"], $destino);
    echo"<script>
            if(confirm('Libro grabado. Quieres grabar otro?'))
            {
                window.location.href='altalibrosform.php';
            }
            else
            {
                window.location.href='index_administrador.php';   
            }
            
        </script>";
}
else
{
    echo"<script>
            alert('Ocurrió un error');
            window.location.href='altalibrosform.php';
        </script>";
}














?>