<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$level=$_SESSION['level'];
$bagian=$_SESSION['bagian'];
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
		$( "#datepicker2" ).datepicker({
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
	
	echo '
		<h3 class="judulok">Form Permintaan Barang</h3>';
		$noim=$_POST['noim'];
		foreach($noim as $key => $nilai){
		$jenis=$_POST['jenis'][$key];
		$merk=$_POST['merk'][$key];
		$type=$_POST['type'][$key];
		$jumlah=$_POST['jumlah'][$key];
		$statustm=$_POST['statustm'][$key];
		$statusinven=$_POST['statusinven'][$key];
		$statusfin=$_POST['statusfin'][$key];
		$statuspo=$_POST['statuspo'][$key];
		$status=$_POST['status'][$key];
		$vendor=$_POST['vendor'][$key];
		$keterangan=$_POST['keterangan'][$key];
		$orderby=$_POST['order'][$key];
		
		$inputbr="insert into barang (status,orderby,statustm,statusin,statusfin,statuspo,noim,jenis,merk,type,jumlah,vendor,keterangan) values ('$status','$orderby','$statustm','$statusinven','$statusfin','$statuspo','$nilai','$jenis','$merk','$type','$jumlah','$vendor','$keterangan')";
		$prosesbr=mysql_query($inputbr);
		
		$pilihto="select * from usr_tb where level='Manajer' AND bagian='$bagian'";
		$eksto=mysql_query($pilihto);
		while($datato=mysql_fetch_array($eksto)){
		$to=$datato['email'];
		$subject = "Request Barang Project NOIM [".$nilai."]";
		$message = "Ada request barang baru dari ".$orderby.", berupa ".$jenis." ".$merk." ".$type.". Untuk Project Dengan NOIM : ".$nilai." Silahkan login ke sapsbp untuk lebih detailnya";
		$headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$nilai. "\r\n";

		mail($to,$subject,$message,$headers);
		}
		
		
		if($level=='Staff'){
		echo 'Terimakasih '.$namauser.' request barang telah di teruskan ke Manajer untuk di approve';
		}
		else{
		echo 'Terimakasih '.$namauser.' request barang telah di teruskan ke bagian inventory';
		}
		
		}
	echo '
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>