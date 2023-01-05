<?php
include 'header.php';
// define variables and set to empty values
$nameErr = "";
$name = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container-fluid">
       <div class="animated fadeIn">
            <div class="row">
<div class="col-sm-6">

<h2>QR Code Generator</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  URL/Words: <input type="text" name="name" value="<?php echo $name;?>">
  <?php echo $nameErr;?></span>
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

  <?php
  if (!empty($_POST["name"]))
  {
      //isi QRCode saat discan
      $isi_teks = $_POST["name"];
      //direktori dan nama logo
      $logopath = 'logo.png';
      //namafile setelah jadi qrcode
      $namafile = "perangkatcerdas.png";
      //kualitas dan ukuran qrcode
      $quality = 'H'; 
      $ukuran = 8; 
      $padding = 0;
  
      QRCode::png($isi_teks,$tempdir.$namafile,QR_ECLEVEL_H,$ukuran,$padding);
      $filepath = $tempdir.$namafile;
      $QR = imagecreatefrompng($filepath);
   
      $logo = imagecreatefromstring(file_get_contents($logopath));
      $QR_width = imagesx($QR);
      $QR_height = imagesy($QR);
   
      $logo_width = imagesx($logo);
      $logo_height = imagesy($logo);
   
      //besar logo
      $logo_qr_width = $QR_width/2.5;
      $scale = $logo_width/$logo_qr_width;
      $logo_qr_height = $logo_height/$scale;
   
      //posisi logo
      imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/3.3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
   
      imagepng($QR,$filepath);
    
  }
  ?>
  <?php
  if (!empty($_POST["name"]))
  {
  echo '<p>
     <div class=" col-sm-6">
    <h5>Your Input: <strong>'.$_POST["name"].'</strong> </h5>
   </div>';
  echo '<p>
  <p>
   <div class=" col-sm-6">
    <img src="temp/perangkatcerdas.png">
   </div>';
  echo '
      <div class="col-sm-6">
      <form action="imagetopdf.php">
        <input type="submit" class="btn btn-primary" value="Send To PDF" />
    </form>
    </div>';

  }

   ?>
    
    <!-- CoreUI and necessary plugins-->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/pace-progress/pace.min.js"></script>
    <script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
