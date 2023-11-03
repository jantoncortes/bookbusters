<?php
    session_start();
    if($_SESSION["bookbusters"]){
        $codUsu= $_SESSION["bookbusters"];
        $codLib = $_POST["cod"];
    
    $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
    $sqlQuery  = "SELECT * FROM favoritos WHERE cod_lib = '$codLib' AND cod_usu = '$codUsu'";
    $sqlInsert = "INSERT INTO favoritos (cod_usu,cod_lib) VALUES('$codUsu','$codLib')";
    $sqlRemove = "DELETE FROM favoritos WHERE cod_lib = '$codLib' AND cod_usu = '$codUsu'";
    if ( !$con->query($sqlQuery)->fetch_array() )
    {
        $con->query($sqlInsert);
        echo "Añadido a favoritos";
    }
    else
    {
        $con->query($sqlRemove);
    }

    
    }
