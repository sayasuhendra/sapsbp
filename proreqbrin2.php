<?php
ob_start('ob_gzhandler');
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
<script type="text/javascript">
function validasi(){
var harga=document.form.harga.value;
if(harga==""){
alert("Harga Tidak Boleh Kosong, Isi 0 Jika Tidak Mengetahui Harga, Status Pending atau Status Rejected");
document.form.harga.focus();
return false;
}
return true;
}
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
	
	<h3 class="judulok">Followup Permintaan Barang</h3>
		';
		date_default_timezone_set('Asia/Jakarta');
		$status=$_POST['status'];
		$id=$_POST['id_barang'];
		$order=$_POST['orderby'];
		$pilihbr="select * from barang where id_barang='$id'";
		$eksbr=mysql_query($pilihbr);
		$databr=mysql_fetch_array($eksbr);

		$noimbr=$databr['noim'];
        if($noimbr=='Kebutuhan Internal'){
        $namapers='Kebutuhan Internal';
                }else{
                $pilihnapers="select * from instal_im where noim='$noimbr'";
                $ekspers=mysql_query($pilihnapers);
                $namapers1=mysql_fetch_array($ekspers);
				$namapers=$namapers1['namapers'];
                }
                
		$jenis=$databr['jenis'];
		$jumlah=$databr['jumlah'];
		$type=$databr['type'];
		$merk=$databr['merk'];
		
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		
		$upstatbr="update instal_im SET tglupinven='$waktu' where noim='$noimbr'";
		$ekstatbr=mysql_query($upstatbr);
		
		$upstatbr2="update internal_memo SET tglupinven='$waktu' where noim='$noimbr'";
		$ekstatbr2=mysql_query($upstatbr2);
		
		$updateinven="update barang set statusin='OK', statuspo='OK', status='$status' where id_barang='$id'";
		$eksinven=mysql_query($updateinven);
		$pilihorder="select * from usr_tb where nama_lengkap='$order'";
		$eksorder=mysql_query($pilihorder);
		$dataorder=mysql_fetch_array($eksorder);
		$to=$dataorder['email'];
		$bagianorder=$dataorder['bagian'];
		$subject = "Order Barang";
		$message = 'Request Barang berupa :'.$jumlah.' buah '.$jenis.' '.$merk.' '.$type.' , untuk : '.$namapers.' . Telah ready stock dan dapat di ambil di bagian inventory';
		$from = "SAPSBP_REQBARANG";
		$headers  = "From:SAPSBP";
		mail($to,$subject,$message,$headers);
		header('Location:assi-inven.php');
		
		echo '
			
	
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>