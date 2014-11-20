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
		$jumlah=$_POST['jumlah'];
		$harga=$_POST['harga'];
		$biaya_total=$harga*$jumlah;
		$alasan=$_POST['alasan'];
		$noim=$_POST['namapers'];
		$pilihperus="select * from instal_im where noim='$noim'";
		$eksperus=mysql_query($pilihperus);
		$perus=mysql_fetch_array($eksperus);
		$namaperus=$perus['namapers'];
		
		if($status=='Approve'){
		$updateinven="update barang set statusin='OK', harga_barang='$harga', total_biaya='$biaya_total', alasan='$alasan' where id_barang='$id'";
		$eksinven=mysql_query($updateinven);
		
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Status Order Barang [".$noim."] ".$namaperus;
		$message = 'Request Barang Anda : '.$jumlah.' Buah '.$jenis.' Untuk Perusahaan : '.$namaperus.' Telah di Approve oleh bagian '.$bagian;
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: sap@sbp.net.id \r\n";				
		mail($to,$subject,$message,$headers);
        
		$pilihorder9="select * from usr_tb where bagian='Finance' AND level='Manajer'";
		$eksorder9=mysql_query($pilihorder9);
		$dataorder9=mysql_fetch_array($eksorder9);
		$to9=$dataorder9['email'];
		$bagianorder9=$dataorder9['bagian'];
		$subject9 = "Order Barang";
		$message9 = 'Ada Request Barang Baru Dari '.$orderby.' berupa: '.$jumlah.' Buah '.$jenis.' . Untuk Perusahaan '.$namaperus.'. Untuk Detail Silahkan Login ke SAP SBP';
		$headers9 = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers9 .= "MIME-Version: 1.0\r\n";
		$headers9 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers9 .= "Bcc: sap@sbp.net.id \r\n";				
		mail($to9,$subject9,$message9,$headers9);
		echo 'Terimakasih '.$namauser.' Data request barang telah di teruskan ke manajer finance untuk di approve';
		
		}elseif($status=='Pending'){
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Saat ini status barang yang anda request berupa '.$jumlah.' '.$jenis.' Untuk perusahaan '.$namaperus.' masih pending dibagian inventory karena alasan :'.$alasan;
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: sap@sbp.net.id \r\n";				
		mail($to,$subject,$message,$headers);
		echo 'Terimakasih '.$namauser.', status pending akan di infokan ke '.$orderby.' selaku perequest';
		}
		elseif($status=='Reject'){
		$status='Reject';
		$statusakhir='Rejected By : '.$namauser;
		$updatebr="update barang SET status='$statusakhir', statusin='$status', alasan='$alasan' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Status permintaan barang yang anda ajukan berupa '.$jumlah.' '.$jenis.' Untuk Perusahaan '.$namaperus.' di reject / tidak disetujui oleh bagian inventory dengan alasan :'.$alasan;
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: sap@sbp.net.id \r\n";				
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