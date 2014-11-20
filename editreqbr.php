<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$bagian=$_SESSION['bagian'];
$level=$_SESSION['level'];
$id=$_GET['id_barang'];
$pilihrb="select * from barang where id_barang='$id'";
$eksrb=mysql_query($pilihrb);
$rb=mysql_fetch_array($eksrb);
$noimbr=$rb['noim'];
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
<script type="text/javascript">

function validasi(){
var namapers=document.form.namapers.value;
if(namapers==""){
alert("Anda Belum Memilih Nama Perusahaan !");
document.form.namapers.focus();
return false;
}

var jenis=document.form.jenis.value;
if(jenis==""){
alert("Jenis Barang Harus Di isi");
document.form.jenis.focus();
return false;
}

var merk=document.form.merk.value;
if(merk==""){
alert("Merek Harus Di Isi !");
document.form.merk.focus();
return false;
}
var jumlah=document.form.jumlah.value;
if(jumlah==""){
alert("Jumlah Barang Harus Di Isi !");
document.form.jumlah.focus();
return false;
}


var keterangan=document.form.keterangan.value;
if(keterangan==""){
alert ("Silahkan Isi Keterangan Terlebih Dahulu");
document.form.keterangan.focus();
return false;
}
return true;
}
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
<script type="text/javascript">
				var htmlobjek;
				$(document).ready(function(){
				  $("#namapers").focus(function(){
					var namapers = $("#namapers").val();
					
					$.ajax({
					    url: "data-cabut.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#alamat").val(msg);
							}
					});
					$.ajax({
					    url: "datacp.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#telp").val(msg);
							}
					});
					$.ajax({
					    url: "dataspeed.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#speed").val(msg);
							}
					});
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
	
	echo '
		<h3 class="judulok">Form Edit Permintaan Barang</h3>
		<form method="post" name="form" action="upreqedit.php" onsubmit="return validasi()">
		<table class="tbrule" cellspacing="10px">';
		$pilihpers="select * from instal_im";
		$ekspers=mysql_query($pilihpers);
		$pilihpersrb="select * from instal_im where noim='$noimbr'";
		$ekspersrb=mysql_query($pilihpersrb);
		$persrb=mysql_fetch_array($ekspersrb);
		if($noimbr=='Kebutuhan Internal'){
		echo '
		<tr>				
				<td>Untuk Perusahaan</td>
				<td>:</td>
				<td><input type="text" id="namapers" name="namapers" class="selectform" value="'.$noimbr.'">
				</td>
			</tr>
		';
		}else{
		echo '	<tr>				
				<td>Untuk Perusahaan</td>
				<td>:</td>
				<td><input type="text" id="namapers" name="namapers" class="selectform" value="'.$persrb['namapers'].'">
				</td>
			</tr>';
		}
		
		
			echo '
					
			
			<tr>				
				<td>Jenis Barang</td>
				<td>:</td>
				<td><input type="text" name="jenis" class="selectform" value="'.$rb['jenis'].'"></td>
			</tr>
			<tr>				
				<td valign="top">Merek barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="merk" class="selectform" value="'.$rb['merk'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Type</td>
				<td valign="top">:</td>
				<td><input type="text" name="type" class="selectform" value="'.$rb['type'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Jumlah Barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="jumlah" class="selectform" width="10" value="'.$rb['jumlah'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Vendor</td>
				<td valign="top">:</td>
				<td><input type="text" name="vendor" class="selectform" width="10" value="'.$rb['vendor'].'"><input type="hidden" name="id_barang" class="selectform" value="'.$id.'">
				</td>
			</tr>';
			
			if($bagian=='Inventory'){
			echo '<tr>				
				<td valign="top">Harga Barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="harga" class="selectform" value="Rp '.number_format($rb['harga_barang'],0,",",".").'"><span style="font-size:11px;">&nbsp;* Jangan menggunakan titik atau koma dalam penulisan harga</span>
				</td>
			</tr>';
			}
			echo '
			
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="29" rows="5" style="padding:5px;">
				'.$rb['keterangan'].'
				</textarea><input type="hidden" name="status" class="selectform" value="Pending">';
				if($level=='Staff' || $level=='Engineer'){
				echo '<input type="hidden" name="tujuan" class="selectform" value="Manajer"><input type="hidden" name="bagian" class="selectform" value="'.$bagian.'">
				<input type="hidden" name="statustm" class="selectform" value="NOK">
				<input type="hidden" name="statusinven" class="selectform" value="NOK">
				<input type="hidden" name="statusfin" class="selectform" value="NOK">
				<input type="hidden" name="statuspo" class="selectform" value="NOK">
				<input type="hidden" name="order" class="selectform" value="'.$namauser.'">';
				}else if($level=='Manajer'){
				echo '<input type="hidden" name="tujuan" class="selectform" value="Staff">
				<input type="hidden" name="bagian" class="selectform" value="Inventory">
				<input type="hidden" name="statustm" class="selectform" value="OK">
				<input type="hidden" name="statusinven" class="selectform" value="NOK">
				<input type="hidden" name="statusfin" class="selectform" value="NOK">
				<input type="hidden" name="statuspo" class="selectform" value="NOK">
				<input type="hidden" name="order" class="selectform" value="'.$namauser.'">';
				}
				echo '
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