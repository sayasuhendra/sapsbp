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
	
	?>
	<?php
	echo '
	<div id="isi">
		<h3 class="judulok">Form Report / Upload BAO</h3>';
		
					include "koneksi.php";
					date_default_timezone_set('Asia/Jakarta');
                                        $noim=$_POST['noim'];
					$lokasi_file=$_FILES['fupload']['tmp_name'];
					$tipe_file=$_FILES['fupload']['type'];
					$nama_file=$_FILES['fupload']['name'];
					$lokasi_file2=$_FILES['topologi']['tmp_name'];
					$tipe_file2=$_FILES['topologi']['type'];
					$nama_file2=$_FILES['topologi']['name'];
					$lokasi_file3=$_FILES['speed']['tmp_name'];
					$tipe_file3=$_FILES['speed']['type'];
					$nama_file3=$_FILES['speed']['name'];
					$lokasi_file4=$_FILES['foto']['tmp_name'];
					$tipe_file4=$_FILES['foto']['type'];
					$nama_file4=$_FILES['foto']['name'];
                                        $pelanggan=$_POST['pelanggan'];
					$status_close="OK";
                                        $namauser=$_POST['namalengkap'];
					$jam=date('H:i:s');
					$tanggal=date('d F Y');
					$waktu=$tanggal.', Jam : '.$jam;
					
					$move = move_uploaded_file($lokasi_file,'bao/'.$nama_file);  
					$move2 = move_uploaded_file($lokasi_file2,'topologi/'.$nama_file2);  
					$move3 = move_uploaded_file($lokasi_file3,'speedtest/'.$nama_file3);  
					$move4 = move_uploaded_file($lokasi_file4,'foto/'.$nama_file4);  
					
					if($move && $move3 ){  
                    $pilih_tbc="select * from customer_new";
					$eksekusi_tbc=mysql_query($pilih_tbc);
					while($urutid=mysql_fetch_array($eksekusi_tbc)){
					$idcir=substr($urutid['cirid'],-4);
					$thn=date('y');
                                        $bln=date('m');
                                        $hri=date('d'); 
                                        if($area='Batam'){
                                        $kodes='1';
                                        $kode=sprintf("%02s",$kodes);
                                        }else if($area='Jakarta'){
                                        $kodes='2';
                                        $kode=sprintf("%02s",$kodes);
                                        }else if($area='TPI'){
                                        $kodes='3';
                                        $kode=sprintf("%02s",$kodes);
                                        }else if($area='TBK'){
                                        $kodes='4';
                                        $kode=sprintf("%02s",$kodes);
                                        }

                                 	$ciridlomok='0'.$idcir + 0001;
                                        $ciridok=sprintf("%04s",$ciridlomok);
					}
					if ($urutid['cirid']=='0'){ 
					$ciridactive=$thn.$bln.$hri.$kode.'0001';
					}else {
					$ciridactive=$thn.$bln.$hri.$kode.$ciridok;
					}
					$pilihnoim="select * from instal_im inner join fpa_tb on instal_im.noim=fpa_tb.noim where instal_im.noim='$noim'";
					$eksnoim=mysql_query($pilihnoim);
					$dataim=mysql_fetch_array($eksnoim);
					$noim=$dataim['noim'];
					$nofpb=$dataim['nofpb'];
					$tglstart=$dataim['tglstart'];
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
					
					if($dataim['jenis_pekerjaan']=='Instalasi'){
					$cusdat="INSERT INTO customer_new (cirid, nama_perusahaan, alamat_perusahaan, alamat_tagihan, cp_teknis, bandwidth_client, nama_vendor, status, register_date,marketing,ippublic) VALUES ('$ciridactive','$namapers','$alamatpers','$alamatpers','$cp','$speed','$provider','$statdat','$tglrfs','$sales','$ipadd')";
				    $eksekusidat=mysql_query($cusdat);
					}
									
					$nama_sales=$dataim['nama_sales'];
					$isi='Project Untuk Pelanggan '.$pelanggan.' Telah Selesai. ';
					$input="insert into upload_bao (noim,namapers,file_bao) values ('$noim','$pelanggan','$nama_file')";
					$eksinput=mysql_query($input);
					
					$upstat="update instal_im SET tglstart='$selisih1', status='Finish', tujuan='Finish', status_close='$status_close', file_bao='$nama_file', file_topologi='$nama_file2', file_speed='$nama_file3', file_foto='$nama_file4' where noim='$noim'";
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
					$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		                        $headers .= "MIME-Version: 1.0\r\n";
		                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        $headers .= "Noim: " .$noim. "\r\n";


					mail($to,$subject,$message,$headers);

                    $pilihto2="select * from usr_tb where bagian='AR'";
					$eksto2=mysql_query($pilihto2);
					$datato2=mysql_fetch_array($eksto2);
					$dataemail2=$datato2['email'];
					$to2=$dataemail2;
					$subject2 = "Project Completed [ ".$noim." ]";
					$message2 = 'Project untuk perusahaan '.$pelanggan.' telah selesai Per Tanggal '.$tanggal.' Dengan Sales '.$nama_sales.' dan sudah bisa di lakukan penagihan, untuk detail silahkan liat di SAP';
					$message = "Project untuk perusahaan ".$pelanggan." telah selesai ";
					$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		                        $headers .= "MIME-Version: 1.0\r\n";
		                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        $headers .= "Noim: " .$noim. "\r\n";
					mail($to2,$subject2,$message2,$headers2);
					header ('Location:assi.php');
					
					}else{  
					echo "Gagal mengupload file";  
					}  
						 
	echo '		
			
	</div>';
	?>
	
	<div id="footer">copyright &copy; www.sbp.net.id 2012 condev-team</div>
</body>
</html> 