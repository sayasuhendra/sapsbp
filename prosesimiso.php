<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$area=$_SESSION['area'];
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
<script type="text/javascript" src="jquery-ui-1.8.22.custom.min.js"></script>
<link href="css/ui-lightness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
  <script>
	Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"d MM yy"
		};
		
		$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'd MM yy'
			}
		
		);
				
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
		include "koneksi.php";
		$waktu=date("Ymd");
			
		
	echo '
		<h3 class="judulok">Proses IM Isolir</h3>';
		date_default_timezone_set('Asia/Jakarta');
		
		$noim=$_POST['noim'];
		$nofpb=$_POST['nofpb'];
		$namapers=$_POST['namapers'];
		$nopel=$_POST['nopel'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$tgleks=$_POST['tgleks'];
		$bw=$_POST['speed'];
		$alasan=$_POST['alasan'];
		$tujuan=$_POST['tujuan'];
		$status=$_POST['status'];
		$jenpek=$_POST['jenpek'];
		$namafin=$_POST['orderby'];
		$statusim='OK';
		$status_tm=$_POST['status_tm'];
		$status_fin=$_POST['status_fin'];
		$status_close=$_POST['status_close'];
		$status_inven=$_POST['status_inven'];
		$status_spk=$_POST['status_spk'];
		$status_term=$_POST['status_term'];
		$lokasi_file=$_FILES['fupload']['tmp_name'];
		$tipe_file=$_FILES['fupload']['type'];
		$nama_file=$_FILES['fupload']['name'];
		$move = move_uploaded_file($lokasi_file,'im/'.$nama_file);
		
		$area=$_POST['area'];
		
		include "roma.php";
		$waktuok=date('Ymd');
		$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		
		
		
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$bulan = $array_bulan[date('n')];
		$tanggal1=date('d');
		$tahun=date('Y');
		$tanggal=$tanggal1.' '.$bulan.' '.$tahun;
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		if($move){
		
		$inputdata="update instal_im set imterm='$nama_file', tglupim='$waktu',  alamat='$alamat', cp='$cp', akses_speed='$bw', keterangan='$alasan', tujuan='$tujuan', status='$status', status_im='$statusim', tglim='$tanggal' where noim='$noim'";
		$query=mysql_query($inputdata);
		
		$inputmemo="update internal_memo set tglstart='$selisih2', tglupim='$waktu', tgl_req='$tgleks', status_im='$statusim' where noim='$noim'";
		$querymemo=mysql_query($inputmemo);
		
		$isireport='Internal Memo Baru Untuk Terminasi telah di kirim oleh <b>'.$namafin.'</b> untuk perusahaan <b>'.$namapers.'</b>.';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$namafin','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihtm="select * from usr_tb where bagian='DCO'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$to=$emailtm;
		$subject = "IM Terminasi dari Finance";
		$message = "Ada internal memo ".$jenpek." baru dari team finance untuk perusahaan ".$namapers.", silahkan login ke sapsbp untuk lebih detailnya";
		$from = "SAPSBP";
        $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Noim: " .$noim. "\r\n";
        
		
		mail($to,$subject,$message,$headers);
		}
					
		echo '<p>Terimakasih Internal Memo untuk '.$jenpek.' Customer '.$namapers.' sudah dikirim ke team DCO</p>';
		}else{
		echo 'Maaf Gagal Mengupload File IM';
		}		
	
		echo '
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>