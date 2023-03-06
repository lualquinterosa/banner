<?php include "../conn.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>   
    <?php include("../head.php"); ?>
</head>
<body>
<br />

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
            $usersid = intval($_GET['usersid']);
			$sql = mysqli_query($conn, "SELECT * FROM users WHERE users.usersid='$usersid'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            
            <blockquote>
            Actualizar datos de usuario
            </blockquote>
                         <form name="form1" id="form1" class="form-horizontal row-fluid" action="update-edit.php" method="POST" >
										
										
									
										<div class="control-group">
											<label class="control-label" for="usersid">ID Usuario</label>
											<div class="controls">
												<input type="text" name="usersid" id="usersid"  value="<?php echo $row['usersid']; ?>" placeholder="ID Usuario" class="form-control span8 tip" readonly="readonly">
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label class="control-label" for="usersnombre">Nombre de usuario*</label>
											<div class="controls">
												<input type="text" name="usersnombre" id="usersnombre" value="<?php echo $row['usersnombre']; ?>" placeholder="Nombre del usuario " class="form-control span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="usersmail">Correo electrónico*</label>
											<div class="controls">
												<input type="email" name="usersmail" id="usersmail" value="<?php echo $row['usersmail']; ?>" placeholder="Mail del usuario" class="form-control span8 tip" required>
											</div>
										</div>										

										<?php 
										if($row['usersrol']==1) $usersrol="Administrador"; 
										if($row['usersrol']==2) $usersrol="Visitante";	
										
										?>
										<div class="control-group">
											<label class="control-label" for="usersrol">Rol*</label>
									
												<div class="controls">
												  <select class=" form-control span8 tip" name="usersrol"id="usersrol" placeholder="Rol del usuario" required>
														    <option value="<?php echo $row['usersrol'];  ?>" ><?php echo $usersrol; ?></option>
															<option value="1">Administrador</option>
															<option value="2">Visitante</option>
															</select>
					
												</div>
									
										</div>
									
										
										<?php 
										if($row['usersestado']=="A") $estado="Si"; 
										if($row['usersestado']=="N") $estado="No"; 
																			
										?>
									<div class="control-group">
											<label class="control-label" for="usersestado">Activo*</label>
									
												<div class="controls">
												  <select class=" form-control span8 tip" name="usersestado"id="usersestado" placeholder="" required>
														      <option value="<?php echo $row['usersestado'];  ?>" ><?php echo $estado; ?></option>
														<option Value="A">Si</option>
															<option value="N">No</option>
															</select>
					
												</div>
									
										</div>
										
										<hr>
										<div class="control-group">
											<label class="control-label" for="userspassword">Cambiar contraseña</label>
											<div class="controls">
												<input type="text" name="userspassword" id="userspassword" placeholder="Contraseña nueva" class="form-control span8 tip" >
											</div>
										</div>
										
										<div class="control-group">
											<div class="controls">
												<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
                                               <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
											</div>
										</div>
										<br /><br /><br /><br />
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
