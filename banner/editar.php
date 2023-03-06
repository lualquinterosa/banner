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
    </head>
    <body>
   <br />

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
			$banner_id = intval($_GET['banner_id']);
			$sql = mysqli_query($conn, "SELECT * FROM banner WHERE banner_id='$banner_id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            
            <blockquote>
            Actualizar datos del banner
            </blockquote>
                         <form name="form1" id="form1" class="form-horizontal row-fluid" action="update-edit.php" method="POST" enctype="multipart/form-data">
										
										
									
										<div class="control-group">
											<label class="control-label" for="banner_id">ID banner</label>
											<div class="controls">
												<input type="text" name="banner_id" id="banner_id"  value="<?php echo $row['banner_id']; ?>" placeholder="ID Banner" class="form-control span8 tip" readonly="readonly">
											</div>
										</div>			
										<div class="control-group">
											<label class="control-label" for="banner_titulo">Título del banner*</label>
											<div class="controls">
												<input type="text" name="banner_titulo" id="banner_titulo"  value="<?php echo $row['banner_titulo']; ?>"  placeholder="Nombre de la banner" class="form-control span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="banner_descripcion">Descripción</label>
											<div class="controls">
												<input type="text" name="banner_descripcion" id="banner_descripcion"  value="<?php echo $row['banner_descripcion']; ?>"  placeholder="Descripción" class="form-control span8 tip" >
											</div>
										</div>										
										
										<div class="control-group">
											<label class="control-label" for="banner_activo">Estado*</label>
												<div class="controls">
													<select class=" form-control span8 tip" name="banner_activo"id="banner_activo" placeholder="Estado del banner" required>
														<option value="<?php echo $row['banner_activo']; ?>"><?php echo $row['banner_activo']; ?></option>
														<option value="Activo">Activo</option>
														<option value="No activo">No activo</option>
													</select>
												</div>									
										</div>

										<div class="control-group">
											<label class="control-label" for="banner_retiro">Fecha de retiro</label>
											<div class="controls">
												<input type="date" name="banner_retiro" id="banner_retiro"  value="<?php echo $row['banner_retiro']; ?>"  placeholder="" class="form-control span8 tip" >
											</div>
										</div>

										<div class="control-group" >
											<label class="control-label"  for="archivo"><b>Imagen 200X600 px (jpg o png)*</b></label>
        		
										<div class="controls">
											<div class="input-group input-file" name="archivo">
											<span class="input-group-btn">
												<button class="btn btn-default btn-choose" type="button">Archivo</button>
											</span>
													
											<input  name="banner_file"  id="banner_file" type="text" class="form-control span6" value="<?php echo $row['banner_file']; ?>" placeholder='Selecciona un archivo jpf o png '  required/>
											
												 <button class="btn btn-warning btn-reset " type="button">Cancelar</button>
										
															
											</div>
										</div>
										   
									</div>
										<div class="control-group">
											<label class="control-label" for="banner_link">Link</label>
											<div class="controls">
												<input type="url" name="banner_link" id="banner_link" value="<?php echo $row['banner_link']; ?>"  placeholder="http://www.google.com" class="form-control span8 tip" >
											</div>
										</div>

										<?php 
										if ($row['banner_atitulo']==1) $banner_atitulo="checked";
										if ($row['banner_adescripcion']==1) $banner_adescripcion="checked";
										if ($row['banner_aretiro']==1) $banner_aretiro="checked";
										if ($row['banner_alink']==1) $banner_alink="checked";
										
										?>

										<div class="control-group">
										<label class="control-label">Agregar características</label>
										
										<div class="controls">
									
<br><br>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_atitulo" id="banner_atitulo"  class="form-check-input" <?php echo $banner_atitulo;?> >
									  Título a la imagen
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_adescripcion" id="banner_adescripcion"  class="form-check-input"  <?php echo $banner_adescripcion;?> >
									   Descripción
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_aretiro" id="banner_aretiro"  class="form-check-input"  <?php echo $banner_aretiro;?> >
									   Fecha de retiro 
									</label>
								  </div>
										<div class="form-check">
									<label class="form-check-label">
									  <input type="checkbox" name="banner_alink" id="banner_alink"  class="form-check-input"   <?php echo $banner_alink;?> >
									   Link de redirección
									</label>
								  </div>
							
										</div>
									
									
										</div>
										
										
										<div class="control-group">
											<div class="controls">
												<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
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
