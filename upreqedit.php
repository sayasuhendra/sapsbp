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
		$noim=$_POST['namapers'];
		$jenis=$_POST['jenis'];
		$merk=$_POST['merk'];
		$type=$_POST['type'];
		$jumlah=$_POST['jumlah'];
		$statustm=$_POST['statustm'];
		$statusinven=$_POST['statusinven'];
		$statusfin=$_POST['statusfin'];
		$statuspo=$_POST['statuspo'];
		$status=$_POST['status'];
		$vendor=$_POST['vendor'];
		$keterangan=$_POST['keterangan'];
		$orderby=$_POST['order'];
		$id=$_POST['id_barang'];
		$harga=$_POST['harga'];
		$totbi=$harga*$jumlah;
		$updatebr="update barang set noim='$noim', total_biaya='$totbi', harga_barang='$harga', jenis='$jenis', merk='$merk', type='$type', jumlah='$jumlah', vendor='$vendor' ,keterangan='$keterangan' where id_barang='$id'";
		$prosesbr=mysql_query($updatebr);
		
		
		
		
		echo 'Terimakasih '.$namauser.' request barang telah berhasil di ubah';
		
		
		
	echo '
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>