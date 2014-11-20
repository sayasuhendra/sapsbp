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
		$noim=$_POST['noim'];
		$namapers=$_POST['namapers'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam : '.$jam;
                $jasa=$_POST['jasa'];
		$jenpek=$_POST['jenpek'];
		$statim=$_POST['status_im'];
		$tujuan=$_POST['tujuan'];

                $pilihnampers="select * from instal_im where noim='$noim'";
                $eksnampers=mysql_query($pilihnampers); 
                $datnampers=mysql_fetch_array($eksnampers);
                $namasales=$datnampers['nama_sales'];



		
                if($jasa=='Colocation' || $jasa=='Hosting'){
 
                $stattm='OK';
		$isireport='Project untuk perusahaan '.$namapers.' telah di berikan oleh Teknikal Manajer : <b>'.$namauser.'</b>, kepada Team Condev Area '.$tujuan;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$namauser','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$updateim="update instal_im SET status_tm='OK', area='$tujuan', tujuan='$tujuan', status_spk='NOK' where id_imin='$id'";
		$eksupdateim=mysql_query($updateim);
		
		$updatememo="update internal_memo SET status_tm='OK', status_spk='NOK' where noim='$noim'";
		$eksmemo=mysql_query($updatememo);
		
		$updatefpa="update fpa_tb SET status_tm='OK' where noim='$noim'";
		$eksfpa=mysql_query($updatefpa);

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
 		$message2 =$isireport;
		mail($to2,$subject2,$message2,$headers2);                
		
		$pilihto="select * from usr_tb where level='Condev'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;
		$subject = "IM Instalasi";
		$message = "Ada internal memo baru dari Teknikal Manajer, Untuk Colocation / Hosting Baru. silahkan login ke sapsbp untuk lebih detailnya";
		$from = "SAPSBP";
		$headers  = "From:SAPSBP";
		$headers .= " : Notikasi";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 		mail($to,$subject,$message,$headers);
		
		header ('Location:assi.php');
                
                }else{
		if($jenpek=='Survey'){
		$stattm='NOK';
		}else{
		$stattm='OK';
		}		
		$isireport='Project untuk perusahaan '.$namapers.' telah di berikan oleh Teknikal Manajer : <b>'.$namauser.'</b>, kepada Supervisor Area '.$tujuan;
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$namauser','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$updateim="update instal_im SET status_tm='OK', area='$tujuan', tujuan='$tujuan', status_spk='NOK' where id_imin='$id'";
		$eksupdateim=mysql_query($updateim);
		
		$updatememo="update internal_memo SET status_tm='$stattm', status_spk='NOK' where noim='$noim'";
		$eksmemo=mysql_query($updatememo);
		
		$updatefpa="update fpa_tb SET status_tm='OK' where noim='$noim'";
		$eksfpa=mysql_query($updatefpa);
		
		$pilihto="select * from usr_tb where area='$tujuan' and level='Engineer'";
		$eksto=mysql_query($pilihto);
		$datato=mysql_fetch_array($eksto);
		$dataemail=$datato['email'];
		$to=$dataemail;

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
                if($jenpek=='Instalasi'){
                $subject2 = "Installation Project [".$noim."] ".$namapers;
                }else if($jenpek=='Terminasi'){
                $subject2 = "Terminasi Project [".$noim."] ".$namapers;
                }else if($jenpek=='survey'){
                $subject2 = "Survey Project [".$noim."] ".$namapers;
                }
		
 		$message2 =$isireport;
 		mail($to2,$subject2,$message2,$headers2);                
                
                $from = "SAPSBP";
                $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: sap@sbp.net.id \r\n";

                if($jenpek=='Instalasi'){
                $subject = "Installation Project [".$noim."] ".$namapers;
                }else if($jenpek=='terminasi'){
                $subject = "Termination Project [".$noim."] ".$namapers;
                }else if($jenpek=='survey'){
                $subject = "Survey Project [".$noim."] ".$namapers;
                }

		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">';
                if($jenpek=='Instalasi'){
                $message .= 'Ada Project Instalasi Baru dari Teknikal Manajer untuk perusahaan '.$namapers.'. Dengan detail keterangan sbb :</p>';
                }else if($jenpek=='terminasi'){
                $message .= 'Ada Project Terminasi Baru dari Teknikal Manajer untuk perusahaan '.$namapers.'. Dengan detail keterangan sbb :</p>';
                }else if($jenpek=='survey'){
                $message .= 'Ada Project Survey Baru dari Teknikal Manajer untuk perusahaan '.$namapers.'. Dengan detail keterangan sbb :</p>';
                }
       
                $message .= '<table>
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
		
		header ('Location:assi.php');
		}
		
		
		
			
		?>
		
		
				
			
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
