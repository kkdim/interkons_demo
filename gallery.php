<?php
require_once('functions.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Interkons</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
	@font-face {
		font-family: clock;
		src: url(digital-7.ttf);
	}
	#time{
		text-align: center;
		color: black;
		width: 100%;
		max-width: 500px;
		margin: 15px auto;
		font-family: clock;
		font-size: 60px;
	}
</style>
</head>
<body>
<div id="wrapper">
<!--HEADER-->
		<?php include("x_header.html")?>
<!--NAV-->
	<div id="nav">
	<ul>
		<li><a href="index.php">Home</a></li>
		<?php
			$db=connection();
			show_menu($db);
			mysqli_close($db);
		?>
		<li><a href="index.php">Gallery</a>
			<ul>
			<?php
				$db=connection();
				$sql="SELECT * FROM galerije ORDER BY id DESC";
				$result=mysqli_query($db, $sql);
				while($call=mysqli_fetch_object($result))
					echo "<li><a href='gallery.php?idGalerije=$call->id'>$call->nazivGalerije</a></li>";
			?>
			</ul>
		</li>
	</ul>
		<div id="social">
			<a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
		</div>
	</div>
<!--MAIN-->
	<div id="main" style='text-align: center'>
	<?php
	$db=connection();
	if(!$db)
	{
		echo "Greska prilikom konkcije na bazu!!!";
		exit();
	}
	if(isset($_GET['idSlike']))
	{
		$idSlike=$_GET['idSlike'];
		$idSlike=intval($idSlike);
		//echo $idSlike;
		if($idSlike>0)
		{
			$sql="SELECT * FROM galerijeslike WHERE id=$idSlike";
			$result=mysqli_query($db, $sql);
			$call=mysqli_fetch_object($result);
			echo "<img src='galerije/$call->slika' width='650' height='550' style='margin:10px; border: 2px solid black; '/><br>$call->komentar<hr>";
		}
		else echo "Nešto nije u redu sa slikom!!!<br><br>";
	}
	if(isset($_GET['idGalerije']))
	{
		$idGalerije=$_GET['idGalerije'];
		$sql="SELECT * FROM galerijeslike WHERE idGalerije=$idGalerije";
		$result=mysqli_query($db, $sql);
		if(mysqli_num_rows($result)>0)
			while($call=mysqli_fetch_object($result))
				echo "<a href='gallery.php?idGalerije=$idGalerije&idSlike=$call->id'><img src='galerije/$call->slika' height='200px' height='100px' alt='slika' style='margin:10px; border: 2px solid black'/></a>";
		else echo "Album is empty";
	}
	?>
	</div>
<!--SIDEBAR-->
	<div id="sidebar">
		<div class="block">
			<h2>About our company</h2>
			<p><span style="color: rgba(244, 227, 31, 1);">ООО "INTERKONS"</span> is design and build company established in Moscow, Russia at 2013. Our company employs Architects and Civil Engineers with broad experience in construction and fit out projects since mid 90's. <br> <span style="color: rgba(244, 227, 31, 1);">ООО "INTERKONS"</span> provide architectural design from concept design to interior design, as well as project management. Also we can provide with necessary engineering: structural ,mechanical and electrical drawings and specifications.</p>
		</div>
		<div class="block">
			<h2>Services</h2>
			<p>Our company provides following services: <br>- Design and project menagment <br>- Interior fit out <br>- Construction works <br>- Specialist works </p>
		</div>
		<div class="block">
			<h2>Projects</h2>
			<p>During our long and productive history of design and construction, we had various project challenges. We managed to accomplish all of them. Some of the most popular are: <br>- Apartments <br>- Residences <br>- Swimming pools and spa <br>- Office fit out </p>
		</div>
		<div class="b-contact">
			<h2 style="padding: 14px;">Contact</h2>
			<div class="b-map"><div id="map" style="width:480px;height:300px; border-radius:15px;"></div></div>
			<p>Moscow, 119571</p>
			<p>26 Bakinskikh Komissarov 9</p>
			<p>Tel.: +7(916) 687-67-32</p>
			<p>interkons@inbox.ru</p>
		</div>
	</div>
<!--FOOTER-->
	<?php include("x_footer.html")?>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaXPBRyrCw_xAVdiTD3E9kmpt8BkJwkZ0&callback=myMap"></script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>
$(document).ready(function(){
	setInterval(function(){
		$('#time').load('time.php')
	},1000);
});
</script>
</body>
</html>
