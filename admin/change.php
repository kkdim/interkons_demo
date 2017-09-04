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
	<!--Deo za izbor vesti za izmenu-->
	<form method="post" action="#">
	<select name="idVesti" id="idVesti">
	<?php
	$db=connection();
	$sql="SELECT id, naslov FROM vesti WHERE obrisan=0 and napisao= '".$_SESSION['korime']."' ORDER BY id DESC";
	$result=mysqli_query($db, $sql);
	while($call=mysqli_fetch_object($result))
		echo "<option value='".$call->id."'>".$call->naslov."</option>";
	mysqli_close($db);
	?>
	</select><br><br>
	<input type="submit" value="Next" class="button"/><hr><br>
	</form>
	<!--Deo za izmenu vesti-->
	<?php
	$id="";
	$naslov="";
	$sadrzaj="";
	$kategorija="";
	$slika="";
	if(isset($_POST['idVesti']))
	{
		$id=$_POST['idVesti'];
		//echo $id;
		$db=connection();
		$sql="SELECT * FROM vesti where id=$id";
		$result=mysqli_query($db, $sql);
		$call=mysqli_fetch_object($result);
		$id=$call->id;
		$naslov=$call->naslov;
		$sadrzaj=$call->sadrzaj;
		$kategorija=$call->kategorija;
		$slika=$call->slika;
	}
	?>
	<form action="#" method="post" enctype="multipart/form-data">
	<input type="text" id="idVest" name="idVest" value="<?=$id?>" style="font-size: 1.3rem;"/><br><br>
	<input type="text" id="naslov" name="naslov" value="<?=$naslov?>" style="font-size: 1.3rem;"/><br><br>
	<textarea id="sadrzaj" name="sadrzaj" rows="5" cols="50" style="font-size: 1.3rem;"><?=$sadrzaj?></textarea><br><br>
	<select id="kategorija" name="kategorija">
		<option value="<?=$kategorija?>" selected><?=$kategorija?></option>
		<option value="Apartments" selected>Apartments</option>
		<option value="Residences">Residences</option>
		<option value="Swimming pools and spa">Swimming pools and spa</option>
		<option value="Office fit out">Office fit out</option>

	</select><br><br>
	<img src="../images/<?=$slika?>" style="width:250px; height:200px; margin:10px 0;" alt=""><br>
	<input type="file" id="slika" name="slika" class="file"><br><br>
	<input type="submit" value="Change" class="button">
	</form>
	<?php
	//echo "Ovde ide dinamika";
	$db=connection();
	if(!$db)
	{
		echo "Baza nije dostupna. Pokusajte kasnije!!!";
		exit();
	}
	if(isset($_POST['naslov']) and isset($_POST['sadrzaj']) AND isset($_POST['idVest']))
	{
		$id=$_POST['idVest'];
		$naslov=$_POST['naslov'];
		$sadrzaj=$_POST['sadrzaj'];
		$kategorija=$_POST['kategorija'];
		if(isset($_FILES['slika']['name']))
		{
			$slika=time().".".pathinfo($slika, PATHINFO_EXTENSION);
			$sql="UPDATE vesti SET slika='$slika' WHERE id=$id";
			mysqli_query($db, $sql);

			move_uploaded_file($_FILES['slika']['tmp_name'], "../images/".$slika);
		}
		$sql="UPDATE vesti SET naslov='$naslov', sadrzaj='$sadrzaj', kategorija='$kategorija' WHERE id=$id";
		echo $sql;
		mysqli_query($db, $sql);
	}
	?>
	</div>
<!--FOOTER-->
	<?php include("x_footer.html")?>
</div>
</body>
</html>
