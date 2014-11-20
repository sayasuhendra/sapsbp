<?php
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
					include "roma.php";
                                        $area=$_POST['area'];
					$jenpek=$_POST['jenpek'];
					$waktuok=date('Ymd');
					$pilihfpb="select * from instal_im where jenis_pekerjaan='$jenpek'";
					$eksfpb=mysql_query($pilihfpb);
					$datano=mysql_fetch_row($eksfpb);
					if($datano==0){
					
					$nourut1=0001;
					$nourutok1=sprintf("%04s",$nourut1);
					$nofpb='SBP/FPC/'.$waktuok.'/'.$nourutok1;
					$nourut='1';
					$nourutok=sprintf("%04s",$nourut);
					}
					else if($datano >= 1){
					$pilihim="select * from instal_im where jenis_pekerjaan='$jenpek'";
					$eksim=mysql_query($pilihim);
					while($datafpb=mysql_fetch_array($eksim)){
					$nourut1=$datafpb['nourut'] + '1';
					$nourutok1=sprintf("%04s",$nourut1);
					$nofpb='SBP/FPC/'.$waktuok.'/'.$nourutok1;
					$nourut=$datafpb['nourut'] + '1';
					$nourutok=sprintf("%04s",$nourut);
					}
					}
					
					date_default_timezone_set('Asia/Jakarta');
					
					$noim=$nourutok.'/SBP-'.$area.'/Terminasi/'.$roma.'/'.$tahun;
					$pelanggan=$_POST['namapers'];
					$lokasi_file=$_FILES['fupload']['tmp_name'];
					$tipe_file=$_FILES['fupload']['type'];
					$nama_file=$_FILES['fupload']['name'];
					$provider=$_POST['provider'];
					$rfs=$_POST['rfs'];
					$penjelasan=$_POST['penjelasan'];
					$namauser=$_POST['namalengkap'];
					$status_fin='OK';
					$status_close='NOK';
					$statim='NOK';
					$stattm='NOK';
					$statinven='NOK';
					
					$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
					$bulan = $array_bulan[date('n')];
					$tanggal1=date('d');
					$tahun=date('Y');
					$tanggal=$tanggal1.' '.$bulan.' '.$tahun;
					$jam=date('H:i:s');
					$waktu=$tanggal.', Jam '.$jam;
					
					$move = move_uploaded_file($lokasi_file,'fpc/'.$nama_file);  
					$status='Pending';
					
					if($move){  
					
					$inputdata="INSERT INTO instal_im (tglrfs,nofpb,nourut,namapers,status,jenis_pekerjaan,nama_sales,status_fin,status_close,noim,status_tm, status_im) values ('$rfs','$nofpb','$nourutok1','$pelanggan','$status','$jenpek','$namauser','$status_fin','$status_close','$noim','$stattm','$statim')";
					$query=mysql_query($inputdata);
					
					$inputmemo="INSERT INTO internal_memo (tgl_req,tglupterm,noim,namapers,jenpek,orderby,status_im,status_tm,status_fin,status_close,status_inven) VALUES  ('$rfs','$waktu','$noim','$pelanggan','$jenpek','$namauser','$statim','$stattm','$status_fin','$status_close','$statinven')";
					$querymemo=mysql_query($inputmemo);
					
					$isireport='Form FPC sudah dikirim oleh <b>'.$namauser.'</b> untuk perusahaan <b>'.$pelanggan.'</b>. kepada bagian Finance';
					$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$namauser','$waktu','$isireport')";
					$queryreport=mysql_query($inputreport);
					
					$pilihto="select * from usr_tb where bagian='AR'";
					$eksto=mysql_query($pilihto);
					$datato=mysql_fetch_array($eksto);
					$dataemail=$datato['email'];
					$to=$dataemail;
					$subject = "FPC dari Sales";
					$message = "Ada Form FPC dari sales untuk terminasi client ".$pelanggan." silahkan followup melalui SAP";
					$from    = "SAPSBP";
					$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$message,$headers);
					echo 'Terimakasih, FPC sudah berhasil di kirim ke bagian Finance';
					
					}else{  
					echo "Gagal mengupload file";  
					}  
						 
	echo '		
			
	</div>';
	?>
	
	<div id="footer">copyright &copy; www.sbp.net.id 2012 condev-team</div>
</body>
</html>