<?php
ob_start('ob_gzhandler');
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$bagian=$_SESSION['bagian'];
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
	<?php
	
	echo '
		<h3 class="judulok">Followup Form Penggunaan Akses Pihak Ketiga</h3>';
			date_default_timezone_set('Asia/Jakarta');
			$idfpa=$_POST['idfpa'];
			$bagian=$_POST['bagian'];
			$noim=$_POST['noim'];
			$nofpa=$_POST['nofpa'];
			$aksus=$_POST['aksus'];
			$akstat=$_POST['akstat'];
			$speed=$_POST['speed'];
			$asal=$_POST['asal'];
			$tujuan=$_POST['tujuan'];
			$type=$_POST['type'];
			$provider=$_POST['provider'];
			$namapers=$_POST['namapers'];
			$penjelasan=$_POST['penjelasan'];
			$target=$_POST['target'];
			$tglim=$_POST['tglim'];
			$namauser=$_POST['namauser'];
			$status=$_POST['status'];
			$status_tm=$_POST['statustm'];
			$perangkat=$_POST['perangkat'];
			$orderby=$_POST['orderby'];
			$tanggal=date('d F Y');
			$jam=date('H:i:s');
			if($status=='Approve'){
			$statfin='OK';}else{
			$statfin='NOK';
			}
			
			$waktu=$tanggal.', Jam '.$jam;
					
			if($bagian=='Teknikal'){
			if($provider=='SBP'){
				$ubahstat="update instal_im SET tgluppo='$waktu', tglupfpa='$waktu', barang='$perangkat', status_fin='OK', status_tm='NOK' where noim='$noim'";
				$eksubahstat=mysql_query($ubahstat);
				
				$ubah="update fpa_tb SET status='Approve', orderby='$orderby', tglapp='$waktu', appby='$namauser', perangkat='$perangkat', status_tm='NOK' where idfpa='$idfpa'";
				$eksubah=mysql_query($ubah);
				
				$isireport='Internal Memo Terminasi untuk perusahaan '.$namapers.' sudah di approve oleh Teknikal Manajer';
				$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpa','$namauser','$waktu','$isireport')";
				$aksi=mysql_query($inputreport);
				
				$ubahstat2="update internal_memo SET tgluppo='$waktu', tglupfpa='$waktu', status_tm='NOK', status_fin='OK' where noim='$noim'";
				$eksubahstat2=mysql_query($ubahstat2);
				$piliheng="select * from usr_tb where bagian='Teknikal' AND level='Engineer'";
				$ekseng=mysql_query($piliheng);
				while($tm=mysql_fetch_array($ekseng)){
				$emaileng=$tm['email'];
				$to=$emaileng;
				$subject = "Internal Memo";
				$message = "Ada SPK Terminasi baru yang dikirim oleh teknikal manajer untuk perusahaan ".$namapers.". untuk lebih detailnya silahkan login di SAP";
				$from = "WEBSAP-SBP";
				$headers  = "From:WEBSAP-SBP";
				mail($to,$subject,$message,$headers);
				}
			
				header('Location:assi.php');			
				}else{
				$ubahstat="update instal_im SET  tglupfpa='$waktu', barang='$perangkat', status_tm='OK' where noim='$noim'";
				$eksubahstat=mysql_query($ubahstat);
				
				$ubah="update fpa_tb SET status='Pending', orderby='$orderby', tglapp='$waktu', appby='$namauser', perangkat='$perangkat', status_tm='OK' where idfpa='$idfpa'";
				$eksubah=mysql_query($ubah);
				
				$isireport='FPA Terminasi untuk perusahaan '.$namapers.' sudah di approve oleh Teknikal Manajer dan di teruskan ke Finance untuk dibuatkan surat terminasi ke pihak ke 3';
				$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpa','$namauser','$waktu','$isireport')";
				$aksi=mysql_query($inputreport);
				
				$ubahstat2="update internal_memo SET tgluppo='$waktu', status_tm='OK' where noim='$noim'";
				$eksubahstat2=mysql_query($ubahstat2);
				$piliheng="select * from usr_tb where bagian='Finance'";
				$ekseng=mysql_query($piliheng);
				while($tm=mysql_fetch_array($ekseng)){
				$emaileng=$tm['email'];
				$to=$emaileng;
				$subject = "Internal Memo";
				$message = "Ada FPA Terminasi baru yang dikirim oleh teknikal manajer untuk perusahaan ".$namapers.". untuk lebih detailnya silahkan login di SAP";
				$from = "WEBSAP-SBP";
				$headers  = "From:WEBSAP-SBP";
				mail($to,$subject,$message,$headers);
				}
			
				header('Location:assi.php');		
				}
			}
			else{
				$lokasi_file=$_FILES['fupload']['tmp_name'];
				$tipe_file=$_FILES['fupload']['type'];
				$nama_file=$_FILES['fupload']['name'];
				$move = move_uploaded_file($lokasi_file,'po/'.$nama_file);  
				if($move){
				$ubahstat3="update instal_im SET tgluppo='$waktu', status_tm='NOK', status_term='OK', tujuan='Engineer' where noim='$noim'";
				$eksubahstat3=mysql_query($ubahstat3);
				
				$ubahstat4="update fpa_tb SET status_tm='NOK', status='$status' where noim='$noim'";
				$eksubahstat4=mysql_query($ubahstat4);
				
				$ubahstat2="update internal_memo SET tgluppo='$waktu', status_term='OK', status_tm='NOK' where noim='$noim'";
				$eksubahstat2=mysql_query($ubahstat2);
				
				$isireport='Surat Terminasi untuk perusahaan '.$namapers.' yang menggunakan akses pihak ketiga telah selesai di urus oleh '.$namauser.' (Finance)';
				$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpa','$namauser','$waktu','$isireport')";
				$aksi=mysql_query($inputreport);
				
				$pilihtm="select * from usr_tb where bagian='Teknikal' and level='Manajer'";
				$ekstm=mysql_query($pilihtm);
				while($tm=mysql_fetch_array($ekstm)){
				$emailtm=$tm['email'];
				$to=$emailtm;
				$subject = "Status PO ".$namapers." ";
				$message = "Surat Terminasi untuk perusahaan ".$namapers.". telah di urus oleh finance. silahkan login ke SAP untuk menunjuk enginer area dari project ini";
				$from = "WEBSAP-SBP";
				$headers  = "From:WEBSAP-SBP";
				mail($to,$subject,$message,$headers);
				}
			
				header('Location:assi.php');
				}else{
				echo "Gagal mengupload file PO";
				}
			}		
			
	echo '
	</div>';
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>