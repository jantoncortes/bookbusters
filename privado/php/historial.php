<?php

    session_start();

    if(isset($_SESSION["bookbusters"])){
        // Recogemos el código de usuario de los datos recibidos en la sesión.
        $usuario = $_SESSION["bookbusters"];
        //$usuario = 8;
		// Creamos una conexión	
        $conexion = new mysqli("localhost","busters","1234","biblioteca");
		//$conexion = new mysqli("10.10.10.199","busters","1234","biblioteca");
		
		// Buscamos el nombre del usuario a través del código de usuario
		$sqlConsultaNombreUsuario = "SELECT nom_usu FROM usuarios WHERE cod_usu='$usuario'";
		$ejecutarSqlConsultaNombreUsuario = $conexion->query($sqlConsultaNombreUsuario)->fetch_assoc();		
		$nombreUsuario = $ejecutarSqlConsultaNombreUsuario["nom_usu"];
		
		// Consultamos los libros que tiene en préstamo el usuario para generar el historial	
        $sqlConsultaLibrosLeidos = "SELECT * FROM prestamos INNER JOIN libros USING(cod_lib) WHERE cod_usu='$usuario'";    
        $ejecutarSqlConsultaLibrosLeidos = $conexion->query($sqlConsultaLibrosLeidos);
        if($ejecutarSqlConsultaLibrosLeidos->fetch_array()){
            foreach ($ejecutarSqlConsultaLibrosLeidos as $registro) {
                $nombreImagen = $registro["imagen_lib"];
                $codigoLibro = $registro["cod_lib"];
                $ruta = "./../images/portadas/".$codigoLibro."/".$nombreImagen;
                $nombreLibro = $registro["titulo_lib"];
                $codigoUsuario = $registro["cod_usu"];

                $fechaReserva = $registro["freserva_pres"];
                $fechaReserva = explode("-",$fechaReserva);                        
                $fechaReserva = $fechaReserva[2]."-".$fechaReserva[1]."-".$fechaReserva[0]; 

                $fechaEntrega = $registro["fentrega_pres"];
                $fechaEntrega = explode("-",$fechaEntrega);                        
                $fechaEntrega = $fechaEntrega[2]."-".$fechaEntrega[1]."-".$fechaEntrega[0];

				$fechaActual = date('Y-m-d');
				$fechaActual = explode("-",$fechaActual);                        
                $fechaActual = $fechaActual[2]."-".$fechaActual[1]."-".$fechaActual[0];
				
				$fechaHoy = new DateTime($fechaActual);
				
				$fechaPrevista = $registro["fprevista_pres"];
                $fechaPrevista = explode("-",$fechaPrevista);                        
                $fechaPrevista = $fechaPrevista[2]."-".$fechaPrevista[1]."-".$fechaPrevista[0];
				
				$fechaDevolucionPrevista = new DateTime($fechaPrevista);

                $fechaDevolucion = $registro["fdevolucion_pres"];
                $fechaDevolucion = explode("-",$fechaDevolucion);                        
                $fechaDevolucion = $fechaDevolucion[2]."-".$fechaDevolucion[1]."-".$fechaDevolucion[0];
								
				$fechaDevolucionDatetime = new DateTime($fechaDevolucion);
				$fechaVaciaDateTime = new DateTime('00-00-0000');				

				if(($fechaDevolucionPrevista!=$fechaVaciaDateTime) && ($fechaDevolucionDatetime==$fechaVaciaDateTime)){
					$pintarBotonDevolverLibro = "<button id='1' onclick='devolverLibro(this.id)'>Solicitar Devolución</button>";
				} else {
					$pintarBotonDevolverLibro = "";
				}
				
				if($fechaDevolucionDatetime==$fechaVaciaDateTime){
					
					if($fechaHoy<=$fechaDevolucionPrevista){
						// Se devuelve la fecha prevista de devolución con color verde, porque el libro no ha sido devuelto, pero quedan días para llegar a fecha de devolución prevista.
						$pintarFechaPrevista = "<td style='font-family:auto; font-size:auto; color:green'>$fechaPrevista</td>";
					} else {
						// Se devuelve la fecha prevista de devolución con color rojo, porque el libro no ha sido devuelto, y se sobrepasado la fecha de devolución prevista.
						$pintarFechaPrevista = "<td style='font-family:auto; font-size:auto; color:red'>$fechaPrevista</td>";
					}
					
				} else {
						// Se devuelve la fecha prevista de devolución sin color, porque el libro ya ha sido devuelto.
						$pintarFechaPrevista = "<td style='font-family:auto; font-size:auto;'>$fechaPrevista</td>";
									
				}
				
				// Se devuelve el historial de libros para mostrar en el historial.html
				echo "
							<article style='display:flex;flex-direction:column;align-items:center;'>
								<a href='#' class='image'style='text-align:-webkit-center'><img src='$ruta' height='350px' alt=''/></a>
								<div style='width:100%; display:flex; flex-direction:column; align-items:center;'>
									<h4>$nombreLibro</h4>
									
								</div>
								<table style='width:80%; text-align:center;'>
										<tr>
											<th style='font-family:auto; text-align:center; padding-top:10px;'>Fecha Reserva</th>
										</tr>
										<tr>
											<td style='font-family:auto; font-size:auto;'>$fechaReserva</td>
										</tr>
										<tr>
											<th style='font-family:auto; text-align:center; padding-top:10px;'>Fecha Entrega</th>
										</tr>
										<tr>
											<td style='font-family:auto; font-size:auto;'>$fechaEntrega</td>
										</tr>
										<tr>
											<th style='font-family:auto; text-align:center; padding-top:10px;'>Fecha Prevista</th>
										</tr>
										<tr>
											$pintarFechaPrevista
										</tr>
										<tr>
											<th style='font-family:auto; text-align:center; padding-top:10px;'>Fecha Devolución</th>
										</tr>
										<tr>
											<td style='font-family:auto; font-size:auto;'>$fechaDevolucion</td>
										</tr>								
									</table>																									                               
							</article>                 
						";         
				
            }
                            
        } else {
			
			// Se devuelve mensaje si el usuario no tiene libros en el historial
            echo "
                <message>
                    <h2>Sin historial ............... !!! Parece que no lees mucho....!!!</h2>
                </message>    
            ";                     
        } 
		
	// Se envía el nombre de usuario para mostrar en la cabecera de historial.html
	echo "
		<script>
				$(function(){
					$('#header a.logo strong').last().text('$nombreUsuario');
				})
			
		</script>
	";
		
    } else {
		
		// Se devuelve mensaje si el usuario no tiene sesión abierta
		
		echo "
            <message>
                <h2>No tienes permisos para estar aquí.  Por favor, inicia sesión.</h2>
                <br><br><br>
		        <button onclick='window.location.href=`./../login.html`'>Volver</button>
            </message>
        ";
	}
              			  
?>