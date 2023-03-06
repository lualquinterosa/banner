<?php
include "../conn.php";
include("../head.php");

if(isset($_POST['update'])){
	
				$banner_id			= intval($_POST['banner_id']);
				//$banner_ingreso	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_ingreso'], ENT_QUOTES)));
				$banner_retiro	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_retiro'], ENT_QUOTES)));
				$banner_titulo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_titulo'], ENT_QUOTES)));
				$banner_descripcion	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_descripcion'], ENT_QUOTES)));
				$banner_file	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_file'], ENT_QUOTES)));
				$banner_link	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_link'], ENT_QUOTES)));
				$banner_aretiro	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_aretiro'], ENT_QUOTES)));
				$banner_atitulo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_atitulo'], ENT_QUOTES)));
				$banner_adescripcion	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_adescripcion'], ENT_QUOTES)));
				$banner_alink	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_alink'], ENT_QUOTES)));
				$banner_activo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_activo'], ENT_QUOTES)));

			   	//die($banner_file);
				$findme   = './slider/';
				$pos = strpos($banner_file, $findme);
				if ($pos === false) {
						//echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
					if(array_key_exists('archivo', $_FILES)){
							if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
							   echo 'upload was successful';
							  
							  	$nomficha=$_FILES['archivo']['name'];
								$extension = pathinfo($nomficha, PATHINFO_EXTENSION);
								$fichas=$_FILES['archivo']['tmp_name'];
							  
							  
								//echo $nomficha." - ";
								//echo $fichas.$_FILES['ficha']['error'];
								//var_dump($_FILES);		
								$nombre_carpeta = "./slider/imagenes";
										
								if(!is_dir($nombre_carpeta)){
								@mkdir($nombre_carpeta, 0700);
								} 
								/*$rs = mysqli_query($conn,"SELECT MAX(banner_id) AS id FROM banner");
								if ($row = mysqli_fetch_row($rs)) {
								$banner_id = trim($row[0]);
								if ($banner_id==NULL)$banner_id=0;
								$banner_id +=1; */
								$nombreformato=$banner_id;
								}
								
								if(!is_dir($nombre_carpeta)){
								@mkdir($nombre_carpeta, 0700);
								} 
								
							  if (file_exists("$nombre_carpeta/$nombreformato.$extension")) @unlink("$nombre_carpeta/$nombreformato.$extension");
							  move_uploaded_file($_FILES['archivo']['tmp_name'],"$nombre_carpeta/$nombreformato.$extension"); 
							  echo $_FILES['archivo']['tmp_name'];
							} else {
							   die("Upload failed with error code " . $_FILES['archivo']['error']);
							}
								$banner_file  = mysqli_real_escape_string($conn,(strip_tags("$nombre_carpeta/$nombreformato.$extension", ENT_QUOTES)));
				
							}
						
					
					} else {
						
						 //	 echo "<br><br><br><br>no es una actualización";
						
						}
						
						if ($banner_aretiro	=="on") $banner_aretiro=1;
						else $banner_aretiro = 0;
						if ($banner_atitulo	=="on") $banner_atitulo=1;
						else $banner_atitulo = 0;
						if ($banner_adescripcion=="on") $banner_adescripcion=1;
						else $banner_adescripcion = 0;
						if ($banner_alink=="on") $banner_alink=1;
						else $banner_alink = 0;	
			
				$update = mysqli_query($conn, "UPDATE `banner` SET 
				
				`banner_retiro`='$banner_retiro', 
				`banner_titulo`='$banner_titulo', 
				`banner_descripcion`='$banner_descripcion', 
				`banner_file`='$banner_file', 
				`banner_link`='$banner_link',
				`banner_aretiro`='$banner_aretiro', 				
				`banner_atitulo`='$banner_atitulo', 
				`banner_adescripcion`='$banner_adescripcion', 
				`banner_alink`='$banner_alink',
				`banner_activo`='$banner_activo'
				
				WHERE banner_id='$banner_id'
				") or die(mysqli_error($conn)."UPDATE `banner` SET 
				
				`banner_retiro`='$banner_retiro', 
				`banner_titulo`='$banner_titulo', 
				`banner_descripcion`='$banner_descripcion', 
				`banner_file`='$banner_file', 
				`banner_link`='$banner_link',
				`banner_aretiro`='$banner_aretiro', 				
				`banner_atitulo`='$banner_atitulo', 
				`banner_adescripcion`='$banner_adescripcion', 
				`banner_alink`='$banner_alink',
				`banner_activo`='$banner_activo'
				
				WHERE banner_id='$banner_id'
				");
				if($update){
					echo "<script>alert('¡Bien hecho!','Los datos han sido actualizados!','index.php');</script>";
			}else{
					echo "<script>alert('Error', 'No se pudo actualizar los datos','index.php');</script>";
				
			}
  ?>