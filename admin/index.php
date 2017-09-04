<?php
require_once("../functions.php");
require_once("class_Log.php");
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
        <div id="social">
            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
        </div>
    </div>
<!--MAIN-->
    <div id="main" style="text-align: center; margin:70px auto; float: none;">
      <h1 style="margin-bottom: 40px; font-size: 40px;">Welcome admin</h1>
    <form action="#" method="post">
    <input type="text" id="korime" name="korime" placeholder="Name" style="font-size: 1.3rem; margin-bottom: 10px;"/><br>
    <input type="text" id="lozinka" name="lozinka" placeholder="Password" style="font-size: 1.3rem; margin-bottom: 10px;"/><br>
    <input type="submit" value="Login" style="font-size: 1.3rem; margin-bottom: 10px;"/>
    </form>
    <?php
    //echo "Ovde ide dinamika";
    $db=connection();
    if(!$db)
    {
        echo "Baza nije dostupna. Pokusajte kasnije!!!";
        exit();
    }
    if(isset($_POST['korime']) and isset($_POST['lozinka']))
    {
        $korime=$_POST['korime'];
        $lozinka=$_POST['lozinka'];
        if($korime!="" and $lozinka!="")
        {
            $sql="SELECT * FROM korisnici WHERE korime='$korime' AND lozinka='$lozinka'";
            $result=mysqli_query($db, $sql);
            if(mysqli_num_rows($result)==1)
            {
                $call=mysqli_fetch_object($result);

					session_start();
					$_SESSION['ime']=$call->ime;
					$_SESSION['status']=$call->status;
					$_SESSION['korime']=$call->korime;
					$obj=new Log("Korisnik ".$call->korime." se uspesno prijavio\r\n");
					$obj->upisLogovanje();
					header("Location: home.php");
				//}
				//else echo "Nije dobra lozinka<br>";

            }
            else
            {
                echo "Nije dobro korisničko ime i lozinka";
                $obj=new Log("Neuspeo pokusaj prijavljivanja. Nije dobro korime i lozinka\r\n");
                $obj->upisLogovanje();
            }
        }else echo "Niste uneli potrebne podatke";
    }
    ?>
    </div>
<!--FOOTER-->
    <?php include("x_footer.html")?>
</div><

</body>
</html>
