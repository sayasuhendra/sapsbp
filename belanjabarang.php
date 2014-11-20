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
  <script>
	Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"yyyy-mm-dd"
		};
		
		$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
			}
		
		);
				
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
	<h3 class="judulok">Form Input Belanja Barang Tahun '.$tahun.' </h3>
	';
	echo '
	
		<form method="post" name="form" action="prosesbljbr.php" onsubmit="return validasi()" enctype="multipart/form-data">
			<table class="tbrule" cellspacing="10px">
			 <tr>
				<td>Nama Barang</td>
				<td>:</td>
				<td><input type="text" name="namabr" required placeholder="required"></td>
			 </tr>
			 <tr>
				<td>Merk</td>
				<td>:</td>
				<td><input type="text" name="merk" required placeholder="required"></td>
			 </tr>
			 <tr>
				<td>Jumlah</td>
				<td>:</td>
				<td><input type="text" name="jumlah" required placeholder="required"></td>
			 </tr>
			 <tr>
				<td>Type Barang</td>
				<td>:</td>
				<td><input type="text" name="type" required placeholder="required"></td>
			 </tr>
			 <tr>				
				<td>Tgl. Pembelian</td>
				<td>:</td>
				<td><input type="text" name="tglmasuk" class="selectform" id="datepicker" required placeholder="required">
				</td>
			</tr>
			<tr>
				<td>Harga Barang</td>
				<td>:</td>
				<td><input type="text" name="harga" required placeholder="ex : 1000000"><span style="color:red; font-size:10px"> * Jangan Menggunakan titik</span></td>
			 </tr>
			 <tr>
				<td>Status</td>
				<td>:</td>
				<td><select name="status">
					<option value="">--Pilih status --
					<option value="Baru">Baru
					<option value="Bekas">Bekas
				</select></td>
			 </tr>
			 <tr>
				<td valign="top">Kebutuhan</td>
				<td valign="top">:</td>
				<td><input type="text" name="kebutuhan" required></td>
			 </tr>
			 <tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png" style="margin-top:2px; float:left"><input style="margin-top:3px; margin-left:5px; float:left" type="reset" value="Cancel"></td>
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