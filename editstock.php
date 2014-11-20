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
	$id=$_GET['id_barang'];
	$pilihbr="select * from tb_stbarang where id_barang='$id'";
	$eksbr=mysql_query($pilihbr);
	$brst=mysql_fetch_array($eksbr);
	
	?>
	<div id="isi">
	
	<?php
	
	$tahun=date('Y');
	
	echo '
	<h3 class="judulok">Form Input Stock Barang Tahun '.$tahun.' </h3>
	';
	echo '
	
		<form method="post" name="form" action="updatestock.php" onsubmit="return validasi()" enctype="multipart/form-data">
			<table class="tbrule" cellspacing="10px">
			 <tr>
				<td>Nama Barang</td>
				<td>:</td>
				<td><input type="text" name="namabr" required placeholder="required" value="'.$brst['nama_barang'].'"></td>
			 </tr>
			 <tr>
				<td>Serial Number</td>
				<td>:</td>
				<td><input type="text" name="sernum" required placeholder="required" value="'.$brst['serial_num'].'"></td>
			 </tr>
			 <tr>
				<td>Merk</td>
				<td>:</td>
				<td><input type="text" name="merk" required placeholder="required" value="'.$brst['merk'].'"></td>
			 </tr>
			 
			 <tr>
				<td>Type Barang</td>
				<td>:</td>
				<td><input type="text" name="type" required placeholder="required" value="'.$brst['type'].'"></td>
			 </tr>
			 <tr>				
				<td>Tgl. Masuk Barang</td>
				<td>:</td>
				<td><input type="text" name="tglmasuk" class="selectform" id="datepicker" required placeholder="required" value="'.$brst['tgl_masuk'].'">
				</td>
			</tr>
			
			 <tr>
				<td>Status</td>
				<td>:</td>
				<td><select name="status">
					<option value="'.$brst['status'].'">'.$brst['status'].'
					<option value="Baru">Baru
					<option value="Bekas">Bekas
					<option value="Rusak">Rusak
				</select></td>
			 </tr>
			 <tr>
				<td>Lokasi Penyimpanan Barang</td>
				<td>:</td>
				<td><select name="lokasistock">
					<option value="'.$brst['lokasistock'].'">'.$brst['lokasistock'].'
					<option value="Jakarta">Jakarta
					<option value="Batamn">Batam
				</select></td>
			 </tr>
			 <tr>
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="38" rows="6">'.$brst['keterangan'].'</textarea></td>
			 </tr>
			 <tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png" style="margin-top:2px; float:left"><input style="margin-top:3px; margin-left:5px; float:left" type="reset" value="Cancel">
				<input type="hidden" name="idbr" class="selectform" value="'.$brst['id_barang'].'">
				</td>
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