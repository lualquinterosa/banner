<?php
include "../conn.php";
include("../head.php");
if(isset($_POST['update'])){
				$usersid			= intval($_POST['usersid']);
				
			    $usersnombre	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersnombre'], ENT_QUOTES)));
				$usersmail	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersmail'], ENT_QUOTES)));
				$userspassword	= mysqli_real_escape_string($conn,(strip_tags($_POST['userspassword'], ENT_QUOTES)));
				$usersestado	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersestado'], ENT_QUOTES)));
				$usersrol	= mysqli_real_escape_string($conn,(strip_tags($_POST['usersrol'], ENT_QUOTES)));

				
			
			if ($userspassword!=""){
				$userspassword=md5($userspassword);
				$update = mysqli_query($conn, "UPDATE `users` SET `usersnombre`='$usersnombre',`usersmail`='$usersmail',
				`userspassword`='$userspassword',`usersestado`='$usersestado',`usersrol`='$usersrol'
				WHERE usersid='$usersid'
				") or die(mysqli_error($conn)."UPDATE `users` SET `usersnombre`='$usersnombre',`usersmail`='$usersmail',
				`userspassword`='$userspassword',`usersestado`='$usersestado',`usersrol`='$usersrol'
				WHERE usersid='$usersid'");
			}else{
				$update = mysqli_query($conn, "UPDATE `users` SET `usersnombre`='$usersnombre',`usersmail`='$usersmail',
				`usersestado`='$usersestado',`usersrol`='$usersrol'
				WHERE usersid='$usersid'
				") or die(mysqli_error($conn)."UPDATE `users` SET `usersnombre`='$usersnombre',`usersmail`='$usersmail',
				`usersestado`='$usersestado',`usersrol`='$usersrol'
				WHERE usersid='$usersid'");
				
			}
			
				
				if($update){
					echo "<script>alert('¡Bien hecho!','Los datos han sido actualizados!','index.php');</script>";
			}else{
					echo "<script>alert('Error','No se pudo actualizar los datos','index.php');</script>";
				}
			}
  ?>