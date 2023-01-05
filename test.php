<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>  

<?php
// define variables and set to empty values
$emailErr = $subErr = $bodErr = "";
$email = $sub = $bod = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="col-sm-6">
<h2>QR Code Generator<h1>16N10010</h1></h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Email: <input type="email" name="email" value="<?php echo $email;?>">
  <?php echo $emailErr;?></span>
  <br><br>
  Subject: <input type="text" name="sub" value="<?php echo $sub;?>">
  <?php echo $subErr;?></span>
  <br><br>
  Body: <input type="text" name="bod" value="<?php echo $bod;?>">
  <?php echo $bodErr;?></span>
  <br><br>
  <input type="submit" class="btn btn-info" value="GENERATE QR">
  <input type="submit" class="btn btn-success" value="REFRESH" onclick="window.location.reload(true)">
</form>
</div>

<?php

include "phpqrcode/qrlib.php";
require('fpdf/fpdf.php');
 
$tempdir = "temp/"; 
if (!file_exists($tempdir))
    mkdir($tempdir);
 
?>
<html>
<head>
</head>
<body>
	
  <?php
  if (!empty($_POST["email"]))
 	{
	    $email = $_POST['email'];
	    $subject = $_POST["sub"];
	    $body = $_POST["bod"];
	     
	    $isi_teks = "mailto:".$email.'?subject='.urlencode($subject).'&body='.urlencode($body);
	    //direktori dan nama logo
	    $namafile = "perangkat-cerdas.png";
	    //kualitas dan ukuran qrcode
	    $quality = 'H'; 
	    $ukuran = 8; 
	    $padding = 0;
 	
	    QRCode::png($isi_teks,$tempdir.$namafile,QR_ECLEVEL_H,$ukuran,$padding);
	    $filepath = $tempdir.$namafile;
	    $QR = imagecreatefrompng($filepath);
		
	}
  ?>
  <?php
  if (!empty($_POST["email"]))
 	{
  echo '<p>
	 <div class=" col-sm-6">
	 	<img src="temp/perangkat-cerdas.png">
	 </div>';
  echo '
  		<p>
  		<div class="col-sm-6">
  		<form action="imagetopdf.php">
  			<p>
    		<input type="submit" class="btn btn-primary" value="Send To PDF" />
		</form>
		</div>';

	}
   ?>
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>