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
	<h3 class="judulok">Form Input Stock Barang Tahun '.$tahun.' </h3>';
	
	$namabr=$_POST['namabr'];
	$sernum=$_POST['sernum'];
	$merk=$_POST['merk'];
	$type=$_POST['type'];
	$status=$_POST['status'];
	$keterangan=$_POST['keterangan'];
	$tglmasuk=$_POST['tglmasuk'];
	$lokasi=$_POST['lokasistock'];
	
	include "koneksi.php";
	$inputbr="insert into tb_stbarang (lokasistock,tgl_masuk,keterangan,nama_barang,serial_num,merk,type,status) values ('$lokasi','$tglmasuk','$keterangan','$namabr','$sernum','$merk','$type','$status')";
	$eksinputbr=mysql_query($inputbr);
	
	echo '<p>Terimakasih stock barang baru sudah berhasil di input</p>';
	
	
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>