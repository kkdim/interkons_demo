<?php
class comments
{
	public $db;

	public function __construct($db)
	{
		$this->db=$db;
	}

	public function upisUBazu($idVesti,$autor, $tekst)
	{
		$sql="INSERT INTO komentari (idVesti, autor, tekst) VALUES ($idVesti, '$autor', '$tekst')";
		//echo $sql;
		mysqli_query($this->db, $sql);
	}

	static function prikaziSveKomentare($db,$idVesti)
	{
		$sql="SELECT * FROM komentari WHERE idVesti=$idVesti ORDER BY id DESC";
		$result=mysqli_query($db, $sql);
		if(mysqli_num_rows($result)==0)
		{
			echo "No comments";
		}
		else
		{
			while($call=mysqli_fetch_object($result))
			{
				echo "<b>$call->autor</b> <br>";
				echo "$call->tekst<br>";
				echo "<i>$call->datum</i><br><br>";
			}
		}

	}
}
?>
