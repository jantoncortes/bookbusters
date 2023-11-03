<?php

	$ra=$_POST["letra1"];
	$re=$_POST["letra2"];
	$ri=$_POST["letra3"];
	$ro=$_POST["letra4"];
	$ru=$_POST["letra5"];
	$ras=$_POST["letra6"];
	$res=$_POST["letra7"];
	$ris=$_POST["letra8"];
	$conexion=new mysqli("10.10.10.199","busters","1234","ahorcado");
	
	


	$sql="SELECT * FROM palabras WHERE letra1 ='$ra'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo"<center><h1>  $ra</h1> </center>";
			
			
			
				
	}
	
	else
	{
			echo "<center><h1> _ </h1></center>";
	}
	$sql="SELECT * FROM palabras WHERE letra_2 ='$re'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
		echo "<center><h1 style= color:'green'>  $re</h1></center> ";
		
	}
	else
	{
		echo"<center><h1>_</h1></center>";
		
	}

		$sql="SELECT * FROM palabras WHERE letra_3 ='$ri'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo" <center><h1 font color='green'>$ri </h1> </center>";
	}
	else
	{
		echo"<center><h1>_</h1></center>";
	}
	
		$sql="SELECT * FROM palabras WHERE letra_4 ='$ro'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo" <center><h1 style=color'green'> $ro</h1> </center>";
	}
	else
	{
		echo" <center><h1> _ </h1></center> ";
	}
		$sql="SELECT * FROM palabras WHERE letra_5 ='$ru'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo"<center><h1 font-color='green'>$ru </h1></center>";
			
			
			
				
	}
	
	else
	{
			echo "<center><h1> _ </h1></center>";
	}
		$sql="SELECT * FROM palabras WHERE letra_6 ='$ras'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo"<center><h1 font-color='green'>$ras </h1></center>";
			
			
			
				
	}
	
	else
	{
			echo "<center><h1> _ </h1></center>";
	}
		$sql="SELECT * FROM palabras WHERE letra_7 ='$res'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo"<center><h1 font-color='green'>$res </h1></center>";
			
			
			
				
	}
	
	else
	{
			echo "<center><h1> _ </h1></center>";
	}
		$sql="SELECT * FROM palabras WHERE letra_8 ='$ris'";
	$ej=$conexion->query($sql);
	if($registroal=$ej->fetch_array())
	
	
	
	
	{
			echo"<center><h1 font-color='green'>$ris </h1></center>";
			
			
			
				
	}
	
	else
	{
			echo "<center><h1 font-color='red'> _ </h1><br><br></center>";
	}
	
		
	
	

?>
<html>


<center><button onclick="window.location.href='index.html'" >    <center>Volver

</button></center>
</html>
<?php


	echo"<script>
							alert('Llevas  Intentos');
						
						</script>";


?>






