<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7b8eabe9ec.js" crossorigin="anonymous"></script>
    <title>Detalle_libro</title>
</head>
<body>
    <div id="acciones">
<?php
    //Se recoge el código del libro recibido por GET de los documentos /privado/index.php y /privado/index_favoritos.php
    //$codlibro=$_GET["codlib"]; 
        //Para pruebas sin tener código libro
        $codlibro=5; 
    //Se obtiene el código de usuario de la sesión denominada bookbusters  
    //$codusuario=$_SESSION["bookbusters"];
        //Para pruebas sin tener el código de usuario de la sesión
        $codusuario=5;
    $conexion=new mysqli("10.10.10.199","busters","1234","biblioteca");
    
    //SQL consulta tabla prestamos para saber si el usuario tiene algún libro prestado sin devolver
    $sqlconsultaprestamo="SELECT * FROM prestamos WHERE cod_usu='$codusuario' AND fentrega_pres!='0000-00-00' AND fdevolucion_pres='0000-00-00'";
    //$ejesqlconsultaprestamo=$conexion->query($sqlconsultaprestamo);
    if($conexion->query($sqlconsultaprestamo)->fetch_array())
    {
        //El usuario tiene algún libro prestado sin devolver, por lo que hasta que lo devuelva no puede solicitar nuevo préstamo
        //SQL para obtener el nombre del libro pendiente de devolver y la fecha límite de devolución
        $sqldevolucion="SELECT * FROM prestamos INNER JOIN libros ON prestamos.cod_lib=libros.cod_lib WHERE cod_usu='$codusuario'";
        $ejesqldevolucion=$conexion->query($sqldevolucion);
        $regdevolucion=$ejesqldevolucion->fetch_array(); 
        $codlibdevolucion=$regdevolucion["cod_lib"];
        $titulodevolucion=$regdevolucion["titulo_lib"];
        $fpredevo=explode("-",$regdevolucion["fprevista_pres"]);
        $fechaprevistadevolucion="$fpredevo[2]/$fpredevo[1]/$fpredevo[0]";

?>        
        <label for="" style="color:red">Tienes prestado otro libro pendiente de devolver. Titulo: <?php echo $titulodevolucion;?>, fecha prevista devolución: <?php echo $fechaprevistadevolucion;?></label>
        <br><br>
        <abbr title="Para poder solicitar préstamo de un libro se debe devolver el o los libros prestados anteriormente">        
        <button onclick="" style="color:red;">TIENES ALGÚN LIBRO PRESTADO SIN DEVOLVER</button></abbr>
<?php
    }
    else
    {
        //El usuario no tiene ningún libro recogido (entregado al usuario), o no tiene ningún libro pendiente de devolver

        //SQL comprobar si el usuario ya tiene una reserva de préstamo de otro libro pendiente de recoger, de ser entregado al usuario
        $sqlconsultareser="SELECT * FROM prestamos WHERE cod_usu='$codusuario' AND cod_lib!='$codlibro' AND freserva_pres!='0000-00-00' AND fentrega_pres='0000-00-00'";
        if($conexion->query($sqlconsultareser)->fetch_array())
        {
            //El usuario ya tiene reservado un préstamo de otro libro pendiente de ser recogido, ser entregado al usuario, por lo que no puede reservar otro
            //SQL para obtener el nombre del libro reservado y la fecha de reserva
            $sqlreserva="SELECT * FROM prestamos INNER JOIN libros ON prestamos.cod_lib=libros.cod_lib WHERE cod_usu='$codusuario'";
            $ejesqlreserva=$conexion->query($sqlreserva);
            $regreserva=$ejesqlreserva->fetch_array(); 
            $codlibreserva=$regreserva["cod_lib"];
            $tituloreserva=$regreserva["titulo_lib"];
            $freserva=explode("-",$regreserva["freserva_pres"]);
            $fechareserva="$freserva[2]/$freserva[1]/$freserva[0]";
?>
            <input type="hidden" id="codigootrolibro" value="<?php echo $codlibreserva; ?>">
            <label for="" style="color:red">Tienes reservado préstamo de otro libro pendiente recoger. Titulo: <?php echo $tituloreserva?>, fecha reserva: <?php echo $fechareserva?> Si lo deseas puedes anular esa reserva.</label>
            <br><br>
            <abbr title="Tienes reservado préstamo de otro libro pendiente de recoger. No se puede realizar esta reserva a no ser que anules la anterior reserva">        
            <button onclick="anularotrareservaprestamo()">ANULAR RESERVA PRÉSTAMO OTRO LIBRO</button></abbr>
<?php
        }
        else
        {
            //El usuario no tiene ninguna reserva de libro pendiente, ni tiene ningún libro pendiente de devolver
        
            //SQL consulta si el libro si está disponible (0) o no está disponible (1)
            $sqllibrodis="SELECT * FROM libros WHERE cod_lib='$codlibro' AND disponible_lib=0";
            $ejesqllibrodis=$conexion->query($sqllibrodis);          
            if($ejesqllibrodis->fetch_array())
            {
                //Libro disponible (campo disponible_lib=0 de la tabla libros)       
?>
                <label for="" style="color:green">Si deseas reservar préstamo de este libro haz clic en "SOLICITAR PRÉSTAMO LIBRO"</label>
                <br><br>
                <button onclick="reservaprestamo()">SOLICITAR PRÉSTAMO LIBRO</button>          
<?php
            }
            else
            {
                //Libro no disponible (campo disponible_lib=1 de la tabla libros)

                //Se comprueba en la tabla prestamos si el libro ya había sido entretado, prestado, o acaba de ser reservado 
                //por el usuario que está consultando el detalle del libro (verlibro.php), para dar opción a anular reserva
                //SQL tabla préstamos consultando por código de libro, código usuario y si no tiene echa entrega,
                //es decir, este usuario ha reservado el libro, que no ha sido entregado, dándo la opción de anular reserva
                $sqlprestamo = "SELECT * FROM prestamos WHERE cod_usu='$codusuario' AND cod_lib='$codlibro' AND fentrega_pres='0000-00-00'";
                $ejesqlprestamo = $conexion->query($sqlprestamo);
                if($ejesqlprestamo->fetch_array())
                {
                    //El libro ha sido reservado por el usuario y no ha sido entregado, no ha sido recogido. Se permite anular la reserva.
?>
                    <label for="" style="color:red">Ya tenías reservado préstamo de este libro pendiente de recoger. Si lo deseas tienes opción a anular esa reserva.</label>
                    <br><br>
                    <abbr title="Ya tienes reservado el préstamo de este libro (está pendiente de ser entregado). Si lo deseas puedes anular reserva">
                    <button onclick="anularreservaprestamo()">ANULAR RESERVA PRÉSTAMO LIBRO</button> </abbr>
<?php
                }
                else
                {
                    //El libro no está disponible, no ha sido reservado por el usuario, no se ha devuelto
?>            
                    <label for="" style="color:red">Este libro ya está prestado o está reservado por otro usuario. Puedes solicitar reserva préstamo de otro libro haciendo clic en "LIBRO NO DISPONIBLE" o ir a Indice</label>
                    <br><br>
                    <abbr title="Ir a Indice para seleccionar libro disponible">
                    <button onclick="window.location.href='./index.php'">LIBRO NO DISPONIBLE</button></abbr>    
<?php
                }        

            }
        }    
    }    
    //SQL consulta si el usuario ya tiene este libro como favorito
    $sqlfavorito="SELECT * FROM favoritos WHERE cod_usu='$codusuario' AND cod_lib='$codlibro'";
    $ejesqlfavorito=$conexion->query($sqlfavorito);
    if($ejesqlfavorito->fetch_array())
    {
        //El usuario ya tiene este libro como favorito. Se da como opción quitar de la lista de favoritos del usuario.
?>
        <abbr title="libro en favoritos (haz clic para dar de baja de favortios)">
            <i class="fa fa-heart-circle-minus fa-2xl" id="favoritobaja" onclick="quitarfavoritos()" style="color:red;"></i></abbr>
        <hr>       
<?php
    }
    else
    {
        //El usuario no tiene este libro como favorito y lo puede añadir a la lista de favoritos del usuario.
?>
        <abbr title="añadir a favoritos"><i class="fa fa-heart-circle-plus fa-2xl" id="favoritoalta" onclick="favorito()"></i></abbr>
        <hr>        
<?php
    }

    //SQL consulta datos del libro tabla libros 
    $sqllibro="SELECT * FROM libros WHERE cod_lib='$codlibro'";
    $ejesqllibro=$conexion->query($sqllibro);
    $reg=$ejesqllibro->fetch_array();
    //Obetener del array (fetch_array()) los datos a presentar
    $isbnlibro=$reg["isbn_lib"];      
    $titlibro=$reg["titulo_lib"];
    $subtitlibro=$reg["subtitulo_lib"];    
    $autorlibro=$reg["autor_lib"];
    $editlibro=$reg["editorial_lib"];      
    $genlibro=$reg["genero_lib"];
    $resumenlibro=$reg["resumen_lib"];
    $idiomalibro=$reg["idioma_lib"];
    $pagslibro=$reg["paginas_lib"];
    $imgagenlibro=$reg["imagen_lib"];

    //SQL consulta el género del libro en la tabla generos
    $sqlcateg="SELECT * FROM generos WHERE genero_lib='$genlibro'";
    $ejecateg=$conexion->query($sqlcateg);
    $regcat=$ejecateg->fetch_array();
    //Obetener del array (fetch_array()) el nombre del género a presentar
    $nomgenlibro=$regcat["nom_gen"];
    
    //Para probar mientras no se tenga nombre de imagen en BBDD
        //$imgagenlibro= "libro.jpg";
    
?>     
    <!-- Etiquetas input's ocultas (hidden) para las variables código libro y código usuario 
        (que se obtiene de la sesión, para las funciones JavaScript) -->
    <input type="hidden" id="codigolibro" value="<?php echo $codlibro; ?>">
    <input type="hidden" id="usuar" value="<?php echo $codusuario; ?>">
    </div>

    <div id="imglibro">
        <img src="./../images/portadas/<?php echo $codlibro; ?>/<?php echo $imgagenlibro; ?>" alt="">     
    </div>
    <div id="datos1">
        <p><?php echo $titlibro; ?></p>
        <p><?php echo $subtitlibro; ?></p>
        <p><?php echo $autorlibro; ?></p>
        <p><?php echo $nomgenlibro; ?></p>  
    </div>
    <div id="datos2">
        <div id="editorial">
            <p><?php echo $editlibro; ?></p>
        </div>
        <div id="isbn">
            <p><?php echo $isbnlibro; ?></p>
        </div>
        <div id="paginas">
            <p><?php echo $pagslibro; ?></p>
        </div>
        <div id="idioma">
            <p><?php echo $idiomalibro; ?></p>
        </div>       
    </div>
    <div id="datos3">
        <p><?php echo $resumenlibro; ?></p>
    </div>

<script>
    //Función para dar de alta solicitud reserva préstamo libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)     
    function reservaprestamo()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamos.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                // alert(respuesta);
                // window.location.href='./verlibro.php';
                window.location.href='reservado.php?codlib='+codlib;
            }
        );
    }

    //Función para anular reserva préstamo libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function anularreservaprestamo()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                // alert(respuesta);
                // window.location.href='./verlibro.php';
                window.location.href='reservaanulacion.php?codlib='+codlib;          
            }
        );
    }

    //Función para anular la reserva préstamo de otro libro en tabla prestamos y actualizar tabla libros
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function anularotrareservaprestamo()
    {
        var codlib = $("#codigootrolibro").val();
        var user = $("#usuar").val();       
        $.post(
            "./php/prestamosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                // alert(respuesta);
                // window.location.href='./verlibro.php';
                window.location.href='reservaanulacion.php?codlib='+codlib;
            }
        );
    }

    //Función para dar de alta como favorito el libro en tabla favoritos BBDD biblioteca
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)  
    function favorito()
    {
    
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();
        $.post(
            "./php/favoritosalta.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                // alert(respuesta);
                // window.location.href='./verlibro_sin_css.php';
                window.location.href='favoritoalta.php?codlib='+codlib;
            }
        );
    }

    //Función para dar de baja como favorito el libro en tabla favoritos BBDD biblioteca
        //Se recibe de dos input's ocultos el código de libro y el código de usuario, enviándose al correspondiente
        //documento por $.post(). Se recibe la respuesta de otro documento (que está maquetado con el correspondiente diseño)      
    function quitarfavoritos()
    {
        var codlib = $("#codigolibro").val();
        var user = $("#usuar").val();
        $.post(
            "./php/favoritosbaja.php",
            {codigolibro:codlib,usuario:user},
            function(respuesta)
            {
                // alert(respuesta);
                // window.location.href='./verlibro_sin_css.php';
                window.location.href='favoritobaja.php?codlib='+codlib;
            }           
        );
    }
</script>    
</body>
</html>