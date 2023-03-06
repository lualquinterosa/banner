<?php include "../conn.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
        <?php include("../head.php");?>
		
		<script>		
function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				element.attr("name",$(this).attr("name"));
				element.change(function(){
			//var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
					var fileExtension = ['jpg','png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert('Error',"Solo archivos : "+fileExtension.join(', '),'');
			return false;
				}
				
				var fileSize = this.files[0].size;

					if(fileSize > 5000000){
						alert('Error','El archivo no debe superar los 5MB','');
						this.value = '';
						this.files[0].name = '';
					}     				
				element.next(element).find('input').val((element.val()).split('\\').pop());
		});
				$(this).find("button.btn-choose").click(function(){
					element.click();
				});
				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});
				$(this).find('input').css("cursor","pointer");
				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});
				return element;
			}
		}
	);
}


$(function() {
	bs_input_file();
});
</script>

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    </head>
    <body>
    <br />
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
			if(isset($_POST['input'])){
				$banner_ingreso	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_ingreso'], ENT_QUOTES)));
				$banner_activo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_activo'], ENT_QUOTES)));
				$banner_retiro	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_retiro'], ENT_QUOTES)));
				$banner_titulo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_titulo'], ENT_QUOTES)));
				$banner_descripcion	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_descripcion'], ENT_QUOTES)));
				$banner_link	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_link'], ENT_QUOTES)));
				$banner_aretiro	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_aretiro'], ENT_QUOTES)));
				$banner_atitulo	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_atitulo'], ENT_QUOTES)));
				$banner_adescripcion	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_adescripcion'], ENT_QUOTES)));
				$banner_alink	= mysqli_real_escape_string($conn,(strip_tags($_POST['banner_alink'], ENT_QUOTES)));

				if ($banner_aretiro	=="on") $banner_aretiro=1;
				else $banner_aretiro = 0;
				if ($banner_atitulo	=="on") $banner_atitulo=1;
				else $banner_atitulo = 0;
				if ($banner_adescripcion=="on") $banner_adescripcion=1;
				else $banner_adescripcion = 0;
				if ($banner_alink=="on") $banner_alink=1;
				else $banner_alink = 0;

			if(array_key_exists('archivo', $_FILES)){
							if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
							   //echo 'upload was successful';
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
								$rs = mysqli_query($conn,"SELECT MAX(banner_id) AS id FROM banner");
								if ($row = mysqli_fetch_row($rs)) {
								$banner_id = trim($row[0]);
								if ($banner_id==NULL)$banner_id=0;
								$banner_id +=1; 
								$nombreformato=$banner_id;
								}
								
								if(!is_dir($nombre_carpeta)){
								@mkdir($nombre_carpeta, 0700);
								} 
								if (file_exists("$nombre_carpeta/$nombreformato.$extension")) @unlink("$nombre_carpeta/$nombreformato.$extension");
								move_uploaded_file($_FILES['archivo']['tmp_name'],"$nombre_carpeta/$nombreformato.$extension"); 
							 // echo $_FILES['archivo']['tmp_name'];
							} else {
								die("Upload failed with error code " . $_FILES['archivo']['error']);
							}
						}
							 //echo "<br><br><br><br>$nombre_carpeta/$nombreformato";
							//  echo $extension[1]."hola";
				//die();
				
				//$dirformato  = mysqli_real_escape_string($conn,(strip_tags("$nombre_carpeta/$nombreformato"."v".$versionformato.".pdf", ENT_QUOTES)));
				$banner_file  = mysqli_real_escape_string($conn,(strip_tags("$nombre_carpeta/$nombreformato.$extension", ENT_QUOTES)));
						
			$banner_ingreso=date("Y-m-d H:i:s");
			
			//die("INSERT INTO `banner`( `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`)
			//VALUES ('$banner_ingreso','$banner_retiro','$banner_titulo','$banner_descripcion','$banner_file','$banner_link')");
			
			$insert = mysqli_query($conn, "INSERT INTO `banner`( `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`, `banner_aretiro`,`banner_atitulo`, `banner_adescripcion`, `banner_alink`,banner_activo)
			VALUES ('$banner_ingreso','$banner_retiro','$banner_titulo','$banner_descripcion','$banner_file','$banner_link','$banner_aretiro','$banner_atitulo','$banner_adescripcion','$banner_alink','$banner_activo')")
			or die( "INSERT INTO `banner`( `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`, `banner_aretiro`,`banner_atitulo`, `banner_adescripcion`, `banner_alink`,banner_activo)
			VALUES ('$banner_ingreso','$banner_retiro','$banner_titulo','$banner_descripcion','$banner_file','$banner_link','$banner_aretiro','$banner_atitulo','$banner_adescripcion','$banner_alink','$banner_activo')".mysqli_error($conn));
						if($insert){
	  						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido agregados correctamente.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>';
						}
				
			}
			?>
            
            <blockquote>
            Agregar Banner
            </blockquote>
                        <form name="form1" id="form1" class="form-horizontal row-fluid" action="registro.php" method="POST" enctype="multipart/form-data">
										
										<div class="control-group">
											<label class="control-label" for="banner_titulo">Título del banner*</label>
											<div class="controls">
												<input type="text" name="banner_titulo" id="banner_titulo" placeholder="Título del banner " class="form-control span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="banner_descripcion">Descripción</label>
											<div class="controls">
												<input type="text" name="banner_descripcion" id="banner_descripcion" placeholder="Descripción" class="form-control span8 tip" >
											</div>
										</div>						
										
										<div class="control-group">
											<label class="control-label" for="banner_activo">Estado*</label>
												<div class="controls">
													<select class=" form-control span8 tip" name="banner_activo"id="banner_activo" placeholder="Estado del banner" required>
														<option value="Activo">Activo</option>
														<option value="No activo">No activo</option>
													</select>
												</div>									
										</div>
										
										<!--div class="control-group">
											<label class="control-label" for="banner_registro">Fecha de inicio</label>
											<div class="controls">
												<input type="date" name="banner_registro" id="banner_registro" placeholder="" class="form-control span8 tip" >
											</div>
										</div-->

										<div class="control-group">
											<label class="control-label" for="banner_retiro">Fecha de retiro</label>
											<div class="controls">
												<input type="date" name="banner_retiro" id="banner_retiro" placeholder="" class="form-control span8 tip" >
											</div>
										</div>

										<div class="control-group" >
											<label class="control-label"  for="archivo"><b>Imagen 200X600 px (jpg o png)*</b></label>
        		
										<div class="controls">
											<div class="input-group input-file" name="archivo">
											<span class="input-group-btn">
												<button class="btn btn-default btn-choose" type="button">Archivo</button>
											</span>
													
											<input id="banner_file" type="text" class="form-control span6" placeholder='Selecciona un archivo jpf o png '  required/>
											
												<button class="btn btn-warning btn-reset " type="button">Cancelar</button>
										
															
											</div>
										</div>										   
									</div>


										<div class="control-group">
											<label class="control-label" for="banner_link">Link</label>
											<div class="controls">
												<input type="url" name="banner_link" id="banner_link" placeholder="http://www.google.com" class="form-control span8 tip" >
											</div>
										</div>
										

										<div class="control-group">
										<label class="control-label">Agregar características</label>
										
										<div class="controls">
									
<br><br>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_atitulo" id="banner_atitulo"  class="form-check-input">
									  Título a la imagen
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_adescripcion" id="banner_adescripcion"  class="form-check-input">
									   Descripción
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_aretiro" id="banner_aretiro"  class="form-check-input">
									   Fecha de retiro 
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_alink" id="banner_alink"  class="form-check-input">
									   Link de redirección
									</label>
								  </div>
							
										</div>
									
									
										</div>
 
										
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Registrar</button>
                                               <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
											</div>
										</div>
										<br><br><br><br>
									</form>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        
        <!--/.wrapper--><br />
        <div class="footer span-12">
            <div class="container">
                </div>
        </div>

        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      
    </body>
