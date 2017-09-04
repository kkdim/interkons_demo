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
	<input type="text" id="nazivGalerije" name="nazivGalerije" placeholder="Gallery name" style='font-size: 1.3rem;'><br><br>
	<input type="submit" value="Add gallery" class='button'><br>
	</form>
	<?php
	$db=connection();
	if(!$db)
	{
		echo "Neuspešna konekcija na bazu!!!";
		exit();
	}
	if(isset($_POST['nazivGalerije']))
	{
		$nazivGalerije=$_POST['nazivGalerije'];
		if($nazivGalerije!="")
		{
			$sql="INSERT INTO galerije (nazivGalerije, autor) VALUES ('$nazivGalerije', '".$_SESSION['korime']."')";
			mysqli_query($db, $sql);
			if(mysqli_error($db))
				echo "Neuspeo upit!!! <br>".mysqli_error($db);
			else echo "Uspešno dodata galerija '$nazivGalerije'!!!";
		}
		else echo "Niste uneli ništa!!!";
	}

	?>
		<hr>
		<form action="#" method="post" enctype="multipart/form-data">
		<select id="idGalerije" name="idGalerije">
		<?php
		$sql="SELECT id, nazivGalerije FROM galerije ORDER BY id DESC";
		$result=mysqli_query($db, $sql);
		while($call=mysqli_fetch_object($result))
			echo "<option value='$call->id'>$call->nazivGalerije</option>";
		?>
		</select><br><br>
		<input type="file" id="slika1" name="slika1" class="file"/><input type="text" id="komentar1" name="komentar1" placeholder="Add comment" style="font-size: 1rem;"><br><br>
		<input type="file" id="slika2" name="slika2" class="file"/><input type="text" id="komentar2" name="komentar2" placeholder="Add comment" style="font-size: 1rem;"><br><br>
		<br>
		<input type="submit" value="Add picture" class='button'>
		</form>

		<?php
		if(isset($_FILES['slika1']['name']))
		{
			$idGalerije=$_POST['idGalerije'];
			$komentar1=$_POST['komentar1'];
			$slika1=$_FILES['slika1']['name'];
			//echo "ime: ".$slika1;
			$slika2=$_FILES['slika2']['name'];
			$komentar2=$_POST['komentar2'];
			if($slika1!="")
			{
				$novoime=time()."_1.".pathinfo($slika1, PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['slika1']['tmp_name'],"../galerije/".$novoime))
				{
					$sql="INSERT INTO galerijeslike (idGalerije, slika, komentar) VALUES ($idGalerije, '$novoime', '$komentar1')";
					mysqli_query($db, $sql);
					//if(mysqli_error())

				}
				else echo "Error<br>".$_FILES['slika1']['error'];
			}
			if($slika2!="")
			{
				$novoime=time()."_2.".pathinfo($slika2, PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['slika2']['tmp_name'],"../galerije/".$novoime))
				{
					$sql="INSERT INTO galerijeslike (idGalerije, slika, komentar) VALUES ($idGalerije, '$novoime', '$komentar2')";
					mysqli_query($db, $sql);
				}
			}
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
</html>
