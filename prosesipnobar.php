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
		$ipadd=$_POST['ipa'];
		$netmask=$_POST['netmask'];
		$ipgw=$_POST['ipgw'];
		$ipalo=$_POST['ipalo'];
		$pelaksana=$_POST['pelaksana'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		
		$pilihpel="select * from usr_tb where nama_lengkap='$pelaksana'";
                $ekspel=mysql_query($pilihpel);
                $sipel=mysql_fetch_array($ekspel);

                $pilihnampers="select * from instal_im where noim='$noim'";
                $eksnampers=mysql_query($pilihnampers); 
                $datnampers=mysql_fetch_array($eksnampers);
                $namapers=$datnampers['namapers'];
                $namasales=$datnampers['nama_sales'];

                $pilihmail="select * from usr_tb where nama_lengkap='$namasales'";
                $eksmail=mysql_query($pilihmail);
                $simail=mysql_fetch_array($eksmail);

                $to2=$simail['email'];
		$from2 = "SAPSBP";
                $headers2  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers2 .= "MIME-Version: 1.0\r\n";
		$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers2 .= "Noim: " .$noim. "\r\n";
                $headers2 .= "Bcc: sap@sbp.net.id \r\n";
		$subject2 = "Installation Project [".$noim."] ".$namapers;
		$message2 ='IP Address telah di isi oleh Engineer Area '.$area.' : '.$nama_lengkap.' . dan sudah di tunjuk '.$pelaksana.' sebagai pelaksana';
		mail($to2,$subject2,$message2,$headers2);                

                $to=$sipel['email'];
		$from = "SAPSBP";
                $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: sap@sbp.net.id \r\n";
		$subject = "Installation Project [".$noim."] ".$namapers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">
                                  Ada Tugas Instalasi Baru dari Supervisor Teknikal untuk perusahaan '.$namapers.'. Dengan detail keterangan sbb :</p>
                                  <table>
                                    <tr>
                                          <td>No IM</td>
                                          <td>:</td>
                                          <td>'.$noim.'</td>
                                    </tr>     
                                    <tr>
                                          <td>Contact Person</td>
                                          <td>:</td>
                                          <td>'.$datnampers['cp'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Telp</td>
                                          <td>:</td>
                                          <td>'.$datnampers['telp'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Alamat</td>
                                          <td>:</td>
                                          <td>'.$datnampers['alamat'].'</td>
                                    </tr>     
                                     <tr>
                                          <td>Jasa</td>
                                          <td>:</td>
                                          <td>'.$datnampers['jasa'].'</td>
                                    </tr>     
                                    <tr>
                                          <td>Tgl RFS</td>
                                          <td>:</td>
                                          <td>'.$datnampers['tglrfs'].'</td>
                                    </tr>     
                                     <tr>
                                          <td>Speed</td>
                                          <td>:</td>
                                          <td>'.$datnampers['akses_speed'].'</td>
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

                $update_im="update instal_im SET tglupspk='$waktu', tujuan='$pelaksana', status_inven='OK', status_spk='OK', ipadd='$ipadd', netmask='$netmask', gateway='$ipgw', iptambah='$ipalo' where noim='$noim'";
		$eks_im=mysql_query($update_im);
		
		$update_im2="update internal_memo SET tglupspk='$waktu', status_inven='OK', status_spk='OK' where noim='$noim'";
		$eks_im2=mysql_query($update_im2);
		
		$isireport='IP Address telah di isi oleh Engineer Area '.$area.' :'.$datauser['nama_lengkap'].'. dan sudah di tunjuk '.$pelaksana.' sebagai pelaksana';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$nama_lengkap','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		
		echo '<p>Terimakasih '.$datauser['nama_lengkap'].', Project Tinggal menunggu aktifasi oleh '.$pelaksana.'</p>
		
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>