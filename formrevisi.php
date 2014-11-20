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
<script type="text/javascript">
function validasi(){
var alasan=document.form.alasan.value;
if(alasan==""){
alert("Alasan tidak boleh kosong, jika status approve isi dengan OK");
document.form.alasan.focus();
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
	<form method="post" name="form" action="updaterevbr.php" id="form" onsubmit="return validasi()">
		<table class="tbrule" cellspacing="10px">
		<?php
	
	echo '
	
	<h3 class="judulok">Followup Permintaan Barang</h3>
		';
		$id=$_GET['id_barang'];
		$pilihbar="select * from barang where id_barang='$id'";
		$eksbar=mysql_query($pilihbar);
		$databar=mysql_fetch_array($eksbar);
		
			echo '
			<tr>				
				<td>NOIM</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$databar['noim'].'">
				</td>
			</tr>
			
			<tr>				
				<td>Jenis Barang</td>
				<td>:</td>
				<td><input type="text" name="jenis" class="selectform" value="'.$databar['jenis'].'"></td>
			</tr>
			<tr>				
				<td valign="top">Merek barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="merk" class="selectform" value="'.$databar['merk'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Type</td>
				<td valign="top">:</td>
				<td><input type="text" name="type" class="selectform" value="'.$databar['type'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Jumlah Barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="jumlah" class="selectform" value="'.$databar['jumlah'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Vendor</td>
				<td valign="top">:</td>
				<td><input type="text" name="vendor" class="selectform" value="'.$databar['vendor'].'"><input type="hidden" name="id" class="selectform" value="'.$id.'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="29" rows="5" style="padding:5px;">'.$databar['keterangan'].'</textarea>
				</td>
			</tr>
			
			';
			?>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="submit" value="Submit" onclick="validasi()"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>