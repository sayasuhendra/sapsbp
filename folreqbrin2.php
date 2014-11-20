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
<link rel="icon" 
      type="image/png" 
      href="http://example.com/myicon.png">
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
	<form method="post" name="form" action="proreqbrin2.php" id="form" onsubmit="return validasi()" >
	
	
		<table class="tbrule" cellspacing="10px">
	
		<?php
	
	echo '
	
	<h3 class="judulok">Followup Permintaan Barang</h3>	';
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
				<td>Barang</td>
				<td>:</td>
				<td><input type="text" name="barang" class="selectform" value="'.$databar['merk'].' '.$databar['type'].'">
				</td>
			</tr>
			
			<tr>				
				<td valign="top">Status Barang</td>
				<td valign="top">:</td>
				<td><select name="status">
						<option value="">-- Pilih Status --
						<option value="0">Ready Stock
						<option value="1">Reject
						<option value="1">Pending
					</select>
				<input type="hidden" name="id_barang" class="selectform" value="'.$id.'">
                <input type="hidden" name="jenis" class="selectform" value="'.$databar['jenis'].'">
				<input type="hidden" name="orderby" class="selectform" value="'.$databar['orderby'].'">
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