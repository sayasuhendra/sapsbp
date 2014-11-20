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
	<form method="post" name="form" action="updatereqbr.php" id="form">
		<table class="tbrule" cellspacing="10px">
		<?php
	
	echo '
	
	<h3 class="judulok">Proses Permintaan Barang</h3>
		';
		$status=$_POST['status'];
		$id=$_POST['id_barang'];
		$orderby=$_POST['orderby'];
		$jenis=$_POST['jenis'];
		$alasan=$_POST['alasan'];
		$harga=$_POST['harga'];
		if($status=='Approve' && $harga<=1000000){
		
		$updateinven="update barang set statusfin='OK', statusin='NOK' where id_barang='$id'";
		$eksinven=mysql_query($updateinven);
		$pilihorder="select * from usr_tb where bagian='Inventory'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Request Barang berupa :'.$jenis.' Telah di Approve oleh bagian '.$bagian.'. Jika barang sudah ready stock update melalui SAP SBP';
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Terimakasih '.$namauser.', status barang telah di approve';
		
		}elseif($status=='Approve' && $harga>1000000){
		$updateinven="update barang set statusfin='OK' where id_barang='$id'";
		$eksinven=mysql_query($updateinven);
		$pilihorder="select * from usr_tb where level='BOD'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Ada request barang baru yang memerlukan Approval BOD, Silahkan login ke SAPSBP untuk detailnya.';
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Terimakasih '.$namauser.' Data request barang telah di teruskan ke manajer finance untuk di approve';
		
		}elseif($status=='Pending'){
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Saat ini status barang yang anda request masih pending dibagian finance karena alasan :'.$alasan;
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Terimakasih '.$namauser.', status pending akan di infokan ke '.$orderby.' selaku perequest';
		}
		elseif($status=='Reject'){
		$status='Reject';
		$statusakhir='Rejected By : '.$namauser;
		$updatebr="update barang SET status='$statusakhir', statusfin='$status', alasan='$alasan' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Status permintaan barang yang anda ajukan di reject / tidak disetujui oleh bagian finance dengan alasan :'.$alasan;
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Terimakasih '.$namauser.', status reject akan di infokan ke '.$orderby.' selaku perequest';
		}
		
		?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>