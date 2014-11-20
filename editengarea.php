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
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	<?php
		$noim=$_GET['noim'];
		$pilihim="select * from instal_im where noim='$noim'";
		$eksim=mysql_query($pilihim);
		$dataim=mysql_fetch_array($eksim);
		
	echo '
		<h3 class="judulok">Penunjukan Engineer Area Untuk Client <span style="color:red">'.$dataim['namapers'].'</span></h3>
		<form method="post" name="formcari" action="updateim.php">
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td valign="top">Engineer Area</td>
				<td valign="top">:</td>
				<td valign="top">
					<select name="tujuan" required>
						<option value="">-- Pilih Area --</option>
                        <option value="Global">Global</option>
						<option value="Jakarta">Jakarta</option>
						<option value="Batam">Batam</option>
						<option value="TPI">TPI</option>
						<option value="TBK">TBK</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>No IM</td>
				<td>:</td>
				<td><input type="text" name="noim" class="selectform" value="'.$dataim['noim'].'"></td>
			</tr>
			<tr>				
				<td>No FPB</td>
				<td>:</td>
				<td><input type="text" name="nofpb" class="selectform" value="'.$dataim['nofpb'].'"></td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$dataim['namapers'].'">
				</td>
			</tr>
			<tr>				
				<td>Jenis Jasa</td>
				<td>:</td>
				<td><input type="text" name="jasa" class="selectform" value="'.$dataim['jasa'].'">
				</td>
			</tr>
			<tr>				
				<td>Speed</td>
				<td>:</td>
				<td><input type="text" name="speed" class="selectform" value="'.$dataim['akses_speed'].'">
				</td>
			</tr>
			<tr>				
				<td>Tgl. Ready For Service</td>
				<td>:</td>
				<td><input type="text" name="rfs" class="selectform" value="'.$dataim['tglrfs'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="29" rows="5" style="padding:5px;">'.$dataim['keterangan'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td>Jenis Pekerjaan</td>
				<td>:</td>
				<td><input type="text" name="jenpek" class="selectform" value="'.$dataim['jenis_pekerjaan'].'" readonly="true">
				</td>
			</tr>
			<tr>				
				<td valign="top">
				<input type="hidden" name="namasales" class="selectform" value="'.$dataim['nama_sales'].'">
				<input type="hidden" name="alamat" class="selectform" value="'.$dataim['alamat'].'">
				<input type="hidden" name="cp" class="selectform" value="'.$dataim['cp'].'">
				<input type="hidden" name="telp" class="selectform" value="'.$dataim['telp'].'">
				<input type="hidden" name="email" class="selectform" value="'.$dataim['email'].'">
				<input type="hidden" name="idimin" class="selectform" value="'.$dataim['id_imin'].'">
				<input type="hidden" name="status_im" class="selectform" value="OK">
				<input type="hidden" name="status_fin" class="selectform" value="NOK">
				<input type="hidden" name="status_close" class="selectform" value="NOK">
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