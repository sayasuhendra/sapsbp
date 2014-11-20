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
<script type='text/javascript' src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
$("#namapers").autocomplete("caripel.php", {
width: 260,
matchContains: true,
//mustMatch: true,
//minChars: 0,
//multiple: true,
//highlight: false,
//multipleSeparator: ",",
selectFirst: false
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
		include "koneksi.php";
		$waktu=date("Ymd");

	if (isset($_GET['noim'])) {
		
		
        $id = $_GET['noim'];
		$pilihcir="select * from instal_im  where noim='$id'";
		$ekscir=mysql_query($pilihcir);
		$datacir=mysql_fetch_array($ekscir);
				
	echo '
		<h3 class="judulok">Form Internal Memo Terminasi  </h3>
		<form method="post" name="formcari" action="prosesimiso.php" enctype="multipart/form-data">
		<table class="tbrule" cellspacing="10px">
		<tr>				
				<td>IM Hardcopy</td>
				<td>:</td>
				<td><input type="file" name="fupload" required></td>
		</tr>
			<tr>				
				<td>Jenis Pekerjaan</td>
				<td>:</td>
				<td><select name="jenpek"  required autofocus>
						<option value="Terminasi">Terminasi
					</select>
				</td>
			</tr>
			
			<tr>				
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td><input type="text" name="namapers" id="namapers" class="selectform" value="'.$datacir['namapers'].'" readonly="true"><input type="hidden" name="area" id="area" class="selectform" value="'.$area.'"><input type="hidden" name="noim" class="selectform" value="'.$datacir['noim'].'">
				</td>
			</tr>
			</tr>
			<tr>				
				<td>CIR ID</td>
				<td>:</td>
				<td><input type="text" name="nopel" class="selectform" id="cirid" value="" required autofocus><input type="hidden" name="nofpb" class="selectform" value="'.$datacir['nofpb'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td><textarea id="alamat" name="alamat" cols="29" rows="5" style="padding:5px;" required autofocus>'.$datacir['alamat'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td>Kontak Person</td>
				<td>:</td>
				<td><input type="text" name="cp" class="selectform" id="cp" value="'.$datacir['cp']. " " . $datacir['telp'].'" required autofocus>
				</td>
			</tr>
			<tr>				
				<td>Tanggal Permintaan</td>
				<td>:</td>
				<td><input type="text" name="tgleks" class="selectform" id="datepicker" required>
				</td>
			</tr>
			<tr>				
				<td>Alasan</td>
				<td>:</td>
				<td><textarea name="alasan" cols="29" rows="5" style="padding:5px;" required autofocus></textarea>
				</td>
			</tr>
			<tr>				
				<td>Bandwidth</td>
				<td>:</td>
				<td><input type="text" name="speed" class="selectform" id="speed" required autofocus value="'.$datacir['akses_speed'].'">
				</td>
			</tr>
			
			<tr>				
				<td valign="top"><input type="hidden" name="tujuan" class="selectform" value="Sales"></td>
				<td valign="top"><input type="hidden" name="status" class="selectform" value="Pending"></td>
				<td></td>
			</tr>
			
			<tr>				
				<td>No Surat Konf</td>
				<td>:</td>
				<td><input type="text" name="nosuratkonf" class="selectform" required autofocus>
				</td>
			</tr>
			<tr>				
				<td>Order By</td>
				<td>:</td>
				<td><input type="text" name="orderby" class="selectform" value="'.$datauser['nama_lengkap'].'" readonly="true">
					<input type="hidden" name="status_im" class="selectform" value="OK">
					<input type="hidden" name="status_tm" class="selectform" value="NOK">
					<input type="hidden" name="status_fin" class="selectform" value="NOK">
					<input type="hidden" name="status_close" class="selectform" value="NOK">
					<input type="hidden" name="status_inven" class="selectform" value="NOK">
					<input type="hidden" name="status_spk" class="selectform" value="NOK">
					<input type="hidden" name="status_term" class="selectform" value="NOK">
				</td>
			</tr>';

	}

	if (!isset($_GET['noim'])) {
	echo '
		<h3 class="judulok">Form Internal Memo Terminasi  </h3>
		<form method="post" name="formcari" action="prosesimiso.php" enctype="multipart/form-data">
		<table class="tbrule" cellspacing="10px">
		<tr>				
				<td>IM Hardcopy</td>
				<td>:</td>
				<td><input type="file" name="fupload" required></td>
		</tr>
			<tr>				
				<td>Jenis Pekerjaan</td>
				<td>:</td>
				<td><select name="jenpek"  required autofocus>
						<option value="Terminasi">Terminasi
					</select>
				</td>
			</tr>
			
			<tr>				
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td><input type="text" name="namapers" id="namapers" class="selectform" value="" readonly="true"><input type="hidden" name="area" id="area" class="selectform" value="'.$area.'"><input type="hidden" name="noim" class="selectform" value="">
				</td>
			</tr>
			</tr>
			<tr>				
				<td>CIR ID</td>
				<td>:</td>
				<td><input type="text" name="nopel" class="selectform" id="cirid" value="" required autofocus><input type="hidden" name="nofpb" class="selectform" value="">
				</td>
			</tr>
			<tr>				
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td><textarea id="alamat" name="alamat" cols="29" rows="5" style="padding:5px;" required autofocus></textarea>
				</td>
			</tr>
			<tr>				
				<td>Kontak Person</td>
				<td>:</td>
				<td><input type="text" name="cp" class="selectform" id="cp" value="" required autofocus>
				</td>
			</tr>
			<tr>				
				<td>Tanggal Permintaan</td>
				<td>:</td>
				<td><input type="text" name="tgleks" class="selectform" id="datepicker" required>
				</td>
			</tr>
			<tr>				
				<td>Alasan</td>
				<td>:</td>
				<td><textarea name="alasan" cols="29" rows="5" style="padding:5px;" required autofocus></textarea>
				</td>
			</tr>
			<tr>				
				<td>Bandwidth</td>
				<td>:</td>
				<td><input type="text" name="speed" class="selectform" id="speed" required autofocus value="">
				</td>
			</tr>
			
			<tr>				
				<td valign="top"><input type="hidden" name="tujuan" class="selectform" value="Sales"></td>
				<td valign="top"><input type="hidden" name="status" class="selectform" value="Pending"></td>
				<td></td>
			</tr>
			
			<tr>				
				<td>No Surat Konf</td>
				<td>:</td>
				<td><input type="text" name="nosuratkonf" class="selectform" required autofocus>
				</td>
			</tr>
			<tr>				
				<td>Order By</td>
				<td>:</td>
				<td><input type="text" name="orderby" class="selectform" value="'.$datauser['nama_lengkap'].'" readonly="true">
					<input type="hidden" name="status_im" class="selectform" value="OK">
					<input type="hidden" name="status_tm" class="selectform" value="NOK">
					<input type="hidden" name="status_fin" class="selectform" value="NOK">
					<input type="hidden" name="status_close" class="selectform" value="NOK">
					<input type="hidden" name="status_inven" class="selectform" value="NOK">
					<input type="hidden" name="status_spk" class="selectform" value="NOK">
					<input type="hidden" name="status_term" class="selectform" value="NOK">
				</td>
			</tr>';

		}

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