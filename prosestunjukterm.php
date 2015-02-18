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
		<h3 class="judulok">Proses Penunjukan Pelaksana Terminasi</h3>';
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
		
		$update_im="update instal_im SET tglupspk='$waktu', tujuan='$pelaksana', status_inven='$ok', status_spk='$ok' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupspk='$waktu', status_spk='$ok' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport= $nama_lengkap.' Sudah Menunjuk '.$pelaksana.' sebagai pelaksana untuk project terminasi pelanggan : '.$pers;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);

                $pilihpel="select * from usr_tb where nama_lengkap='$pelaksana'";
                $ekspel=mysql_query($pilihpel);
                $sipel=mysql_fetch_array($ekspel);

                $to=$sipel['email'];
		$from = "SAPSBP";
                $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: sap@sbp.net.id \r\n";
		$subject = "Termination Project [".$noim."] ".$pers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">
                                  Ada Tugas Terminasi dari Supervisor Teknikal untuk perusahaan '.$pers.'. Dengan detail keterangan sbb :</p>
                                  <table>
                                    <tr>
                                          <td>No IM</td>
                                          <td>:</td>
                                          <td>'.$noim.'</td>
                                    </tr>     
                                    <tr>
                                          <td>Contact Person</td>
                                          <td>:</td>
                                          <td>'.$datapers['cp'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Telp</td>
                                          <td>:</td>
                                          <td>'.$datapers['telp'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Alamat</td>
                                          <td>:</td>
                                          <td>'.$datapers['alamat'].'</td>
                                    </tr>     
                                     <tr>
                                          <td>Jasa</td>
                                          <td>:</td>
                                          <td>'.$datapers['jasa'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Tgl RFS</td>
                                          <td>:</td>
                                          <td>'.$datapers['tglrfs'].'</td>
                                    </tr>     
                                     <tr>
                                          <td>Speed</td>
                                          <td>:</td>
                                          <td>'.$datapers['akses_speed'].'</td>
                                    </tr>     
                                    <tr>
                                       <td colspan="3">Silahkan klik <a href="http://sap.sbp.net.id/detailim.php?noim='.$noim.'">di sini</a> untuk detail project </td>
                                    </tr>     

                                  </table>
                                  ';
		
		$message .='
		</body>
		</html>';
		mail($to,$subject,$message,$headers);                
		
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Tinggal menunggu Terminasi oleh '.$pelaksana.'</p>
		
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>