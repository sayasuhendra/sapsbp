<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$level=$_SESSION['level'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
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
	<div id="isi">
	<?php
		$noim=$_GET['noim'];
		$pilihim="select * from instal_im where noim='$noim'";
		$eksim=mysql_query($pilihim);
		$dataim=mysql_fetch_array($eksim);
		
		
	echo'
		<h3 class="judulok">Penunjukan Pelasksana Survey Untuk Pelanggan '.$dataim['namapers'].'</h3>
		<form method="post" name="formfpa" action="prosestunjuksur.php">
		<table class="tbrule" cellspacing="10px">
		<table>	
			<tr>				
				<td>No IM</td>
				<td></td>
				<td><input type="text" readonly="true" name="noim" class="selectform" value="'.$noim.'"><input type="hidden" name="nofpb" class="selectform" value="'.$dataim['nofpb'].'"></td>
			</tr>
			
			<tr>				
				<td>Pilih Pelaksana</td>
				<td></td>
				<td>
					<select name="pelaksana" required>
						<option value="">-- Pilih Pelaksana --';
					$pilihsup="select * from usr_tb where bagian='Teknikal'";
					$eksup=mysql_query($pilihsup);
					while($sup=mysql_fetch_array($eksup)){
					echo '<option value="'.$sup['nama_lengkap'].'">'.$sup['nama_lengkap'];
					}
					echo '
					</select>
				</td>
			</tr>
					
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
			
		</table>
		</form>
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>