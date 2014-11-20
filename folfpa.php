<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$bagian=$_SESSION['bagian'];
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
		function validasi(){
		if (!document.form.pok.checked){
		alert ("Pengajuan PO harus sudah di proses, dan di ceklist");
		document.form.pok.focus();
		return false;
		}
		
		}
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
<script>
	Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"d MM yy"
		};
		
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
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	<h3 class="judulok">Followup Form Penggunaan Akses Pihak Ketiga</h3>
	<form method="post" name="form" action="updatefpa.php" id="form" onsubmit="return validasi()" enctype="multipart/form-data">
	<?php
	
	echo '
		
		<table class="tbrule" cellspacing="10px">';
		$idfpa=$_GET['idfpa'];
		$waktu=date('d-F-Y');
		$pilihfpa="select * from fpa_tb where idfpa='$idfpa'";
		$eksfpa=mysql_query($pilihfpa);
		$datafpa=mysql_fetch_array($eksfpa);
		
			echo '
			<tr>				
				<td>No FPA</td>
				<td>:</td>
				<td><input type="text" readonly="true" name="nofpa" class="selectform" value="'.$datafpa['nofpa'].'"></td>
			</tr>
			<tr>				
				<td>No IM</td>
				<td>:</td>
				<td><input type="text" readonly="true" name="noim" class="selectform" value="'.$datafpa['noim'].'"></td>
			</tr>
			<tr>				
				<td>Akses Usage</td>
				<td>:</td>
				<td><select name="aksus" class="selectform">
						<option value="'.$datafpa['akses_usage'].'">'.$datafpa['akses_usage'].'</option>
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
				<td><select name="akstat" class="selectform">
						<option value="'.$datafpa['akses_status'].'">'.$datafpa['akses_status'].'</option>
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
				<td><input type="text" name="speed" class="selectform" value="'.$datafpa['akses_speed'].'"></td>
			</tr>
			<tr>				
				<td valign="top">Asal</td>
				<td valign="top">:</td>
				<td><textarea name="asal" cols="29" rows="5" style="padding:5px;" >'.$datafpa['asal'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Tujuan</td>
				<td valign="top">:</td>
				<td><textarea name="tujuan" cols="29" rows="5" style="padding:5px;" >'.$datafpa['tujuan'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td>Akses Type</td>
				<td>:</td>
				<td><select name="type" class="selectform">
						<option value="'.$datafpa['akses_type'].'">'.$datafpa['akses_type'].'</option>
						<option value="PCM">PCM</option>
						<option value="LC-HDSL 4 Pair">LC-HDSL 4 Pair</option>
						<option value="UTP CAT 5E">UTP CAT 5e</option>
						<option value="UTP CAT 6">UTP CAT 6</option>
						<option value="VSAT">VSAT</option>
						<option value="Fiber Optic">Fiber Optic</option>
						<option value="Wireless">Wireless</option>
						<option value="Radio Link">Radio Link</option>
					</select>
				</td>
			</tr>
			
			<tr>				
				<td>Akses Provider</td>
				<td>:</td>
				<td><select name="provider" class="selectform">
						<option value="'.$datafpa['akses_pro'].'">'.$datafpa['akses_pro'].'</option>
						<option value="BIZNET">BIZNET</option>
						<option value="INDOSAT">INDOSAT</option>
						<option value="TELKOM CISC">TELKOM CISC</option>
						<option value="LINTASARTA">LINTASARTA</option>
						<option value="DATAFRAME/CITINET">DATAFRAME/CITINET</option>
						<option value="INTERLINK">INTERLINK</option>
						<option value="FMI">FMI</option>
						<option value="DATAUTAMA">DATAUTAMA</option>
						<option value="SBP">SBP</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$datafpa['namapers'].'" readonly="true">
				</td>
			</tr>
			<tr>				
				<td valign="top">Kebutuhan Perangkat</td>
				<td valign="top">:</td>
				<td><textarea name="perangkat" cols="29" rows="5" style="padding:5px;">'.$datafpa['perangkat'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Penjelasan Kebutuhan</td>
				<td valign="top">:</td>
				<td><textarea name="penjelasan" cols="29" rows="5" style="padding:5px;">'.$datafpa['penjelasan'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td>Target Operasional</td>
				<td>:</td>
				<td><input type="text" name="target" id="datepicker2" class="selectform" value="'.$datafpa['target'].'">
				</td>
			</tr>
			
			<tr>				
				<td>Tanggal Terima IM</td>
				<td>:</td>
				<td><input type="text" name="tglim" id="datepicker" class="selectform" value="'.$datafpa['tglim'].'"><input type="hidden" name="namauser" class="selectform" value="'.$namauser.'"><input type="hidden" name="idfpa" class="selectform" value="'.$idfpa.'">
				</td>
			</tr>
			<tr>				
				<td>Order By</td>
				<td>:</td>
				<td><input type="text" name="orderby" class="selectform" value="'.$datafpa['orderby'].'">
				</td>
			</tr>
			';
			if($bagian=="Finance"){
			echo '
			<tr>				
				<td>Status</td>
				<td>:</td>
				<td><select name="status" class="selectform" required>
						<option value="">- Pilih Status --</option>
						<option value="Approve">Approve</option>
						<option value="Pending">Pending</option>
						<option value="BOD Approval">BOD Approval</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td></td>
				<td><input type="hidden" name="statustm" value="OK"></td>
				<td><input type="checkbox" name="pok" id="pok" value="OK">&nbsp;Pengajuan PO</td>
			</tr>
			<tr>
				<td valign="top" class="text-contact">Upload PO <span style="color:red; font-size;9px;">*</span></td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="file" name="fupload" required placeholder="Required"><input type="hidden" name="namalengkap" value="'.$namauser.'"></td>
			</tr>
			';}
			else if($bagian=='AP'){
			echo '
			<tr>				
				<td>Status</td>
				<td>:</td>
				<td><select name="status" class="selectform">
						<option value="'.$datafpa['status'].'">'.$datafpa['status'].'</option>
						<option value="Approve">Approve</option>
						<option value="Pending">Pending</option>
						<option value="BOD Approval">BOD Approval</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td></td>
				<td><input type="hidden" name="statustm" value="OK"></td>
				<td><input type="checkbox" name="pok" id="pok" value="OK">&nbsp;Pengajuan PO</td>
			</tr>
			<tr>
				<td valign="top" class="text-contact">Upload PO <span style="color:red; font-size;9px;">*</span></td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="file" name="fupload" required placeholder="Required"><input type="hidden" name="namalengkap" value="'.$namauser.'"></td>
			</tr>
			';}

			else{
			echo '
			<tr>				
				<td>Status</td>
				<td>:</td>
				<td>
					<select name="statustm" class="selectform" required>
						<option value="">-- Pilih Status --</option>
						<option value="OK">Approve</option>
					</select>
				</td>
			</tr>
			
			
			<tr>				
				<td></td>
				<td></td>
				<td><input type="hidden" name="status" value="Pending"></td>
			</tr>';
			
			}
			
			
			
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