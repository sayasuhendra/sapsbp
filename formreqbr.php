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
	Date.format = 'dd-mm-yy';
	$(function() {
	var pickerOpts = {
			dateFormat:"dd-mm-yy"
		};
		
		$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy'
			}
		
		);
		$( "#datepicker2" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy'
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
$(".namapers").autocomplete("caripel.php", {
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
				  $(".namapers").focus(function(){
					var namapers = $(".namapers").val();
					
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
<script>
var idrow = 2;

function tambah(){
    var x=document.getElementById('datatable').insertRow(idrow);
    var td1=x.insertCell(0);
    var td2=x.insertCell(1);
    var td3=x.insertCell(2);
    var td4=x.insertCell(3);
	var td5=x.insertCell(4);
	var td6=x.insertCell(5);
	var td7=x.insertCell(6);
	var td8=x.insertCell(7);
	var td9=x.insertCell(8);
	var td10=x.insertCell(9);
	var td11=x.insertCell(10);
	var td12=x.insertCell(11);
	var td13=x.insertCell(12);
	var td14=x.insertCell(13);
	var td15=x.insertCell(14);
	var td16=x.insertCell(15);
	var td17=x.insertCell(16);
	td1.innerHTML="<input type='text' name='namapers[]' class='selectform namapers' value='Kebutuhan Internal' required='true'>";
	td2.innerHTML="<input type='text' id='jenis' name='jenis[]' class='selectform' required='true'>";
	td3.innerHTML="<input type='text' name='merk[]' class='selectform' required='true'>";
    td4.innerHTML="<input type='text' name='type[]' class='selectform2' required='true'>";
	td5.innerHTML="<input type='text' name='jumlah[]' class='selectform2' required='true'>";
	td6.innerHTML="<input type='text' name='vendor[]' class='selectform' >";
	td7.innerHTML="<input type='text' name='keterangan[]' class='selectform' >";
	td8.innerHTML="<input type='text' name='rfs[]' class='selectform2 datepicker' placeholder='dd-mm-yyyy' required='true'>";
	td9.innerHTML="<input type='hidden' name='status[]' class='selectform' value='1'>";
	td10.innerHTML="<input type='hidden' name='tujuan[]' class='selectform' value='Manajer'>";
	td11.innerHTML="<input type='hidden' name='bagian[]' class='selectform' value='<?php echo $bagian; ?>'>";
	td12.innerHTML="<input type='hidden' name='statustm[]' class='selectform' value='NOK'>";
	td13.innerHTML="<input type='hidden' name='statusinven[]' class='selectform' value='NOK'>";
	td14.innerHTML="<input type='hidden' name='statusfin[]' class='selectform' value='NOK'>";
	td15.innerHTML="<input type='hidden' name='statuspo[]' class='selectform' value='NOK'>";
	td16.innerHTML="<input type='hidden' name='order[]' class='selectform' value='<?php echo $namauser; ?>'>";
	
	idrow++;
}

function hapus(){
    if(idrow>2){
        var x=document.getElementById('datatable').deleteRow(idrow-1);
        idrow--;
    }
}
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
		<h3 class="judulok">Form Permintaan Barang</h3>
		<form method="post" name="form" action="prosesreqbr.php" onsubmit="return validasi()">
		<table id="datatable" class="tbrule" cellspacing="5px" width="800px">';
		$pilihpers="select * from instal_im";
		$ekspers=mysql_query($pilihpers);
		
		
			echo '
			<tr>				
				<td class="tdhead" valign="top">Untuk Perusahaan</td>
				<td class="tdhead" valign="top">Jenis Barang</td>
				<td class="tdhead" valign="top">Merek barang</td>
				<td class="tdhead" valign="top">Type</td>
				<td class="tdhead" valign="top">Jumlah</td>
				<td class="tdhead" valign="top">Vendor</td>
				<td class="tdhead" valign="top">Keterangan</td>
				<td class="tdhead" valign="top">Tgl RFS</td>
			</tr>
            <tr>			
				
				<td><input type="text" name="namapers[]" class="selectform namapers" value="Kebutuhan Internal" required="true"></td>
				<td><input type="text" id="jenis" name="jenis[]" class="selectform" required="true"></td>
				<td><input type="text" name="merk[]" class="selectform" required="true"></td>
				<td><input type="text" name="type[]" class="selectform2" required="true"></td>
				<td><input type="text" name="jumlah[]" class="selectform2" width="10" required="true"></td>
				<td><input type="text" name="vendor[]" class="selectform" width="10"></td>
				<td><input type="text" name="keterangan[]" class="selectform" width="10"></td>
				<td><input type="text" name="rfs[]" class="selectform2 datepicker" placeholder="dd-mm-yyyy" width="10" required="true"></td>
			</tr>
			
				';
				
			echo '
			<input type="hidden" name="status[]" class="selectform2" value="Pending">';
				if($level=='Staff' || $level=='Engineer'){
				echo '<input type="hidden" name="tujuan[]" class="selectform2" value="Manajer"><input type="hidden" name="bagian[]" class="selectform2" value="'.$bagian.'">
				<input type="hidden" name="statustm[]" class="selectform2" value="NOK">
				<input type="hidden" name="statusinven[]" class="selectform2" value="NOK">
				<input type="hidden" name="statusfin[]" class="selectform2" value="NOK">
				<input type="hidden" name="statuspo[]" class="selectform2" value="NOK">
				<input type="hidden" name="order[]" class="selectform2" value="'.$namauser.'">';
				}else if($level=='Manajer'){
				echo '<input type="hidden" name="tujuan[]" class="selectform2" value="Staff">
				<input type="hidden" name="bagian[]" class="selectform2" value="Inventory">
				<input type="hidden" name="statustm[]" class="selectform2" value="OK">
				<input type="hidden" name="statusinven[]" class="selectform2" value="NOK">
				<input type="hidden" name="statusfin[]" class="selectform2" value="NOK">
				<input type="hidden" name="statuspo[]" class="selectform2" value="NOK">
				<input type="hidden" name="order[]" class="selectform2" value="'.$namauser.'">';
				}
				
			?>
			<tr>				
				<td colspan="7"><input type="button" value="Tambah" onclick="tambah()">&nbsp;&nbsp;<input type="button" value="Hapus" onclick="hapus()"></td>
				
			</tr>
			<tr>				
				
				<td colspan="7"><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>