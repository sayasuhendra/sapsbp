<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$level=$_SESSION['level'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$area=$datauser['area'];
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
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	include "menu.php";
	?>
	<div id="isi">
	<?php
				
	echo'
		<h3 class="judulok">Proses Input IP Address</h3>';
		date_default_timezone_set('Asia/Jakarta');
		$noim=$_POST['noim'];
		$nofpb=$_POST['nofpb'];
		$pelaksana=$_POST['pelaksana'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$pilihpers="select * from instal_im where noim='$noim'";
		$ekspers=mysql_query($pilihpers);
		$datapers=mysql_fetch_array($ekspers);
		$pers=$datapers['namapers'];
		$ok='OK';
		
		$update_im="update instal_im SET tglupspk='$waktu', tujuan='$pelaksana', status_spk='$ok' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupspk='$waktu', status_spk='$ok' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= $nama_lengkap.' Sudah Menunjuk '.$pelaksana.' sebagai pelaksana untuk survey pelanggan : '.$pers;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Tinggal menunggu Report Hasil Survey oleh '.$pelaksana.'</p>
		
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>