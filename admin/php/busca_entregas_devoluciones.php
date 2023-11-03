<?php
$con = new mysqli("10.10.10.199", "busters", "1234", "biblioteca");
$sql = "SELECT *
FROM usuarios
INNER JOIN
prestamos
ON
prestamos.cod_usu=usuarios.cod_usu
INNER JOIN
libros
ON
libros.cod_lib=prestamos.cod_lib
WHERE disponible_lib=1 AND fdevolucion_pres ='0000-00-00'";

if ($ej = $con->query($sql)) {
        foreach ($ej as $reg) {
                $codusu = $reg["cod_usu"];
                $Avatar = $reg["img_usu"];
                $Nombre = $reg["nom_usu"];
                $Ap1 = $reg["ap1_usu"];
                $Ap2 = $reg["ap2_usu"];
                $email = $reg["email_usu"];
                $libro = $reg["titulo_lib"];
                $codlibro = $reg["cod_lib"]; //Para enviar en el correo de valoracion
                $Fecha_Reserva_Prevista = $reg["freserva_pres"];
                $Fecha_Entrega_Prevista = $reg["fentrega_pres"];
                $Fecha_Prevista_Prestamo = $reg["fprevista_pres"];
                $Fecha_Devolucion_Prestamo = $reg["fdevolucion_pres"];
                $disponibilidad = $reg["disponible_lib"];
                $Faltas = $reg["falta_usu"];
                $avatar = $reg["img_usu"];
                
?>
                <tr>
                        <td style="margin:5px, "><?php echo "<img src='$avatar' height='50' style='border-radius: 10px; vertical-align: middle'>" ?></td>
                        <td>
                                <?php
                                if ($reg["fentrega_pres"] == "0000-00-00") {
                                ?>
                                        <i id="confirm<?php echo $codusu ?>" onclick="confirmacion('<?php echo $email ?>')" onmouseover='icono_rojo(confirm<?php echo $codusu ?>)' onmouseleave='icono_negro(confirm<?php echo $codusu ?>)' class="icon solid fa-envelope" style="color:black"></i>
                                <?php
                                } else {
                                ?>
                                        <i class="fas fa-check-double"></i>
                                <?php
                                }
                                ?>
                        </td>
                        <td>
                                <?php
                                $hoy = date('Y-m-d');
                                if ($reg["fentrega_pres"] == "0000-00-00") //VOY POR AQUI, NECESITO ENVIAR COD_USU, PARA SABER A QUIEN ACTUALIZAR, MIRAR CODLIB QUE NO SE ESTA ENVIANDO EN LA FUNCION
                                {
                                ?>
                                        <i id="departure<?php echo $codusu ?>" onclick="entrega('<?php echo $codusu ?>','<?php echo $Nombre ?>','<?php echo $email ?>','<?php echo $hoy ?>')" onmouseover="icono_rojo(departure<?php echo $codusu ?>)" onmouseleave="icono_negro(departure<?php echo $codusu ?>)" class="fa-solid fa-plane-departure" style="color:black"></i>
                                <?php
                                } else {
                                ?>
                                        <i id="arrival<?php echo $codusu ?>" onclick="valoracion('<?php echo $codusu ?>','<?php echo $Nombre ?>','<?php echo $email ?>','<?php echo $codlibro ?>')" onmouseover="icono_rojo(arrival<?php echo $codusu ?>)" onmouseleave="icono_negro(arrival<?php echo $codusu ?>)" class="fa-solid fa-plane-arrival" style="color:black"></i>
                                <?php
                                }
                                ?>

                        </td>
                        <td><?php echo "$Nombre $Ap1 $Ap2" ?></td>
                        <td><?php echo $libro ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $Fecha_Reserva_Prevista ?></td>
                        <td><?php echo $Fecha_Entrega_Prevista ?></td>
                        <td><?php echo $Fecha_Prevista_Prestamo ?></td>
                        <td><?php echo $Fecha_Devolucion_Prestamo ?></td>
                        <td style="display:none"><?php echo $disponibilidad ?></td>
                        <td><?php echo $Faltas ?></td>

        <?php
        }
}

if (isset($_POST["enviarmail"])) {
        if (($_POST["enviarmail"]) == "confirmacion") {

                //CORREO ADMINISTRACION, A VISTO LA RESERVA DEL USUARIO Y NOTIFICA QUE MAÑANA PUEDE RETIRARLO
                $para = $_POST["email"];
                $asunto = "Confirmación, reserva de libro Bookbusters";
                $mensaje = "<h1>El administrador ha gestionado tu reserva, puedes retirarlo mañana</h1>
                                        <br>
                                <img src='http://10.10.10.199/bookbusters/privado/avatares/Bookbusterscapa.png'>";
                $header = "MIME-Version: 1.0 \r\n";
                $header .= "Content-type:text/html;charset=UTF-8 \r\n";
                $header .= "From: dani@medellin.ef";
                mail($para, $asunto, $mensaje, $header);
                echo "Confirmacion Enviada";
        } elseif (($_POST["enviarmail"]) == "entrega") {

                //CORREO ADMINISTRADOR A ENTREGADO LIBRO, ACTUALIZACION FECHAS PRESTAMOS (ENTREGA)

                //ACTUALIZACION TABLA
                $codusu = $_POST["codusu"];
                $fecha = $_POST["fecha"];
                $fentrega = date('Y-m-d', strtotime($fecha . ' +1 day'));
                $fprevista = date('Y-m-d', strtotime($fecha . ' +15 day'));
                $sql_entrega = "UPDATE prestamos
                SET fentrega_pres='$fentrega',fprevista_pres='$fprevista'
                WHERE prestamos.cod_usu=$codusu";
                $con->query($sql_entrega);

                //ENVIO CORREO
                $usuario = $_POST["usuario"];
                $para = $_POST["mail"];
                $fprevista_invertida = strtotime($fprevista);
                $fprevista_correo = date("d-m-Y", $fprevista_invertida);

                $asunto = "Confirmación entrega, libro Bookbusters";
                $mensaje = "<h1>Hola,$usuario.<br>Hemos registrado tu reserva, la fecha máxima para devolver es: $fprevista_correo</h1>
                                        <br>
                                <img src='http://10.10.10.199/bookbusters/privado/avatares/Bookbusterscapa.png'>";

                $header = "MIME-Version: 1.0 \r\n";
                $header .= "Content-type:text/html;charset=UTF-8 \r\n";
                $header .= "From: dani@medellin.ef";
                mail($para, $asunto, $mensaje, $header);
        } else {

                //ADMINISTRADOR A RECIBIDO EL LIBRO DE VUELTA
                include("./../../privado/php/funciones.php");

                //ACTUALIZACION FECHA DEVOLUCION TABLA PRESTAMOS Y LIBROS DISPONIBLE (0)
                $codusu = $_POST["codusu"];
                $sql_devolucion = "UPDATE prestamos
                INNER JOIN libros
                ON prestamos.cod_lib=libros.cod_lib
                SET prestamos.fdevolucion_pres='$hoy',libros.disponible_lib='0'
                WHERE prestamos.cod_usu=$codusu";
                $con->query($sql_devolucion);

                // PREPARACION VARIABLES DEL CORREO VALORACION (URL ENCRIPADA)
                //Se crea un registro sin valorar, eso ocurrira luego cuando el usuario elija una ESTRELLA con un UPDATE
                $coduniq = uniqid();//CODIGO DE AUTENTICACION
                $codlibro = $_POST["codlibro"];
                $hoy = date('Y-m-d');


                $sql_valoracion = "INSERT INTO valoraciones (cod_lib,val_uniq,fecha_val) VALUES ('$codlibro','$coduniq','$hoy')";
                $ej_val = $con->query($sql_valoracion);

                $id = $con->insert_id;
                $texto_a_encrip= $codlibro."$$".$id;
                $encrip = encriptado("e",$texto_a_encrip);

                //PREPARACION DE CORREO
                $usuario = $_POST["usuario"];
                $para = $_POST["email"];
                $asunto = "Valora el libro Bookbusters leido";
                $mensaje = <<<HTML
                
                <head>
                <style>
                .estrellas {
                        font-size: 0;
                        display: inline-block;
                }
                .estrellas a {
                        text-decoration: none;
                        display: inline-block;
                        font-size: 32px;
                        font-size: 2rem;
                        color: #888;
                }
                .estrellas:hover a {
                        color: rgb(39, 130, 228);
                }
                .estrellas > a:hover ~ a {
                        color: #888;
                }
                </style>
                </head>
                <h1>Valoración de libro</h1>
                <p>Por favor, valora nuestro libro:</p>
                <div class="estrellas">
                        <a href="http://10.10.10.199/bookbusters/privado/valorar.php?valoracion=1&m=$encrip&u=$coduniq" data-value="1" title="Votar con 1 estrellas">&#9733;</a>
                        <a href="http://10.10.10.199/bookbusters/privado/valorar.php?valoracion=2&m=$encrip&u=$coduniq" data-value="2" title="Votar con 2 estrellas">&#9733;</a>
                        <a href="http://10.10.10.199/bookbusters/privado/valorar.php?valoracion=3&m=$encrip&u=$coduniq" data-value="3" title="Votar con 3 estrellas">&#9733;</a>
                        <a href="http://10.10.10.199/bookbusters/privado/valorar.php?valoracion=4&m=$encrip&u=$coduniq" data-value="4" title="Votar con 4 estrellas">&#9733;</a>
                        <a href="http://10.10.10.199/bookbusters/privado/valorar.php?valoracion=5&m=$encrip&u=$coduniq" data-value="5" title="Votar con 5 estrellas">&#9733;</a>
                </div>
                HTML;

                $header = "MIME-Version: 1.0 \r\n";
                $header .= "Content-type:text/html;charset=UTF-8 \r\n";
                $header .= "From: dani@medellin.ef";
                mail($para, $asunto, $mensaje, $header);
        }
} else {
        echo "No hay reservas pendientes...";
}

        ?>