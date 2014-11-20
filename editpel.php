<?php
include "cek-sesion.php";
include "koneksi.php";
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
				
	});

</script>
<script type="text/javascript">

function validasi(){
var namapers=document.form.namapers.value;
if(namapers==""){
alert("Nama Perusahaan Tidak Boleh Kosong !");
document.form.namapers.focus();
return false;
}

var alamat=document.form.alamat.value;
if(alamat==""){
alert("Alamat Tidak Boleh Kosong !");
document.form.alamat.focus();
return false;
}

var cp=document.form.cp.value;
if(cp==""){
alert("Kontak Person Tidak Boleh Kosong !");
document.form.cp.focus();
return false;
}
var telp=document.form.telp.value;
if(telp==""){
alert("No Telepon Tidak Boleh Kosong !");
document.form.telp.focus();
return false;
}
var email=document.form.email.value;
if(email==""){
alert ("Email Tidak Boleh Kosong");
document.form.email.focus();
return false;
}
 str=document.form.email.value;
   filter=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
   if (filter.test(str)!=true)
   {
   alert("Format Penulisan email anda salah, contoh format penulisan email yang benar : ponco@yahoo.com atau kontak@pancaweb.com!");
   document.form.email.focus();
   return false;
  }

var jenko=document.form.jasa.value;
if(jenko==""){
alert("Jenis Koneksi Tidak Boleh Kosong !");
document.form.jasa.focus();
return false;
}
var speed=document.form.speed.value;
if(speed==""){
alert("Speed Tidak Boleh Kosong !");
document.form.speed.focus();
return false;
}
var rfs=document.form.rfs.value;
if(rfs==""){
alert("Tanggal RFS Tidak Boleh Kosong !");
document.form.rfs.focus();
return false;
}
var barang=document.form.barang.value;
if(barang==""){
alert("Silahkan tulis barang yang di butuhkan untuk project ini!");
document.form.barang.focus();
return false;
}
var biayain=document.form.biayain.value;
if(biayain==""){
alert("Biaya Instalasi Harus Diisi!");
document.form.biayain.focus();
return false;
}
var biayabul=document.form.biayabul.value;
if(biayabul==""){
alert("Biaya Bulanan Harus Diisi!");
document.form.biayabul.focus();
return false;
}
return true;
}
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
		$cid=$_GET['cirid'];
		$pilihedit="select * from customer_new where cirid='$cid'";
		$eksedit=mysql_query($pilihedit);
		$edit=mysql_fetch_array($eksedit);
		
	echo '
		<h3 class="judulok">Edit Data Pelanggan SBPnet</h3>
		<form method="post" name="form" action="updatepel.php" onsubmit="return validasi()" enctype="multipart/form-data">
		<table class="tbrule" cellspacing="10px">
			
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$edit['nama_perusahaan'].'"><input type="hidden" name="area" class="selectform" value='.$area.'>
				</td>
			</tr>
			<tr>				
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td><textarea name="alamat" cols="29" rows="5" style="padding:5px;">'.$edit['alamat_perusahaan'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td>Kontak Person</td>
				<td>:</td>
				<td><input type="text" name="cp" class="selectform" value="'.$edit['cp_finance'].'/'.$edit['cp_teknis'].'">
				</td>
			</tr>
			
			<tr>				
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" class="selectform" value="'.$edit['email'].'" placeholder="ex:ponco@sbp.net.id" required autofocus>
				</td>
			</tr>
			<tr>				
				<td>Services</td>
				<td>:</td>
				<td>
					<select name="services">';
					if($edit['des_layanan']==""){
					echo '<option value="">-- Pilih Layanan --';
					}else{
					echo '<option value="'.$edit['des_layanan'].'">'.$edit['des_layanan'];
					}
					echo '	
						<option value="Internet Dedicated">Internet Dedicated
						<option value="Internet braodband">Internet braodband
                                                <option value="ADSL">ADSL
						<option value="L2">L2
                                                <option value="Local Loop">Local Loop
						<option value="Colocation">Colocation
						<option value="Hosting">Hosting
						<option value="IP Transit">IP Transit
					</select>
				</td>
			
			</tr>
				
			<tr>				
				<td>Bandwitdh</td>
				<td>:</td>
				<td><input type="text" name="speed" class="selectform" value="'.$edit['bandwidth_client'].'">
				</td>
			</tr>
			<tr>				
				<td>Nama Vendor</td>
				<td>:</td>
				<td><input type="text" name="vendor" class="selectform" value="'.$edit['nama_vendor'].'">
				</td>
			</tr>
			<tr>				
				<td>URL Smokeping</td>
				<td>:</td>
				<td><input type="text" name="smokeping" class="selectform" value="'.$edit['url_smokeping'].'">
				</td>
			</tr>
			<tr>				
				<td>URL Cacti</td>
				<td>:</td>
				<td><input type="text" name="cacti" class="selectform" value="'.$edit['url_cacti'].'">
				</td>
			</tr>
			
			<tr>				
				<td>Tgl. Start Service</td>
				<td>:</td>
				<td><input type="text" name="rfs" class="selectform" id="datepicker" value="'.$edit['register_date'].'">
				</td>
			</tr>
			<tr>				
				<td>IP Public</td>
				<td>:</td>
				<td><input type="text" name="ippublic" class="selectform" id="datepicker" value="'.$edit['ippublic'].'">
				</td>
			</tr>
			<tr>				
				<td>IP LAN</td>
				<td>:</td>
				<td><input type="text" name="iplan" class="selectform" id="datepicker" value="'.$edit['iplan'].'"></td>
			</tr>
			<tr>
				<td valign="top" class="text-contact">Topologi </td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="text" name="etop" class="selectform" id="datepicker" value="'.$edit['file_topologi'].'"><input type="file" name="topologi" placeholder="Required"><span style="color:red; font-size;9px;">* Klik Browse Untuk Edit File Topologi</span></td>
			</tr>
			
			<tr>
				<td valign="top" class="text-contact">Capture Speedtest</td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="text" name="espeed" class="selectform" value="'.$edit['file_speed'].'"><input type="file" name="speed" placeholder="Required"><span style="color:red; font-size;9px;">* Klik Browse Untuk Edit File Capture Speedtest</span></td>
			</tr>
			
			<tr>
				<td valign="top" class="text-contact">Foto Lokasi</td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="text" name="efot" class="selectform" id="datepicker" value="'.$edit['file_foto'].'"><input type="file" name="foto" placeholder="Required"><span style="color:red; font-size;9px;">* Klik Browse Untuk Edit File Foto</span></td>
			</tr>
						
			<tr>				
				<td>Nama Sales</td>
				<td>:</td>
				<td><input type="text" name="namasales" class="selectform" value="'.$edit['marketing'].'" readonly="true">
					<input type="hidden" name="cirid" class="selectform" value="'.$cid.'" readonly="true">
				
				</td>
			</tr>';
			?>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png" style="margin-top:2px; float:left"><input style="margin-top:3px; margin-left:5px; float:left" type="reset" value="Cancel"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>