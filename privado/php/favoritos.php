<?php
    $con = new mysqli("10.10.10.199","busters","1234","biblioteca");
    $sql = "SELECT * FROM favoritos WHERE cod_usu = '1'"; 
    foreach ($con->query($sql) as $tup)
    {
        $fav = $tup["cod_lib"];
        echo $fav."@";
        
    }
    // for ($i=1;$i<3;$i++){
    //     echo $i."@";
    // }
    // echo "1@";
    // echo "4@";
?>