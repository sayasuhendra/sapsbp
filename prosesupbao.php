<?php
ob_start("ob_gzhandler");
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$area=$datauser['area'];
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
	require 'helper/file.php';
	
	?>
	<?php
	echo '
	<div id="isi">
		<h3 class="judulok">Form Report / Upload BAO</h3>';
		
					include "koneksi.php";
					date_default_timezone_set('Asia/Jakarta');

                    $noim=$_POST['noim'];

                    $lokasi_file=$_FILES['fupload']['tmp_name'];
					$tipe_file=$_FILES['fupload']['name'];		

					$lokasi_file2=$_FILES['topologi']['tmp_name'];
					$tipe_file2=$_FILES['topologi']['name'];

					$lokasi_file3=$_FILES['speed']['tmp_name'];
					$tipe_file3=$_FILES['speed']['name'];

					$lokasi_file4=$_FILES['foto']['tmp_name'];
					$tipe_file4=$_FILES['foto']['name'];

					$lokasi_file5=$_FILES['pizza']['tmp_name'];
					$tipe_file5=$_FILES['pizza']['name'];

					$lokasi_file6=$_FILES['nms']['tmp_name'];
					$tipe_file6=$_FILES['nms']['name'];

                    $pelanggan=$_POST['pelanggan'];

                    $keterangan = $_POST['keterangan'];
                    $sinology = $_POST['sinology'];

					$status_close="OK";
                    $namauser=$_POST['namalengkap'];
					$jam=date('H:i:s');
					$tanggal=date('d F Y');
					$waktu=$tanggal.', Jam : '.$jam;

					$namafilebaru = str_replace('/', '_', $noim);

					$extention = File::ext($tipe_file);
					$extention2 = File::ext($tipe_file2);
					$extention3 = File::ext($tipe_file3);
					$extention4 = File::ext($tipe_file4);

					$extention5 = File::ext($tipe_file5);
					$extention6 = File::ext($tipe_file6);

					$namabao = "BAO_IM_" . $namafilebaru . "." . $extention;
					$namatopologi = "Topologi_IM_" . $namafilebaru . "." . $extention2;
					$namaspeedtest = "Speedtest_IM_" . $namafilebaru . "." . $extention3;
					$namafoto = "Foto_IM_" . $namafilebaru . "." . $extention4;
					$namapizza = "Pizza_IM_" . $namafilebaru . "." . $extention5;
					$namanms = "NMS_IM_" . $namafilebaru . "." . $extention6;


					$move = move_uploaded_file($lokasi_file,'bao/' . $namabao);
					$move2 = move_uploaded_file($lokasi_file2,'topologi/' . $namatopologi);
					$move3 = move_uploaded_file($lokasi_file3,'speedtest/' . $namaspeedtest);
					$move4 = move_uploaded_file($lokasi_file4,'foto/' . $namafoto);
					$move5 = move_uploaded_file($lokasi_file5,'pizza/' . $namapizza);
					$move6 = move_uploaded_file($lokasi_file6,'nms/' . $namanms);
					
					if(!$move){ $namabao = "kosong"; }
					if(!$move2){ $namatopologi = "kosong"; }
					if(!$move3){ $namaspeedtest = "kosong"; }
					if(!$move4){ $namafoto = "kosong"; }
					if(!$move5){ $namapizza = "kosong"; }
					if(!$move6){ $namanms = "kosong"; }

					echo ($move)? "Berhasil mengupload BAO." : "Gagal mengupload BAO."; echo "<br><br>";
					echo ($move2)? "Berhasil mengupload Topologi." : "Gagal mengupload Topologi."; echo "<br><br>";
					echo ($move3)? "Berhasil mengupload Speedtest." : "Gagal mengupload Speedtest."; echo "<br><br>";
					echo ($move4)? "Berhasil mengupload Foto Lokasi." : "Gagal mengupload Foto Lokasi."; echo "<br><br>";
					echo ($move5)? "Berhasil mengupload Capture Pizza." : "Gagal mengupload Capture Pizza."; echo "<br><br>";
					echo ($move6)? "Berhasil mengupload Capture NMS." : "Gagal mengupload Capture NMS.";


					
					$pilihnoim="select * from instal_im inner join fpa_tb on instal_im.noim=fpa_tb.noim where instal_im.noim='$noim'";

					$eksnoim=mysql_query($pilihnoim);
					$dataim=mysql_fetch_array($eksnoim);
					$noim=$dataim['noim'];
					$nofpb=$dataim['nofpb'];
					$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
					$namapers=$dataim['namapers'];
					$alamatpers=$dataim['alamat'];
					$cp=$dataim['cp'];
					$speed=$dataim['akses_speed'];
					$provider=$dataim['akses_pro'];
					$tglrfs=$dataim['tglrfs'];
					$sales=$dataim['nama_sales'];
					$ipadd=$dataim['ipadd'];
					$statdat='Active';
                    $ok='OK';
                    $areab=$dataim['area'];


                    	$noim4digit = substr($noim, 0, 4);
                        $tglrfsbaru = new DateTime($tglrfs);
                        $tanggalcirid = $tglrfsbaru->format('ymd');
                        $cirid = $tanggalcirid . $noim4digit;

					
					if($dataim['jenis_pekerjaan']=='Instalasi'){

						$cusdat= " INSERT INTO customer_new (pelaksana, bao, nms, pizza, keterangan, sinology,file_topologi,file_speed,file_foto,cirid, nama_perusahaan, alamat_perusahaan, alamat_tagihan, cp_teknis, bandwidth_client, nama_vendor, status, register_date,marketing,ippublic) 
													VALUES ('$namauser', '$namabao', '$namanms', '$namapizza', '$keterangan', '$sinology', '$namatopologi','$namaspeedtest','$namafoto','$cirid','$namapers','$alamatpers','$alamatpers','$cp','$speed','$provider','$statdat','$tglrfs','$sales','$ipadd')";

	                    $eksekusidat=mysql_query($cusdat);

					}
									
					$nama_sales=$dataim['nama_sales'];
					$isi='Project Untuk Pelanggan '.$pelanggan.' Telah Selesai. ';
					$input="insert into upload_bao (noim,namapers,file_bao) values ('$noim','$pelanggan','$namabao')";
					$eksinput=mysql_query($input);
					
					$upstat="update instal_im SET status='Finish', tujuan='Finish', status_close='$status_close', file_bao='$namabao', file_topologi='$namatopologi', file_speed='$namaspeedtest', file_foto='$namafoto' where noim='$noim'";
					$eksupstat=mysql_query($upstat);
					
					$upstat2="update internal_memo SET tglfin='$selisih1', status_spk='$ok', status_close='$status_close', status_inven='$ok' where noim='$noim'";
					$eksupstat2=mysql_query($upstat2);
					
					$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$namauser','$waktu','$isi','$noim')";
					$queryreport=mysql_query($inputreport);
					
					$pilihto="select * from usr_tb where nama_lengkap='$nama_sales'";
					$eksto=mysql_query($pilihto);
					$datato=mysql_fetch_array($eksto);
					$dataemail=$datato['email'];
					$to=$dataemail;
					$subject = "Project Completed [ ".$noim." ]";
					$message = "Project untuk perusahaan ".$pelanggan." telah selesai ";
					$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		            $headers .= "MIME-Version: 1.0\r\n";
		            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers .= "Noim: " .$noim. "\r\n";


					mail($to,$subject,$message,$headers);
					
					$pilihmailen="select * from usr_tb where area='$areab' AND level='Engineer' OR area='Global' AND level='Engineer'";
					$eksmailen=mysql_query($pilihmailen);
					$datamailen=mysql_fetch_array($eksmailen);
					$mailen=$datamailen['email'];
					
					$to3='cs@sbp.net.id';
                                        $ccnya='noc@sbp.net.id';
					$from3 = "SAPSBP";
					$headers3 = "From: SAP Information<sap@sbp.net.id>" . "\r\n";
					$headers3 .= "MIME-Version: 1.0\r\n";
					$headers3 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        $headers3 .= "cc: ".$ccnya;
					$headers3 .= "Bcc: ".$mailen;
					$subject3 = "New Customer Information : ".$namapers;
					$message3 = '<html><body><p>Ada Pelanggan Baru yang telah selesai di instalasi, berikut data pelanggan baru SBP : </p>
								<table border="0px">
									<tr>
										<td>Nama Perusahaan : '.$namapers.' </td>
										
									</tr>
									<tr>
										<td>Alamat  : '.$alamatpers.' </td>
									</tr>
									<tr>
										<td>Kontak Person  : '.$cp.' : '.$dataim['telp'].' </td>
									</tr>
									<tr>
										<td>Vendor  : '.$provider.' </td>
									</tr>
									<tr>
										<td>Ip Address  : '.$dataim['ipadd'].' </td>
									</tr>
									<tr>
										<td>Subnet Mask  : '.$dataim['netmask'].' </td>
									</tr>
									<tr>
										<td>IP Gateway  : '.$dataim['gateway'].' </td>
									</tr>
									<tr>
										<td>IP Tambahan  : '.$dataim['iptambah'].' </td>
									</tr>
																	
									
								</table>
								
						<p>Untuk Topologi dapat di akses di <a href="http://sap.sbp.net.id/topologi/'.$namatopologi.'" target="_blank">sini</a></p>
						<p>Untuk Foto Perangkat dapat di akses di <a href="http://sap.sbp.net.id/foto/'.$namafoto.'" target="_blank">sini</a></p>';
					
							
					$message3 .='
					</body>
					</html>';
		
					mail($to3,$subject3,$message3,$headers3);

					$to4='dco@sbp.net.id';
					$from4 = "SAPSBP";
					$headers4 = "From: SAP Information<sap@sbp.net.id>" . "\r\n";
					$headers4 .= "MIME-Version: 1.0\r\n";
					$headers4 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$headers4 .= "Bcc: ".$mailen;
					$subject4 = "New Customer Information : ".$namapers;
					$message4 = '<html><body><p>Ada Pelanggan Baru yang telah selesai di instalasi, berikut data pelanggan baru SBP : </p>
								<table border="0px">
									<tr>
										<td>Nama Perusahaan : '.$namapers.' </td>
										
									</tr>
									<tr>
										<td>Alamat  : '.$alamatpers.' </td>
									</tr>
									<tr>
										<td>Kontak Person  : '.$cp.' : '.$dataim['telp'].' </td>
									</tr>
									<tr>
										<td>Vendor  : '.$provider.' </td>
									</tr>
									<tr>
										<td>Ip Address  : '.$dataim['ipadd'].' </td>
									</tr>
									<tr>
										<td>Subnet Mask  : '.$dataim['netmask'].' </td>
									</tr>
									<tr>
										<td>IP Gateway  : '.$dataim['gateway'].' </td>
									</tr>
									<tr>
										<td>IP Tambahan  : '.$dataim['iptambah'].' </td>
									</tr>
																	
									
								</table>
								
						<p>Untuk Topologi dapat di akses di <a href="http://sap.sbp.net.id/topologi/'.$namatopologi.'" target="_blank">sini</a></p>
						<p>Untuk Foto Perangkat dapat di akses di <a href="http://sap.sbp.net.id/foto/'.$namafoto.'" target="_blank">sini</a></p>';
					
							
					$message4 .='
					</body>
					</html>';
		
					mail($to4,$subject4,$message4,$headers4);

                    $pilihto2="select * from usr_tb where bagian='AR'";
					$eksto2=mysql_query($pilihto2);
					$datato2=mysql_fetch_array($eksto2);
					$dataemail2=$datato2['email'];
					$to2=$dataemail2;
					$subject2 = "Project Completed [ ".$noim." ]";
					$message2 = 'Project untuk perusahaan '.$pelanggan.' telah selesai Per Tanggal '.$tanggal.' Dengan Sales '.$nama_sales.' dan sudah bisa di lakukan penagihan, untuk detail silahkan liat di SAP';
					$message = "Project untuk perusahaan ".$pelanggan." telah selesai ";
					$headers2  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
                    $headers2 .= "MIME-Version: 1.0\r\n";
                    $headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers2 .= "Noim: " .$noim. "\r\n";
					mail($to2,$subject2,$message2,$headers2);
					
	echo '		
			
	</div>';
	?>
	
	<div id="footer">copyright &copy; www.sbp.net.id 2012 condev-team</div>
</body>
</html> 
