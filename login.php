<!DOCTYPE HTML>
<html>
<head>
<title>Bootstrap Login</title>

<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

<link href="style/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" language="javascript" src="style/style.js"></script>
<?php include("head.php"); ?>
</head>
<body>

<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email " required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <br><br />
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name="login">Ingresar</button>
            </form>
            
        </div>
</div>

</body>
</html>
<?php
include "conn.php";
IF(ISSET($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$cek = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE usersmail='$email' AND usersestado='A' AND userspassword='" . md5($password) . "'"));
	$data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE usersmail='$email' AND userspassword='" . md5($password) . "'"));
	IF($cek > 0)
	{
		
		session_start();
		$_SESSION['usersid'] = $data['usersid'];
		$_SESSION['email'] = $data['usersmail'];
		$_SESSION['name'] = $data['usersnombre'];
		echo "<script language=\"javascript\">document.location.href='index.php';</script>";
	}else{
		echo "<script language=\"javascript\">alert('¡Error!',\"Nombre de usuario o contraseña errada\",'login.php');</script>";
	}
}
?>