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
	<?php
	$noim=$_GET['noim'];
	$pilihpel="select * from instal_im where noim='$noim'";
	$ekspel=mysql_query($pilihpel);
	$pel=mysql_fetch_array($ekspel);
	$client=$pel['namapers'];
	echo '
	<div id="isi">
		<h3 class="judulok">Form Report / Upload BAO Terminasi</h3>
		<form method="post" action="prosesupterm.php" enctype="multipart/form-data" class="form-kontak">
		 <table class="tbrule" cellspacing="10px">
			<tr>
				<td valign="top" class="text-contact">Browse SPK <span style="color:red; font-size;9px;">*</span></td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="file" name="fupload" required placeholder="Required"><input type="hidden" name="namalengkap" value="'.$namauser.'"></td>
			</tr>
			<tr>
			    <td></td>
				<td></td>
				<td valign="top" class="text-contact"><input type="checkbox" name="pok" id="pok" value="OK" required>&nbsp;Barang Sudah Diambil / Tidak ada barang di pelanggan</td>
				
			</tr>
					
			<tr>				
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td><input type="text" name="pelanggan" id="pok" value="'.$client.'" style="border:none"><input type="hidden" name="noim" value="'.$noim.'"></td>
			</tr>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>
	</div>';
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>