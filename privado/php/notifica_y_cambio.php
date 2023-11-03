<?php
    $codigo_not = $_POST["cod_not"];
    $con = new mysqli("10.10.10.199","busters","1234","biblioteca");

    $sql_notif="UPDATE notificaciones
            SET leida_not=1
            WHERE cod_not='$codigo_not'";

    if($con->query($sql_notif))
    {
        echo 1;
    }

?>