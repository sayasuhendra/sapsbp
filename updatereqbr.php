<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$bagian=$datauser['bagian'];
$level=$datauser['level'];
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
	
	<?php
        include "header.php";
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
		$noim=$_POST['namapers'];
		$jenis=$_POST['jenis'];
		$jumlah=$_POST['jumlah'];
		$alasan=$_POST['alasan'];
		
		$pilihperus="select * from instal_im where noim='$noim'";
		$eksperus=mysql_query($pilihperus);
		$perus=mysql_fetch_array($eksperus);
		$namaperus=$perus['namapers'];
		
        if($bagian=='Finance' && $level=='Manajer'){
               
        if($status=='Approve'){
		$statusfin='OK';
        $nok='NOK';
		$updatebr="update barang SET statusfin='$statusfin', statusin='$nok' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		
		
		
		$pilihorder="select * from usr_tb where bagian='Inventory'";
		$eksorder=mysql_query($pilihorder);
		while($dataorder=mysql_fetch_array($eksorder)){
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Update Order Barang";
		$message = "Order Barang dari ".$orderby." Untuk Perusahaan ".$namaperus." berupa ".$jenis." sudah di setujui oleh Finance Manager. untuk detail silahkan lihat di SAPSBP";
		$from = "SAPSBP_REQBARANG";
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: sap@sbp.net.id \r\n";				
		mail($to,$subject,$message,$headers);
		}	
		echo 'Terimakasih '.$namauser.' data request telah diteruskan ke bagian inventory';
		}
		elseif($status=='Reject'){
		$status='Rejected By : '.$namauser;
		$statusfin='Rejected';
		$updatebr="update barang SET status='$status', statusfin='$statusfin' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Request Barang Anda Berupa '.$jenis.' Untuk Perusahaan '.$namaperus.' Di Tolak Oleh '.$bagian.' Manajer dengan alasan : '.$alasan;
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: sap@sbp.net.id \r\n";				
		mail($to,$subject,$message,$headers);
		echo 'Request Barang Telah di Reject dan di infokan ke user yang bersangkutan';
		}  
           
                }else if($bagian=='Teknikal' && $level=='Manajer'){

        if($status=='Approve'){
		$statustm='OK';
		$updatebr="update barang SET statustm='$statustm' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where bagian='Inventory'";
		$eksorder=mysql_query($pilihorder);
		while($dataorder=mysql_fetch_array($eksorder)){
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = "Ada Request Barang baru dari ".$orderby." berupa ".$jenis." Untuk Perusahaan ".$namaperus.". untuk detail silahkan lihat di SAPSBP";
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		}	
		echo 'Terimakasih '.$namauser.' data request telah diteruskan ke bagian inventory';
		}elseif($status=='Revisi'){
		$statustm='Revisi';
		$updatebr="update barang SET statustm='$statustm' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = $bagian.' Manajer belum melakukan persetujuan barang yang anda request untuk Perusahaan '.$namaperus.' berupa '.$jumlah.' buah '.$jenis.' dengan alasan : '.$alasan.'. Silahkan revisi kembali request Anda';
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Data akan di kembalikan ke '.$orderby.' untuk di revisi';
		
		}
		elseif($status=='Reject'){
		$status='Rejected By : '.$namauser;
		$statustm='Rejected';
		$updatebr="update barang SET status='$status', statustm='$statustm' where id_barang='$id'";
		$eksbr=mysql_query($updatebr);
		$pilihorder="select * from usr_tb where nama_lengkap='$orderby'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Request Barang Anda berupa '.$jenis.' untuk perusahaan '.$namaperus.' Di Tolak Oleh '.$bagian.' Manajer dengan alasan : '.$alasan;
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		echo 'Request Barang Telah di Reject dan di infokan ke user yang bersangkutan';
		}              

                }
		
		
		?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>