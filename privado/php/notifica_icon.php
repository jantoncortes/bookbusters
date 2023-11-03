<?php
$codigo_usu = $_POST["cod_usu"];
$con = new mysqli("10.10.10.199","busters","1234","biblioteca");

$sql_notif="SELECT * FROM notificaciones 
        WHERE  cod_usu='$codigo_usu'";

$ejec_notif=$con->query($sql_notif);

foreach ($ejec_notif as $reg_notif)
    {
        $control=$reg_notif["leida_not"];
        if ($control==0){
            echo $reg_notif['cod_not'];
        }
    }
?>