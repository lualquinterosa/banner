<?php 

function eliminar($tabla,$condicion){
global $conn;
$sqlB= "SELECT * fROM $tabla WHERE  $condicion";	
$queryB = mysqli_query($conn, $sqlB) or die($sqlB." hola ".mysqli_error($conn));
		return mysqli_num_rows($queryB); 
	
}

?>
