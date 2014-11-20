<?php
include "cek-sesion.php";
include "koneksi.php";
include "roma.php";
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
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
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
  <script type="text/javascript">
  $(document).ready(function($){
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>
<script type="text/javascript">
				var htmlobjek;
				$(document).ready(function(){
				  $("#namapers").change(function(){
					var namapers = $("#namapers").val();
					$.ajax({
					    url: "cirid.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#cirid").val(msg);
							}
					});
					$.ajax({
					    url: "data-cabut.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#alamat").val(msg);
							}
					});
					$.ajax({
					    url: "datacp.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#cp").val(msg);
							}
					});
					$.ajax({
					    url: "dataspeed.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#speed").val(msg);
							}
					});
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
		include "koneksi.php";
		$waktu=date("Ymd");
		$noim=$_GET['noim'];
		
		$pilihcir="select * from instal_im where noim='$noim'";
		$ekscir=mysql_query($pilihcir);
		$datacir=mysql_fetch_array($ekscir);
				
	echo '
		<h3 class="judulok">Form Approve Isolir / Terminasi</h3>
		<form method="post" name="formcari" action="updateimiso.php">
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>Jenis Pekerjaan</td>
				<td>:</td>
				<td><input type="text" name="jenpek" class="selectform" value="'.$datacir['jenis_pekerjaan'].'" readonly="true">
					<input type="hidden" name="noim" class="selectform" value="'.$datacir['noim'].'" readonly="true">
				</td>
			</tr>
			
			<tr>				
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$datacir['namapers'].'" readonly="true">
				</td>
			</tr>
			
			<tr>				
				<td>Order By</td>
				<td>:</td>
				<td><input type="text" name="orderby" class="selectform" value="'.$datacir['nama_sales'].'" readonly="true">
					<input type="hidden" name="appby" class="selectform" value="'.$datauser['nama_lengkap'].'">
			</td>
			</tr>
			<tr>				
				<td>Status</td>
				<td>:</td>
				<td>
				<select name="status" class="selectform" required>
					<option value="">-- Pilih Status --
					<option value="Approve">Approve
					<option value="Reject">Reject
				</select>
			
				</td>
			</tr>
			
			';
			?>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>