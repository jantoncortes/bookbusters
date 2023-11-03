<?php
  session_start();
  if(isset($_SESSION["bookbusters"])) {
    $codlibro = $_POST["codigolibro"];
    $coduser = $_POST["usuario"];
    
    $login = new mysqli("10.10.10.199","busters","1234","biblioteca");
    $sqlborrarreserva = "DELETE FROM prestamos WHERE cod_lib='$codlibro' AND cod_usu='$coduser' AND fentrega_pres='0000-00-00'";
    $ejeborraresrva=$login->query($sqlborrarreserva);
    $sqlconsultabaja="SELECT * FROM prestamos WHERE cod_lib='$codlibro' AND cod_usu='$coduser' AND fentrega_pres='0000-00-00'";
    if($login->query($sqlconsultabaja)->fetch_array())
    {
      //No se ha borrado el registro
      echo "Error en anulación reserva préstamo libro";
    }
    else
    {
      //No se encuentra el registro, por lo que se ha anulado la reserva
      echo "Anulación reserva préstamo libro realizada correctamente";
      $sqlactualizarlibro = "UPDATE libros SET disponible_lib = 0 where cod_lib = $codlibro";
      $login->query($sqlactualizarlibro);
      $usumail = "select * from usuarios where cod_usu=$coduser";
      $exeusu = $login->query($usumail);
      $regu = $exeusu->fetch_array();
      $nom = $regu["nom_usu"];
      $ap1 = $regu["ap1_usu"];
      $ap2 = $regu["ap2_usu"];
      $ema = $regu["email_usu"];
      $bookmail = "select * from libros where cod_lib=$codlibro";
      $exebo = $login->query($bookmail);
      $regb = $exebo->fetch_array();
      $book = $regb["titulo_lib"];

      $para = "alfonso@medellin.ef";
      //$para = el correo de administrador de la pagina
      $asunto = "Reserva Anulada";
      $mensaje = "<p>La reserva del  libro $book fue anulada por $nom $ap1 $ap2</p>
                  <p>$ema</p>
                  <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>";
      $header = "MIME-Version: 1.0 \r\n";
      $header .= "Content-type:text/html;charset=UTF-8 \r\n";
      $header .= "From: informacion@medellin.ef";
      //correo generio para el envio desde la pagina
      mail($para, $asunto, $mensaje, $header);

      //$para = "alfonso@medellin.ef";
      $para = $ema;
      $asunto = "Reserva Anulada";
      $mensaje = "<p>Anulaste la reserva del libro $book.</p>
                <img src='http://10.10.10.199/bookbusters/images/Bookbusters (3).png'>";
      $header = "MIME-Version: 1.0 \r\n";
      $header .= "Content-type:text/html;charset=UTF-8 \r\n";
      $header .= "From: informacion@medellin.ef";
      //correo generico para envio desde la pagina
      mail($para, $asunto, $mensaje, $header);
    }
  }
  else
  {
    echo "
      <script>
        alert('Area restringida');
        window.location.href='../login.html';
      </script>
    ";
  }     
?>