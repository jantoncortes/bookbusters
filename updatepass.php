<?php

    //Datos provenientes de change.php

    $codusu=$_POST["codusu"];    
    $pass=$_POST["pass"];
	
    $pass=password_hash($pass, PASSWORD_DEFAULT);

    $con=new mysqli("10.10.10.199","busters","1234","biblioteca");

    $sql="UPDATE usuarios SET pass_usu='$pass', uniq_usu='' WHERE cod_usu='$codusu'";

    if($con->query($sql))
    {
        
    header("location:http://10.10.10.199/bookbusters/login.html");

    }
    else
    {
        echo "ocurrió un error";
    }  







?>