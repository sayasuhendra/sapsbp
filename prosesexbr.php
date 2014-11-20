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
	<h3 class="judulok">Form Input Stock Barang Tahun '.$tahun.' </h3>
	';
	
	$sernum=$_POST['sernum'];
	foreach($sernum as $kunci => $iket){
	
	$sernum=$_POST['sernum'][$kunci];
	$jasapengirim=$_POST['jasapengirim'][$kunci];
	$tujuan=$_POST['tujuan'][$kunci];
	$keterangan=$_POST['keterangan'][$kunci];
	$tglkeluar=$_POST['tglkeluar'][$kunci];
	$pjnoc=$_POST['pjnoc'][$kunci];
	$pilihser="select * from tb_stbarang where serial_num='$sernum'";
	$ekser=mysql_query($pilihser);
	$dataser=mysql_fetch_array($ekser);
	$namabr=$dataser['nama_barang'];
	$merk=$dataser['merk'];
	$type=$dataser['type'];
			
	include "koneksi.php";
	
	$inputbr="insert into tb_brkeluar (nama_barang,serial_num,tgl_kirim,jasa_pengirim,tujuan_pemakaian,pj_noc,keterangan_keluar,merk,type) values ('$namabr','$sernum','$tglkeluar','$jasapengirim','$tujuan','$pjnoc','$keterangan','$merk','$type')";
	$eksinputbr=mysql_query($inputbr);
		
	$editjumlah="delete from tb_stbarang where serial_num='$sernum'";
	$ekseditjum=mysql_query($editjumlah);
	
	}
	echo '<p>Terimakasih Barang Keluar sudah berhasil di input ke database klik <a href="data-brkeluar.php">disini</a> untuk kembali</p>';
	
	
	
	
	
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>