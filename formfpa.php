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
		<h3 class="judulok">Form Penggunaan Akses Pihak Ketiga</h3>
		<form method="post" name="formfpa" action="prosesfpa.php">
		<table class="tbrule" cellspacing="10px">';
		
		
		$noim=$_GET['noim'];
		$pilihpers="select * from instal_im where noim='$noim'";
		$ekspers=mysql_query($pilihpers);
		$datapers=mysql_fetch_array($ekspers);
		
			echo '
			
			<tr>				
				<td>No IM</td>
				<td>:</td>
				<td><input type="text" readonly="true" name="noim" class="selectform" value="'.$noim.'"></td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" readonly="true" name="namapers" class="selectform" value="'.$datapers['namapers'].'"></td>
			</tr>
			<tr>				
				<td>Akses Usage</td>
				<td>:</td>
				<td><select name="aksus" class="selectform" required>
						<option value="">-- Pemakain Trunk Untuk --</option>
						<option value="Backbone Trunk Local">BackBone / Trunk Local</option>
						<option value="Backbone Intercity">Backbone Intercity</option>
						<option value="Backbone Internasional">Backbone Internasional</option>
						<option value="Corporate Customer Backhaul">Corporate Customer Backhaul</option>
						<option value="Corporate Customer Access">Corporate Customer Access</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Akses Status</td>
				<td>:</td>
				<td><select name="akstat" class="selectform" required>
						<option value="">-- Pilih Status --</option>
						<option value="Other">Other</option>
						<option value="Temporer">Temporer</option>
						<option value="PSB">PSB</option>
						<option value="Cabut">Cabut</option>
						<option value="Mutasi">Mutasi</option>
						<option value="Ujicoba">Ujicoba</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Akses Speed</td>
				<td>:</td>
				<td><input type="text" name="speed" class="selectform" value="'.$datapers['akses_speed'].'" required></td>
			</tr>
			<tr>				
				<td valign="top">Asal</td>
				<td valign="top">:</td>
				<td><textarea name="asal" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Tujuan</td>
				<td valign="top">:</td>
				<td><textarea name="tujuan" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td>Akses Type</td>
				<td>:</td>
				<td><select name="type" class="selectform" required>
						<option value="">-- Pilih Type Akses --</option>
	                    <option value="ADSL">ADSL</option>
	                    <option value="Cooper Wire">Cooper Wire</option>
						<option value="PCM">PCM</option>
						<option value="LC-HDSL 4 Pair">LC-HDSL 4 Pair</option>
						<option value="UTP CAT 5E">UTP CAT 5e</option>
						<option value="UTP CAT 6">UTP CAT 6</option>
						<option value="VSAT">VSAT</option>
						<option value="Fiber Optic">Fiber Optic</option>
						<option value="Wireless">Wireless</option>
						<option value="Radio Link">Radio Link</option>
						<option value="VPN IP">VPN IP</option>
						<option value="Other">Other</option>
					</select>
				</td>
			</tr>
			
			<tr>				
				<td>Akses Provider</td>
				<td>:</td>
				<td><select name="provider" class="selectform" required><option value="">-- Pilih Akses Provider --</option>';
                                $pilihven="select * from vendor_tb";
                                $eksven=mysql_query($pilihven);  
                                while($vendor=mysql_fetch_array($eksven)){
                                echo '<option value="'.$vendor['nama_vendor'].'">'.$vendor['nama_vendor'].'</option>';
                                }
                                 echo '						
					</select>
				</td>
			</tr>
		    <tr>				
				<td valign="top">Kebutuhan Perangkat</td>
				<td valign="top">:</td>
				<td><textarea name="perangkat" cols="29" rows="5" style="padding:5px;">'.$datapers['barang'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Penjelasan Kebutuhan</td>
				<td valign="top">:</td>
				<td><textarea name="penjelasan" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td>Target Operasional</td>
				<td>:</td>
				<td><input type="text" name="target" readonly="true" class="selectform" value="'.$datapers['tglrfs'].'" required>
				</td>
			</tr>
			<tr>				
				<td>Tanggal Terima IM</td>
				<td>:</td>
				<td><input type="text" name="tglim" readonly="true" class="selectform" value="'.$datapers['tglim'].'"><input type="hidden" name="namauser" class="selectform" value="'.$namauser.'"><input type="hidden" name="status" class="selectform" value="Pending">
				</td>
			</tr>';
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