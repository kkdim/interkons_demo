<?php
require_once("../functions.php");
require_once("class_Log.php");
session_start();
if(isset($_GET['logout']))
{
	unset ($_SESSION['korime']);
	unset ($_SESSION['ime']);
	unset ($_SESSION['status']);
	session_destroy();
}
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
		<form action="#" method="post" enctype="multipart/form-data">
		<input type="text" id="naslov" name="naslov" placeholder="Heading" style="font-size: 1.3rem;"/><br><br>
		<textarea id="sadrzaj" name="sadrzaj" rows="5" cols="50" placeholder="Content" style="font-size: 1.3rem;"></textarea><br><br>
		<select id="kategorija" name="kategorija">
			<option value="Apartments" selected>Apartments</option>
			<option value="Residences">Residences</option>
			<option value="Swimming pools and spa">Swimming pools and spa</option>
			<option value="Office fit out">Office fit out</option>
		</select><br><br>
		<input type="file" id="slika" name="slika" class='file'><br><br>
		<input type="submit" value="Snimite vest" class='button'>
		</form>
		<?php
		//echo "Ovde ide dinamika";
		$db=connection();
		if(!$db)
		{
			echo "Baza nije dostupna. Pokusajte kasnije!!!";
			exit();
		}
		//echo "<h3>Dobrodosao, ". $_SESSION['ime']."</h3>";
		if(isset($_POST['naslov']) and isset($_POST['sadrzaj']))
		{
			$naslov=trim($_POST['naslov']);
			$sadrzaj=trim($_POST['sadrzaj']);
			$kategorija=$_POST['kategorija'];
			$slika=$_FILES['slika']['name'];
			if($slika!="")
			{
				$slika=time().".".pathinfo($slika, PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['slika']['tmp_name'], "../images/".$slika);
			}
			if($naslov!="" AND $sadrzaj!="")
			{
				$sql="INSERT INTO vesti (naslov, sadrzaj, kategorija, slika, napisao) VALUES ('$naslov', '$sadrzaj', '$kategorija', '$slika', '".$_SESSION['korime']."')";
				mysqli_query($db, $sql);
				if(mysqli_error($db)) echo mysqli_error($db);
				header("Location:home.php");
			}
			$obj=new Log("Uspesno dodata vest $naslov od korisnika ".$_SESSION['korime']);
			$obj->upisVesti();
		}
		?>
	</div>
<!--FOOTER-->
	<?php include("x_footer.html")?>
</div>
</body>
</html>
