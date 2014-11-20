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
		<h3 class="judulok">Proses Internal Memo</h3>
		<?php
		include "koneksi.php";
		date_default_timezone_set('Asia/Jakarta');
		$id=$_POST['idimin'];
		$nofpb=$_POST['nofpb'];
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$jasa=$_POST['jasa'];
		$tglrfs=$_POST['rfs'];
		$keterangan=$_POST['keterangan'];
		$tujuan=$_POST['tujuan'];
		$speed=$_POST['speed'];
		$sales=$_POST['namasales'];
		$noim=$_POST['noim'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam : '.$jam;
		$jenpek=$_POST['jenpek'];
		$statim=$_POST['status_im'];
		
		$pilihto="select * from usr_tb where nama_lengkap='$tujuan'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;
		$subject = "IM Instalasi";
		$message = "Ada internal memo baru dari Teknikal Manajer, silahkan login ke sapsbp untuk lebih detailnya";
		$from = "SAPSBP";
		$headers  = "From:SAPSBP";
		$headers .= " : Notikasi";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$message,$headers);
		
		$statfin='OK';
		$stattm='OK';
		$status=$_POST['status'];
		$statclose=$_POST['status_close'];
		$isireport='Internal Memo untuk perusahaan '.$namapers.' telah di Aprrove oleh Teknikal Manajer : <b>'.$namauser.'</b>. dan '.$tujuan.' di tunjuk sebagai PM dari project ini';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$namauser','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$updateim="update instal_im SET status_tm='$stattm',status_close='$statclose', tujuan='$tujuan', status='$status' where id_imin='$id'";
		$eksupdateim=mysql_query($updateim);
		
		$updatememo="update internal_memo SET status_tm='$stattm',status_fin='$statfin',status_close='$statclose' where noim='$noim'";
		$eksmemo=mysql_query($updatememo);
		header ('Location:assi.php');
		
		
				
			
		
		
		
		
			
		?>
		
		
				
			
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>