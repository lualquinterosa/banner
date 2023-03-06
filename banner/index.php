<?php 
session_start();
include "../conn.php";?>
<?php include "../funciones.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	
		
		<?php include("../head.php");?>
	
    </head>
    <body>
        <!--div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <!--a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="http://obedalvarado.pw/" target="_blank">Sistemas Web</a-->
                   
                   
                <!--/div>
            </div-->
            <!-- /navbar-inner -->
        <!--/div--><br />

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
				if(isset($_GET['action']) == 'delete'){
				 
				
				$id_delete = intval($_GET['banner_id']);
				//if (eliminar("users","banner_id='$id_delete'")== 0)	{
					$query = mysqli_query($conn, "SELECT * FROM banner WHERE banner_id='$id_delete'");
			  $row=mysqli_fetch_array($query);
			  $archivo=$row['banner_file'];
				if (file_exists($archivo)) @unlink("$archivo");
							  
					if(mysqli_num_rows($query) == 0){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
					}else{
						
						
						
						$delete = mysqli_query($conn, "DELETE FROM banner WHERE banner_id='$id_delete'");
						if($delete){
							echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, los datos han sido eliminados correctamente.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
						}
					}
				//}else echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos, existen valores referenciados en el banner.</div>';
				
				
			}
			?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title"><!--i class="icon-user"></i--> Banners - <a href="./slider/index.php" target="_blank">Ver Slider</a>
 </h3>  						
                        </div>
						
                        <div class="panel-body">
							<div class="pull-right">
							<?php 
			$usersid = $_SESSION['usersid'];
								
			$rs = mysqli_query($conn,"SELECT usersrol FROM users WHERE usersid='$usersid'");	
			if ($row = mysqli_fetch_row($rs)) {
				$usersrol = trim($row[0]);
				}
			
				if ($usersrol==1) {
?>
								<a href="registro.php" class="btn btn-sm btn-primary">Nuevo Banner</a>
						
							</div><br>
							<hr>

							<?php } ?>
                                    <table id="lookup" class="table table-bordered table-hover">  
	                                   <thead bgcolor="#eeeeee" align="center">
                                        <tr>
	  
                                        <th>ID</th>
                                        <th>Ingreso</th>
                                        <th>Retiro</th>
	                                    <th>Título  </th>
	                                    <th>Descripción  </th>
	                                    <th>Imagen  </th>
	                                    <th>Enlace  </th>
	                                    <th>Estado  </th>
										<?php 
											if ($usersrol==1) {
										?>
                                        <th class="text-center"> Acciones </th> 
										<?php } ?>
                                       </tr>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                           
                                </div>
                            </div>
                            
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
					
            </div>
            <!--/.container-->
        
        <!--/.wrapper--><br />
        <!--/.wrapper--><br />
        <!--/.wrapper--><br />
        <!--/.wrapper--><br />
        <div class="footer span-12">
            <div class="container">
		
             </div>
        </div>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="../datatables/jquery.dataTables.js"></script>
        <script src="../datatables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					
				 "language":	{
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},

					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ajax-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
			
			
</script>
   

		
	
    </body>

		