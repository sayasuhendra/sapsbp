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
		<h3 class="judulok">Proses Approve Survey</h3>';
		date_default_timezone_set('Asia/Jakarta');
		$noim=$_POST['noim'];
		$nofpb=$_POST['nofpb'];
		$status=$_POST['status'];
		$tanggal=date('d F Y');
		$keterangan=$_POST['keterangan'];
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$pilihpers="select * from instal_im where noim='$noim'";
		$ekspers=mysql_query($pilihpers);
		$datapers=mysql_fetch_array($ekspers);
		$pers=$datapers['namapers'];
		$namasales=$datapers['nama_sales'];
		$closestat='OK';
		$ok='OK';
		$nok='NOK';
		
		if($status=='Approve' || $status=='OK'){
		$update_im="update instal_im SET tglupfpa='$waktu', status_close='$ok', status_tm='$ok', status='$status' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupfpa='$waktu', status_tm='$ok' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= "Berikut Hasil Survey untuk Pelanggan ".$pers." : ".$keterangan;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihto="select * from usr_tb where nama_lengkap='$namasales'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;
		$subject = "IM SURVEY";
		$message = "Survey Untuk  ".$pers." Telah selesai dan memungkinkan untuk dilakukan instalasi. Klik <a href='http://sap.sbp.net.id/upgradeim.php?noim=".$noim."'>disini</a> untuk create IM instalasi";
		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Noim: " .$noim. "\r\n";
		mail($to,$subject,$message,$headers);
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Telah Berhasil di Update </p>';
		}else if($status=='Eskalasi'){
		include "koneksi.php";
		include "roma.php";
			$waktuok=date('Ymd');
			$pilihfpb="select * from fpa_tb where akses_status='Survey'";
			$eksfpb=mysql_query($pilihfpb);
			$datano=mysql_fetch_row($eksfpb);
			if($datano==0){
			$nourut1=0001;
			$nourutok1=sprintf("%04s",$nourut1);
			$nofpa=$nourutok1.'/SBP-FPAS/'.$roma.'/'.$waktuok;
			}
			else if($datano >= 1){
			$pilihim="select * from fpa_tb";
			$eksim=mysql_query($pilihim);
			while($datafpb=mysql_fetch_array($eksim)){
			$noima=$datafpb['nofpa'];
			$num=substr("$noima",0,4);
			$nourut1=$num + '1';
			$nourutok1=sprintf("%04s",$nourut1);
			$nofpa=$nourutok1.'/SBP-FPAS/'.$roma.'/'.$waktuok;
			}
			}
			
			$pilihim="select * from instal_im where noim='$noim'";
			$eksnoim=mysql_query($pilihim);
			$dataim=mysql_fetch_array($eksnoim);
			$pers=$dataim['namapers'];	
			$aktipe=$dataim['media_akses'];
			$akspeed=$dataim['akses_speed'];
			$tglrfs=$dataim['tglrfs'];
			
		$tm="Teknikal Manajer";
		$pending='Pending';
		$survey='Survey';
		$update_im="update instal_im SET tglupfpa='$waktu', tujuan='$tm' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		
		$update_im2="update internal_memo SET tglupfpa='$waktu' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= $nama_lengkap.' Sudah Menyerahkan Pekerjaan Survey pelanggan : '.$pers.' Kepada Teknikal Manajer';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$proses="insert into fpa_tb (noim,status_tm,akses_status,status,orderby,nofpa,akses_speed,akses_type,target,namapers,tujuan) values ('$noim','$nok','$survey','$pending','$nama_lengkap','$nofpa','$akspeed','$aktipe','$tglrfs','$pers','$tm')";
		$eksproses=mysql_query($proses);
		
	
		
		$pilihtm="select * from usr_tb where level='Manajer' and bagian='Teknikal'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$to=$emailtm;
		$subject = "IM Instalasi";
		$message = "Ada Request Untuk Melakukan Survey dari Team DCO, selengkapnya silahkan login ke SAP SBP";
		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";

		mail($to,$subject,$message,$headers);
		echo 'Terimakasih, Project survey sudah di teruskan ke Tteknikal Manajer';
		}
		
		}elseif($status=='Reject'){
		
		$update_im="update instal_im SET tglupfpa='$waktu', status_close='$ok', status='$status', status_im='$nok' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupfpa='$waktu', status_close='$ok', status_im='$nok' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= "Berikut Hasil Survey Untuk ".$pers." : Bahwa Intalasi Tidak dapat dilaksanakan karena alasan ".$keterangan;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihto="select * from usr_tb where nama_lengkap='$namasales'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;
		$subject = "IM SURVEY";
		$message = "Survey Untuk  ".$pers." Telah selesai dan Tidak Memungkinan Untuk Dilakukan Proses Instalasi karena alasan : ".$keterangan;
        $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";

		mail($to,$subject,$message,$headers);
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Telah Berhasil di Update </p>';
		} else if($status=='NOK'){
		$update_im="update instal_im SET tglupfpa='$waktu', status_tm='$status', status='$status' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupfpa='$waktu', status_im='$status', status_tm='$status' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= "Berikut Hasil Survey untuk Pelanggan ".$pers." : ".$keterangan;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihto="select * from usr_tb where nama_lengkap='$namasales'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;
		$subject = "IM SURVEY";
		$message = "Survey Untuk  ".$pers." Telah selesai dan memungkinkan untuk dilakukan instalasi. Klik <a href='http://sap.sbp.net.id/upgradeim.php?noim=".$noim."'>disini</a> untuk create IM instalasi";
		$headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";

		mail($to,$subject,$message,$headers);
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Telah Berhasil di Update </p>';
		}
		
		echo '
		
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
