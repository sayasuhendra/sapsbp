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
	
	<?php
        include "header.php";
	include "menu.php";
	$id=$_GET['usrid'];
	$useredit="select * from usr_tb where usrid='$id'";
	$eksedit=mysql_query($useredit);
	$edituser=mysql_fetch_array($eksedit);
	$pass=md5($edituser['password']);
	?>
	<div id="isi">
		<h3 class="judulok">Form Management User SAPSBP</h3>
		<form method="post" name="formum" action="updateum.php">
		<table class="tbrule" cellspacing="10px">
		<?php
		echo '
			<tr>				
				<td>username</td>
				<td>:</td>
				<td><input type="text" name="username" class="selectform" value="'.$edituser['username'].'"></td>
			</tr>
			
			<tr>				
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><input type="text" name="nama" class="selectform" value="'.$edituser['nama_lengkap'].'">
				</td>
			</tr>
			<tr>				
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" class="selectform" value="'.$edituser['email'].'">
				</td>
			</tr>
			<tr>				
				<td>Area</td>
				<td>:</td>
				<td>
					<select name="area" class="selectform">
						<option value="'.$edituser['area'].'">'.$edituser['area'].'</option>
						<option value="Jakarta">Jakarta</option>
						<option value="BTM">Batam</option>
						<option value="TPI">TPI</option>
						<option value="TBK">TBK</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Level</td>
				<td>:</td>
				<td>
					<select name="level" class="selectform">
					<option value="'.$edituser['level'].'">'.$edituser['level'].'</option>
						<option value="Staff">Staff</option>
                        <option value="Condev">Condev</option>
						<option value="Engineer">Engineer</option>
						<option value="Manajer">Manajer</option>
						<option value="BOD">BOD</option>
						<option value="Super Admin">Super Admin</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Bagian</td>
				<td>:</td>
				<td>
					<select name="bagian" class="selectform">
						<option value="">-- Pilih Bagian --</option>
						<option value="'.$edituser['bagian'].'">'.$edituser['bagian'].'</option>
						<option value="Inventory">Inventory</option>
						<option value="Teknikal">Teknikal</option>
						<option value="Sales">Sales</option>
						<option value="AR">AR</option>
						<option value="AP">AP</option>
						<option value="Finance">Finance</option>
						<option value="GA">GA</option>
						<option value="DCO">DCO</option>
						<option value="Umum">Umum</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="hidden" name="usrid" value="'.$edituser['usrid'].'"><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>';
		
		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>