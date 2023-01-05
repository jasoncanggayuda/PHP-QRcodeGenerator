<?php
include "config.php";
include "header.php"
?>

<!DOCTYPE html>
<html>
<head>
	<title>16N10010 QR Table</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<!-- <div class="col-sm-6">
	<table class='table'>
		<thead class='thead-dark'>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>QRCode</th>
			</tr> -->
	
	<?php
	$no =1;
	include "phpqrcode/qrlib.php";
	$tempdir = "temp/"; 
	if (!file_exists($tempdir))
    mkdir($tempdir);
 

	$sql = "SELECT * FROM kota";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    echo "	<div class='col-sm-6'>
			<table class='table'>
				<thead class='thead-dark'>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>QRCode</th>
					</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$nama = $row['nama'];

		$isi_nama = $nama;
		$nama_file = $nama.".png";
		$quality = 'H';
		$ukuran = 4;
		$padding = 0;
		QRCode::png($isi_nama,$tempdir.$nama_file,$quality,$ukuran,$padding);
        echo "<tr><td>".$row["id"]."</td><td>".$row["nama"]."</td><td><img src ='temp/".$nama_file."' </td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	
?>
	<form action="print.php">
    		<input type="submit" class="btn btn-primary" value="Send To PDF" />
		</form>
</body>
</html>