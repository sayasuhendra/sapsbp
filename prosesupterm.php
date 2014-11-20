<?php
ob_start("ob_gzhandler");
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
	<?php
	echo '
	<div id="isi">
		<h3 class="judulok">Form Report / Upload BAO</h3>';
		
					include "koneksi.php";
					date_default_timezone_set('Asia/Jakarta');
					$pelanggan=$_POST['pelanggan'];
					$noim=$_POST['noim'];
					$status_close="OK";
					$status_inven="OK";
					$jam=date('H:i:s');
					$tanggal=date('d F Y');
					$waktu=$tanggal.', Jam : '.$jam;
					$finish="finish";
	                $lokasi_file=$_FILES['fupload']['tmp_name'];
					$tipe_file=$_FILES['fupload']['type'];
					$nama_file=$_FILES['fupload']['name'];			
					
				
					$pilihnoim="select * from instal_im where noim='$noim'";
					$eksnoim=mysql_query($pilihnoim);
					$dataim=mysql_fetch_array($eksnoim);
					$nofpb=$dataim['nofpb'];
					$areapro=$dataim['area'];
					$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
										
					
					$nama_sales=$dataim['nama_sales'];
					$isi='Project Terminasi Untuk Pelanggan '.$pelanggan.' Telah Selesai. ';
					
					$move = move_uploaded_file($lokasi_file,'spkterm/'.$nama_file);
					
					if($move){
										
					$upstat="update instal_im SET spkterm='$nama_file', status='$finish', tujuan='$finish', status_close='$status_close' where noim='$noim'";
					$eksupstat=mysql_query($upstat);
					
					$upstat2="update internal_memo SET tglfin='$selisih1', status_close='$status_close', status_inven='$status_inven', tglupterm='$waktu' where noim='$noim'";
					$eksupstat2=mysql_query($upstat2);
					
					$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$namauser','$waktu','$isi','$noim')";
					$queryreport=mysql_query($inputreport);
					
					$pilihto="select * from usr_tb where nama_lengkap='$nama_sales'";
					$eksto=mysql_query($pilihto);
					$datato=mysql_fetch_array($eksto);
					$dataemail=$datato['email'];
					
					$to=$dataemail;
					$subject = "Project Completed";
					$message = "Project untuk perusahaan ".$pelanggan." telah selesai ";
					$from = "SAPSBP";
					$headers  = "From:SAPSBP";
					$headers .= " : Notifikasi";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$message,$headers);
					
					$pilihto2="select * from usr_tb where bagian='AR'";
					$eksto2=mysql_query($pilihto2);
					$datato2=mysql_fetch_array($eksto2);
					$dataemail2=$datato2['email'];
 					$to2=$dataemail2;
					$subject2 = "Project Completed";
					$message2 = "Project Terminasi untuk perusahaan ".$pelanggan." telah selesai dilakukan oleh ".$namauser;
					$from2 = "SAPSBP";
					$headers2  = "From:SAPSBP";
					$headers2 .= " : Notikasi";
					$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to2,$subject2,$message2,$headers2);

					$to3='dco@sbp.net.id';
					mail($to3,$subject2,$message2,$headers2);

                                        $pilihto4="select * from usr_tb where level='Engineer' and area='$areapro'";
					$eksto4=mysql_query($pilihto4);
					$datato4=mysql_fetch_array($eksto4);
					$to4=$datato4['email'];
					mail($to4,$subject2,$message2,$headers2);

					header ('Location:assi.php');
					}else{
					echo 'Maaf, gagal mengupload file SPK';
					}
						 
	echo '		
			
	</div>';
	?>
	
	<div id="footer">copyright &copy; www.sbp.net.id 2012 condev-team</div>
</body>
</html>
