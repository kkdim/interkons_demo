<?php
function connection()
{
	$db=mysqli_connect("localhost","root", "", "baza_kons");
	if(!$db) return false;
	mysqli_query($db,"SET NAMES UTF8");
	return $db;
}

function show_menu($db)
{
	$sql="SELECT DISTINCT kategorija from vesti";
	$result=mysqli_query($db, $sql);
	while($call=mysqli_fetch_object($result))
		echo "<li><a href='index.php?kategorija=$call->kategorija'>$call->kategorija</a></li>";
}
?>
