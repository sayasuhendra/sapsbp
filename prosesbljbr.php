<?php

include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  
  
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
  $(document).ready(function($){
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>
<script type="text/javascript" src="jquery-ui-1.8.22.custom.min.js"></script>
<link href="css/ui-lightness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
	<script>
		$(function() {
		$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
		});
		});
	</script>
</head>

<body>
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	
	<?php
	
	$tahun=date('Y');
	
	echo '
	<h3 class="judulok">Form Input Stock Barang Tahun '.$tahun.' </h3>
	';
	
	$namabr=$_POST['namabr'];
	$merk=$_POST['merk'];
	$jumlah=$_POST['jumlah'];
	$type=$_POST['type'];
	$status=$_POST['status'];
	$harga=$_POST['harga'];
	$kebutuhan=$_POST['kebutuhan'];
	$tglmasuk=$_POST['tglmasuk'];
	
	include "koneksi.php";
	$inputbr="insert into tb_bljbarang (harga,tgl_beli,kebutuhan,nama_barang,merk,jumlah_beli,type,status) values ('$harga','$tglmasuk','$kebutuhan','$namabr','$merk','$jumlah','$type','$status')";
	$eksinputbr=mysql_query($inputbr);
	
	echo '<p>Terimakasih stock barang baru sudah berhasil di input, silahkan lengkapi serial number dibawah ini </p>
	<form method="post" name="form" action="prosesinputblj.php" onsubmit="return validasi()" enctype="multipart/form-data">
			<table class="tbrule" cellspacing="5px">
			 <tr>
				<td class="tdhead">Nama Barang</td>
				<td class="tdhead">Serial Number</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Type Barang</td>
				<td class="tdhead">Tgl. Masuk Barang</td>
				<td class="tdhead">Status</td>
				<td class="tdhead">Lokasi Penyimpanan</td>
				<td class="tdhead" valign="top">Keterangan</td>
				
			 </tr>';
	for($ulang=0; $ulang<$jumlah; $ulang++){
	echo '
		 <tr>
				<td><input class="selectform" type="text" name="namabr[]" style="width:170px" required placeholder="required" value="'.$namabr.'"></td>
				<td><input class="selectform" type="text" name="sernum[]" style="width:140px" required placeholder="required" ></td>
				<td><input class="selectform" type="text" name="merk[]" style="width:140px" required placeholder="required" value="'.$merk.'"></td>
				<td><input class="selectform" type="text" name="type[]" style="width:100px" required placeholder="required" value="'.$type.'"></td>
				<td><input type="text" name="tglmasuk[]" class="datepicker selectform" required placeholder="required">
				<td><input class="selectform" type="text" name="status[]" style="width:120px" required value="'.$status.'"></td>
				<td><select name="lokasistock[]">
					<option value="Jakarta">Jakarta
					<option value="Batam">Batam
				</select></td>
				<td><input class="selectform" style="width:250px" type="text" name="keterangan[]"></td>
			 <tr>				
				
			
	';
	}
			echo '		 
			 <tr>				
				<td colspan="7"><input type="image" src="images/cek.png" style="margin-top:2px; float:left"><input style="margin-top:3px; margin-left:5px; float:left" type="reset" value="Cancel"></td>
			</tr>
			</table>
		</form>
	';
	
	
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>