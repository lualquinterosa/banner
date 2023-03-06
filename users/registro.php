<?php include "../conn.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("../head.php");?>
    </head>
    <body>
     <br />

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
			if(isset($_POST['input'])){
				$usersnombre	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersnombre'], ENT_QUOTES)));
				$usersmail	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersmail'], ENT_QUOTES)));
				$userspassword	= md5(mysqli_real_escape_string($conn,(strip_tags($_POST['userspassword'], ENT_QUOTES))));
				$usersestado	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersestado'], ENT_QUOTES)));
				$escuelacodigo  = mysqli_real_escape_string($conn,(strip_tags($_POST['escuelacodigo'], ENT_QUOTES)));
				$usersrol	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersrol'], ENT_QUOTES)));
			
				$insert = mysqli_query($conn, "INSERT INTO users( `usersnombre`, `usersmail`, `userspassword`, `usersestado`, `usersrol` ) 
				VALUES('$usersnombre','$usersmail','$userspassword','$usersestado','$usersrol')") 
				or die("INSERT INTO users( `usersnombre`, `usersmail`, `userspassword`, `usersestado`, `usersrol` ) 
				VALUES('$usersnombre','$usersmail','$userspassword','$usersestado','$usersrol')".mysqli_error($conn));
					
						
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido agregados correctamente.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>';
						}
				
			}
			?>
            
            <blockquote>
            Agregar usuario
            </blockquote>
                         <form name="form1" id="form1" class="form-horizontal row-fluid" action="registro.php" method="POST" >
										
										<div class="control-group">
											<label class="control-label" for="usersnombre">Nombre de usuario*</label>
											<div class="controls">
												<input type="text" name="usersnombre" id="usersnombre" placeholder="Nombre del usuario " class="form-control span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="usersmail">Correo electrónico*</label>
											<div class="controls">
												<input type="email" name="usersmail" id="usersmail" placeholder="Mail del usuario" class="form-control span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="userspassword">Contraseña*</label>
											<div class="controls">
												<input type="text" name="userspassword" id="userspassword" placeholder="Contraseña" class="form-control span8 tip" required>
											</div>
										</div>

										
										<div class="control-group">
											<label class="control-label" for="rol">Rol*</label>
									
												<div class="controls">
												  <select class=" form-control span8 tip" name="usersrol"id="usersrol" placeholder="Rol del usuario" required>
														    <option></option>
															<option value="1">Administrador</option>
															<option value="3">Visitante</option>
															</select>
					
												</div>
									
										</div>										
										
										<div class="control-group">
											<label class="control-label" for="usersestado">Activo*</label>
									
												<div class="controls">
												  <select class=" form-control span8 tip" name="usersestado"id="usersestado" placeholder="" required>
														    <option></option>
															<option Value="A">Si</option>
															<option value="N">No</option>
															</select>
					
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
