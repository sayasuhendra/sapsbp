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
	$idbr=$_POST['idbr'];
	$namabr=$_POST['namabr'];
	$sernum=$_POST['sernum'];
	$merk=$_POST['merk'];
	$type=$_POST['type'];
	$tglmasuk=$_POST['tglmasuk'];
	$status=$_POST['status'];
	$lokasi=$_POST['lokasistock'];
	$keterangan=$_POST['keterangan'];
	
	$upstock="update tb_stbarang SET nama_barang='$namabr', serial_num='$sernum', merk='$merk', type='$type', tgl_masuk='$tglmasuk', status='$status', lokasistock='$lokasi', keterangan='$keterangan' where id_barang='$idbr'";
	$eksupstock=mysql_query($upstock);
	
	
	echo '
	<p style="margin-top:-10px">Terimakasih barang sudah berhasil di edit, klik <a href="data-barang.php">disini</a> untuk kembali ke data stock barang</p>
	';
	echo '
	
	
	
	';
	
	
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>