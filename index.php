<?php 
session_start();
if(!isset($_SESSION['name'])) {
	header("Location: login.php");
	

}// else echo $_SESSION['usr_id'];
 include "./conn.php"; ?>

			
<!DOCTYPE html>
<html lang="es">
<head>


		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>BANNER</title>
		<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- BEGIN CSS for this page -->
		<!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<!-- END CSS for this page -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
   <script>
	  
	   
	    function go(loc) {

    document.getElementById('abrirventana').src = loc;
	document.EnviarPag.varPHP.value=loc;
    document.EnviarPag.submit(); 
	
  }
   
 </script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script type="text/javascript" src="./js/wow-alert.js"></script>
<script type="text/javascript" src="./js/example.js"></script>


</body>
</head>

<body class="adminbody" style="overflow-y:hidden">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="index.php" class="logo"><!--img alt="Logo" src="./img/logo.jpg" /--> <span>Banner</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
						
						
						 <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                						<!--img src="assets/images/personaB.png" alt="Profile image" class="avatar-rounded"-->
                                						<img src="img/avatar.jpg" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hola,  <?php echo $_SESSION['name']; ?></small> </h5>
                                </div>

                                <!-- item-->
								<?php 
								$usersid = $_SESSION['usersid'];
								
								$rs = mysqli_query($conn,"SELECT usuariocodigo FROM usuario WHERE usersid='$usersid'");	
								if ($row = mysqli_fetch_row($rs)) {
									$usuariocodigo = trim($row[0]);
									}
										
								?>
								
                                <!--a href="#" onclick="go('usuario/editar.php?usuariocodigo=<?php echo $usuariocodigo; ?>')" class="dropdown-item notify-item">
                                    <i class="fa fa-user"  ></i> <span>Perfil</span>
                                </a-->

                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off" ></i> <span>Salir</span>
                                </a>
								
								<!-- item>
                                <a target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item">
                                    <i class="fa fa-external-link"></i> <span>Pike Admin</span>
                                </a-->
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>

        </nav>

	</div>
	<!-- End Navigation -->
	
 
	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">

			<?php 
			$usersid = $_SESSION['usersid'];
								
			$rs = mysqli_query($conn,"SELECT usersrol FROM users WHERE usersid='$usersid'");	
			if ($row = mysqli_fetch_row($rs)) {
				$usersrol = trim($row[0]);
				}
			?>
        
			<ul>
					<?php 
					if ($usersrol==1) {

?>
				
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-user-o"></i> <span> Administrador </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
							
    <li><a href="#" rel="2" onclick="go('users/')" class="button">Usuarios</a><br /></li> 
	
							</ul>
                    </li>

				<?php } ?>
				
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-book"></i> <span> Datos </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
							
	<li><a href="#" rel="1" onclick="go('banner/')" class="button">Banner</a><br /></li> 
  						</ul>
                    </li>
						
			</ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">
					
			<?php
				//La mostramos a través de un form con PHP y un campo oculto
				 
				echo "<form action=$_SERVER[PHP_SELF] method=post name=EnviarPag>";
				$Pag=$_POST['varPHP'];
							echo"  <input type=hidden name=varPHP value='$Pag'></form>";
				 
				echo "<script language='javascript'>
							 
				</script>";
				if($Pag=="")$Pag="p0.php";		
				?>
							
				
				<iframe width=100%  name="abrirventana" id="abrirventana" class='col-md-12' style="margin-top:0px;margin-left:0%;" frameborder="0" allowfullscreen onload="this.width=screen.width;this.height=screen.height;" scrolling="si" src="<?php echo $Pag; ?>"></iframe>
					



            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
	<footer class="footer">
	
	</footer>

</div>
<!-- END main -->

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>
		
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

	<!-- Counter-Up-->
	<script src="assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>			

	<script>
		$(document).ready(function() {
			// data-tables
			$('#example1').DataTable();
					
			// counter-up
			$('.counter').counterUp({
				delay: 10,
				time: 600
			});
		} );	
$('.iframe-full-height').on('load', function(){
    //this.style.height=window.outerHeight + 'px';//
	   this.style.height=this.contentDocument.body.offsetHeight  +'1px';;//this.contentDocument.body.offsetHeight +'px';
});		
	</script>
	
	<script>
	var ctx1 = document.getElementById("lineChart").getContext('2d');
	var lineChart = new Chart(ctx1, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
					label: 'Dataset 1',
					backgroundColor: '#3EB9DC',
					data: [10, 14, 6, 7, 13, 9, 13, 16, 11, 8, 12, 9] 
				}, {
					label: 'Dataset 2',
					backgroundColor: '#EBEFF3',
					data: [12, 14, 6, 7, 13, 6, 13, 16, 10, 8, 11, 12]
				}]
				
		},
		options: {
						tooltips: {
							mode: 'index',
							intersect: false
						},
						responsive: true,
						scales: {
							xAxes: [{
								stacked: true,
							}],
							yAxes: [{
								stacked: true
							}]
						}
					}
	});


	var ctx2 = document.getElementById("pieChart").getContext('2d');
	var pieChart = new Chart(ctx2, {
		type: 'pie',
		data: {
				datasets: [{
					data: [12, 19, 3, 5, 2, 3],
					backgroundColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					label: 'Dataset 1'
				}],
				labels: [
					"Red",
					"Orange",
					"Yellow",
					"Green",
					"Blue"
				]
			},
			options: {
				responsive: true
			}
	 
	});


	var ctx3 = document.getElementById("doughnutChart").getContext('2d');
	var doughnutChart = new Chart(ctx3, {
		type: 'doughnut',
		data: {
				datasets: [{
					data: [12, 19, 3, 5, 2, 3],
					backgroundColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					label: 'Dataset 1'
				}],
				labels: [
					"Red",
					"Orange",
					"Yellow",
					"Green",
					"Blue"
				]
			},
			options: {
				responsive: true
			}
	 
	});
	
	
	
	
	
	</script>
<!-- END Java Script for this page -->


</html>
