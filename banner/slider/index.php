<?php include "../../conn.php"; ?>
<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Slider Responsive</title>
	<link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({
    	touch: true,
    	pauseOnAction: false,
    	pauseOnHover: false,
    });
  });
</script>
</head>
<body>
	<div class="flexslider">
		<ul class="slides">
		
		<?php
		$hoy=date("Y-m-d");
		//echo $hoy;
		
		$query = mysqli_query($conn,"SELECT * FROM banner where banner_activo= 'Activo' and banner_retiro > '".$hoy."'");
		while( $row=mysqli_fetch_array($query) ) {
			$file=$row['banner_file'];
			$link=$row['banner_link'];
			$titulo=$row['banner_titulo'];
			$descripcion=$row['banner_descripcion'];
			$retiro=$row['banner_retiro'];
		//	echo $file.$link;

			$carateristicas="";
			if ($row['banner_atitulo'] == true) $carateristicas .=$titulo;
			if ($row['banner_adescripcion'] == true) $carateristicas .="<br> $descripcion" ;
			if ($row['banner_aretiro'] == true) $carateristicas .="<br> Disponible hasta $retiro" ;
			if ($row['banner_alink'] == true) $carateristicas .="<br> redirección a $link" ;
	
			
			if ($link != ""){
			
			echo "
					
			<li>
				<a href=$link target='_blank'><img src=.$file ></a>
				<section class='flex-caption'>
					<p>
					$carateristicas				
					</p>
				</section>
			</li>
			
			";
			}else {
							
		echo "
					
			<li>
				<img src=.$file >
				<section class='flex-caption'>
					<p>LOREM IPSUM 1</p>
				</section>
			</li>
			
			";
				
			}
			
		}

		?>
		
		</ul>
	</div>
	
</body>
</html>