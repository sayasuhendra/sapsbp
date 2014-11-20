<?php
ob_start('ob_gzhandler');
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
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
		<h3 class="judulok">Proses Penggunaan Akses Pihak Ketiga</h3>';
		
			date_default_timezone_set('Asia/Jakarta');
			include "roma.php";
			$waktuok=date('Ymd');
			$pilihfpb="select * from fpa_tb where akses_status='Terminasi'";
			$eksfpb=mysql_query($pilihfpb);
			$datano=mysql_fetch_row($eksfpb);
			if($datano==0){
			$nourut1=0001;
			$nourutok1=sprintf("%04s",$nourut1);
			$nofpa=$nourutok1.'/SBP-FPAC/'.$roma.'/'.$waktuok;
			}
			else if($datano >= 1){
			$pilihim="select * from fpa_tb";
			$eksim=mysql_query($pilihim);
			while($datafpb=mysql_fetch_array($eksim)){
			$noima=$datafpb['nofpa'];
			$num=substr("$noima",0,4);
			$nourut1=$num + '1';
			$nourutok1=sprintf("%04s",$nourut1);
			$nofpa=$nourutok1.'/SBP-FPAC/'.$roma.'/'.$waktuok;
			}
			}
			
			$noim=$_POST['noim'];
			$aksus=$_POST['aksus'];
			$akstat=$_POST['akstat'];
			$speed=$_POST['speed'];
			$asal=$_POST['asal'];
			$tujuan=$_POST['tujuan'];
			$type=$_POST['type'];
			$provider=$_POST['provider'];
			$namapers=$_POST['namapers'];
			$target=$_POST['target'];
			$tglim=$_POST['tglim'];
			$namauser=$_POST['namauser'];
			$status=$_POST['status'];
			$tglapp='-';
			$appby='notyet';
			$perangkat=$_POST['perangkat'];
			$stattm='NOK';
			$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
			$bulan = $array_bulan[date('n')];
			$tanggal1=date('d');
			$tahun=date('Y');
			$tanggal=$tanggal1.' '.$bulan.' '.$tahun;
			$jam=date('H:i:s');
			$waktu=$tanggal.', Jam '.$jam;
					
			$proses="insert into fpa_tb (status_tm,tglapp,appby,status,orderby,noim,nofpa,akses_usage,akses_status,akses_speed,asal,tujuan,akses_type,akses_pro,target,tglim,namapers) values ('$stattm','$tglapp','$appby','$status','$namauser','$noim','$nofpa','$aksus','$akstat','$speed','$asal','$tujuan','$type','$provider','$target','$tglim','$namapers')";
			$eksproses=mysql_query($proses);
			
			$isireport='FPA untuk perusahaan '.$namapers.' telah dibuat oleh DCO <b>'.$namauser.'</b> dan diteruskan :  kepada Teknikal Manajer';
			$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpa','$namauser','$waktu','$isireport')";
			$aksi=mysql_query($inputreport);
			
			$pilihmail="select * from usr_tb where level='Manajer' AND bagian='Teknikal'";
			$eksmail=mysql_query($pilihmail);
			while($datamail=mysql_fetch_array($eksmail)){
			$mailtekman=$datamail['email'];
			$to=$mailtekman;
			$subject = "IM Terminasi";
			$message = "Ada FPA Terminasi baru dari Team DCO, silahkan login ke sapsbp untuk lebih detailnya";
			$from = "SAPSBP";
			$headers  = "From : SAPSBP";
			mail($to,$subject,$message,$headers);
			}
			
			header('Location:assi.php');
			?>
			
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
