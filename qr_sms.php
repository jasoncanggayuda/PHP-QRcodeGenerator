<?php
//library phpqrcode
include "phpqrcode/qrlib.php";
include "header.php";
 
//direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
$tempdir = "temp/"; 
if (!file_exists($tempdir))
    mkdir($tempdir);
 
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>QRCode Generator</title>
</head>
<body>
  <?php
    //Isi dari QRCode Saat discan
    $no_hp = "081906222298";
    $message = "ini adalah isi SMSnya";
    
    $isi_teks = "smsto:".$no_hp.":".$message;
    //Nama file yang akan disimpan pada folder temp 
    $namafile = "qr_sms.png";
    //Kualitas dari QRCode 
    $quality = 'H'; 
    //Ukuran besar QRCode
    $ukuran = 8; 
    $padding = 0; 
    QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
  ?>
  <div align="center" style="margin-top: 50px;">
    <h2>QRCode Generator SMS App </h2>
    <img src="temp/<?php echo $namafile; ?>" style="margin: 50px;">
  </div>
</body>
</html>