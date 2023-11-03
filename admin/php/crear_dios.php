<?php
    $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
    $pas = password_hash("1234",PASSWORD_DEFAULT);
    $sql = "INSERT INTO administradores (nom_adm, email_adm, pass_adm) VALUES ('dios','dios.com','$pas')";
    $con->query($sql);
?>