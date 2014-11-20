<?php
ob_start('ob_gzhandler');
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
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
		<h3 class="judulok">Update Internal Memo Isolir / Terminasi</h3>
		<?php
		include "koneksi.php";
		date_default_timezone_set('Asia/Jakarta');
		$status=$_POST['status'];
		$noim=$_POST['noim'];
		$pilihfpb="select * from instal_im where noim='$noim'";
		$eksfpb=mysql_query($pilihfpb);
		$datafpb=mysql_fetch_array($eksfpb);
		$nofpb=$datafpb['nofpb'];
		$pelanggan=$datafpb['namapers'];
		$jenpek=$_POST['jenpek'];
		$ok='OK';
		$finish='Finish';
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$bulan = $array_bulan[date('n')];
		$tanggal1=date('d');
		$tahun=date('Y');
		$tanggal=$tanggal1.' '.$bulan.' '.$tahun;
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$appby=$_POST['appby'];
		$status=$_POST['status'];
		$namapers=$_POST['namapers'];
		If($status=='Approve' && $jenpek=='Terminasi'){
			header ("location:upload-fpc.php?noim=$noim");
		}elseif($status=='Reject' && $jenpek=='Terminasi'){
		
		$updateim="update instal_im SET status_tm='$ok', status_fin='$ok', status_close='$ok', status_inven='$ok', status_spk='$ok', status='$finish', tujuan='$finish' where noim='$noim'";
		$eksupim=mysql_query($updateim);
		
		$updateinme="update internal_memo SET status_tm='$ok', status_fin='$ok', status_close='$ok', status_inven='$ok', status_spk='$ok', status_term='$ok' where noim='$noim'";
		$eksupinme=mysql_query($updateinme);
		
		$isi='Project Terminasi Untuk Pelanggan <b>'.$pelanggan.'</b> Telah di Reject Oleh '.$namauser;
		$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$namauser','$waktu','$isi','$noim')";
		$queryreport=mysql_query($inputreport);
		}
		
		
			
		?>
		
		
				
			
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>