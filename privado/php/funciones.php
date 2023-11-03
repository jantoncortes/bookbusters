<?php
function encriptado($accion,$texto){
    $modo = "AES-128-ECB";
    $llave = "peche";
    
    if($accion=="e")
    {
    $textoencriptado= openssl_encrypt($texto,$modo,$llave);
    $textoencriptado=base64_encode($textoencriptado);
    return $textoencriptado;
    }
    else{
        $textoencriptado=base64_decode($texto);
        $textoencriptado= openssl_decrypt($textoencriptado,$modo,$llave);
        return $textoencriptado;
    }
    }


function recoge(){
$sql="SELECT *,count(cod_lib) as conta FROM libros INNER JOIN prestamos using(cod_lib) group By cod_lib ORDER BY conta DESC limit 8";	
return conex()->query($sql);
}

function conex(){
    return new mysqli("10.10.10.199","busters","1234","biblioteca");
}

function consulta($tabla){
$sql="SELECT * FROM $tabla";
return conex()->query($sql);
}
function insertar($tabla, $campo,$nom)
{
    $sql="INSERT INTO $tabla($campo) VALUES('$nom')";
    return conex()->query($sql);
}

function verificar($campo,$tabla,$condi)
{
    $sql="SELECT $campo FROM $tabla WHERE $campo=$condi";
    $ej=conex()->query($sql);
    return $ej->fetch_array();
}
function estrella($valor)
{
$imprime="";
$sql="SELECT cod_lib, avg(puntos_val) as suma FROM valoraciones WHERE cod_lib=$valor";
$ejec= conex()->query($sql);
$reg=$ejec->fetch_array();
if($reg["suma"]!=NULL){
  $valor=$reg["suma"];  
  $eva=$valor - intval($valor);
for($x=1;$x<=$valor;$x++)
{
    $imprime.='<i class="fa fa-star" style="color:#ff39ba;"></i>';
}
if($eva){ 
    $imprime.='<i class="fa-solid fa-star-half-stroke" style="color:#ff39ba;"></i>';
}
}
return $imprime;
}


function valorar($codlib,$id,$coduni,$p){
    $sql="SELECT * FROM valoraciones WHERE val_uniq='$coduni' AND act_val='0'";
    $reg=conex()->query($sql);
    if($valor=$reg->fetch_array())
    {
$hoy=$valor["fecha_val"]; 
 $h=new DateTime(date("Y-m-d"));
 $h2=new DateTime($hoy);
 $c= $h->diff($h2);
 if($c->days>3 or ($p<1 or $p>5))
 {
    $p=1;
    header('location:http://10.10.10.199/bookbusters/index.php');}
$sqlup="UPDATE valoraciones SET cod_lib='$codlib',puntos_val='$p',val_uniq=NOW() WHERE cod_val='$id'";
if(conex()->query($sqlup)){
    //unset();
    header ("Cache-Control: no-cache, must-revalidate");
    conex()->close();
}
else
{
    echo "mal";
}
 //echo $c->days;
 
$a="bien";
    }
    else

    {
$a= "usado";



    }
return $a;



}


?>