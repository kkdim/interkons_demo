<?php
require_once("../functions.php");
require_once("class_Log.php");
session_start();
if(!isset($_SESSION['ime']))
	header("Location: index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Interkons</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
<!--HEADER-->
	<div id="header">
		<div id="logo">
			<a href="../index.php">
				<img src="../images/logo.png" alt="Interkons">
			</a>
		</div>
		<div id="slogan">
			<p class="item-1">Design</p>
			<p class="item-2">&</p>
			<p class="item-3">Construction</p>
		</div>
	</div>
<!--NAV-->
	<div id="nav">
	<?php include("x_menu.html")?>
		<div id="social">
			<a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
		</div>
	</div>
<!--MAIN-->
	<div id="main">
	<form action="#" method="post">
	<input type="text" id="ime" name="ime" placeholder="Name and surname" style="font-size: 1.3rem; margin-bottom: 14px;"/><br>
	<input type="text" id="korime" name="korime" placeholder="User name" style="font-size: 1.3rem; margin-bottom: 14px;"/><br>
	<input type="text" id="lozinka" name="lozinka" placeholder="Password" style="font-size: 1.3rem; margin-bottom: 14px;"/><br>
	<select id="status" name="status">
	<option value="Administrator">Admin</option>
	</select><br><br>
	<input type="submit" value="Add new admin" class='button'>
	</form>
	<?php
	//echo "Ovde ide dinamika";
	$db=connection();
	if(!$db)
	{
		echo "Baza nije dostupna. Pokusajte kasnije!!!";
		exit();
	}
	if(isset($_POST['korime']) and isset($_POST['ime']) and isset($_POST['status']))
	{
		$korime=$_POST['korime'];
		$lozinka=$_POST['lozinka'];
		$ime=$_POST['ime'];
		$status=$_POST['status'];
		if($lozinka!="")
		{
			$sql="INSERT INTO korisnici (korime, lozinka, ime, status) VALUES ('$korime', '$lozinka', '.$ime.', '$status')";
			mysqli_query($db, $sql);
			if(mysqli_error($db))
				echo "Error<br>".mysqli_error($db);
			else echo "Welcome '$korime'!!!";
		}
		else echo "Incorrect password<br>";
	}
	?>
	</div>
<!--FOOTER-->
	<?php include("x_footer.html")?>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaXPBRyrCw_xAVdiTD3E9kmpt8BkJwkZ0&callback=myMap"></script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</body>
</html>
