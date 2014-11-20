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
		$cid=$_POST['cirid'];
		$pilihedit="select * from customer_new where cirid='$cid'";
		$eksedit=mysql_query($pilihedit);
		$edit=mysql_fetch_array($eksedit);
		
	echo '
		<h3 class="judulok">Edit Data Pelanggan SBPnet</h3>
		<form method="post" name="form" action="updatepel.php" onsubmit="return validasi()" enctype="multipart/form-data">
		<table class="tbrule" cellspacing="10px">';
		
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$email=$_POST['email'];
		$services=$_POST['services'];
		$speed=$_POST['speed'];
		$vendor=$_POST['vendor'];
		$smokeping=$_POST['smokeping'];
		$cacti=$_POST['cacti'];
		$rfs=$_POST['rfs'];
		$ippublic=$_POST['ippublic'];
		$iplan=$_POST['iplan'];
		$etop=$_POST['etop'];
		$espeed=$_POST['espeed'];
		$efoto=$_POST['efot'];
		$lokasi_file2=$_FILES['topologi']['tmp_name'];
		$tipe_file2=$_FILES['topologi']['type'];
		$nama_file2=$_FILES['topologi']['name'];
		$lokasi_file3=$_FILES['speed']['tmp_name'];
		$tipe_file3=$_FILES['speed']['type'];
		$nama_file3=$_FILES['speed']['name'];
		$lokasi_file4=$_FILES['foto']['tmp_name'];
		$tipe_file4=$_FILES['foto']['type'];
		$nama_file4=$_FILES['foto']['name'];
		$sales=$_POST['namasales'];
		$cirid=$_POST['cirid'];
		
		
		if($lokasi_file2=="" && $lokasi_file3=="" && $lokasi_file4==""){
		$updatepel="update customer_new SET nama_perusahaan='$namapers', alamat_perusahaan='$alamat', cp_teknis='$cp', email='$email', des_layanan='$services',	bandwidth_client='$speed', nama_vendor='$vendor', url_smokeping='$smokeping', url_cacti='$cacti', ippublic='$ippublic', ip_lan='$iplan', marketing='$sales' where cirid='$cirid'";
		$eksekusiup=mysql_query($updatepel);
		
		echo 'Terimakasih, data pelanggan sudah berhasil di ubah';
		}else{
		$move2 = move_uploaded_file($lokasi_file2,'topologi/'.$nama_file2);  
		$move3 = move_uploaded_file($lokasi_file3,'speedtest/'.$nama_file3);  
		$move4 = move_uploaded_file($lokasi_file4,'foto/'.$nama_file4);  
		if($move2 && $move3){
		$updatepel="update customer_new SET file_topologi='$nama_file2', file_speed='$nama_file3', file_foto='$nama_file4', nama_perusahaan='$namapers', alamat_perusahaan='$alamat', cp_teknis='$cp', email='$email', des_layanan='$services',	bandwidth_client='$speed', nama_vendor='$vendor', url_smokeping='$smokeping', url_cacti='$cacti', ippublic='$ippublic', ip_lan='$iplan', marketing='$sales' where cirid='$cirid'";
		$eksekusiup=mysql_query($updatepel);
		echo 'Terimakasih, data pelanggan sudah berhasil di ubah';
		}
		else{echo "Maaf, Gagal Mengupload file !";}
		
		}
		
		echo '
		</form>
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>