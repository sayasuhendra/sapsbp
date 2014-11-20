<?php
include "cek-sesion.php";
include "koneksi.php";

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
                <div class="logout">
			<img src="images/logout2.png">
		</div>
	</div>
	<?php
	include "menu.php";
	
	?>
	<div id="isi">
		<h3 class="judulok">Project Search</h3>
		<form method="post" name="formcari" action="prosescari.php">
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>Jenis Project</td>
				<td>:</td>
				<td><select name="project" class="selectform">
						<option value="">-- Pilih Jenis Project --</option>
						<option value="survey">Survey</option>
						<option value="instalasi">Instalasi</option>
						<option value="cabut">Cabut</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Nama Vendor</td>
				<td>:</td>
				<td><input type="text" name="namaven" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Nama Sales</td>
				<td>:</td>
				<td><input type="text" name="namasales" class="selectform">
				</td>
			</tr>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/caribut.png"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>