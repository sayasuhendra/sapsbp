<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];

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
<script type='text/javascript' src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script>
	Date.format = 'yy-mm-dd';
	$(function() {
	var pickerOpts = {
			dateFormat:"yy-mm-dd"
		};
		$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
			}
		
		);
				
	});

</script>
<script type="text/javascript">
$().ready(function() {
$(".sernum").autocomplete("querybarang.php", {
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

</script>
<script>
var idrow = 2;
Date.format = 'yy-mm-dd';
function tambah(){
		
    var x=document.getElementById('datatable').insertRow(idrow);
    var td1=x.insertCell(0);
    var td2=x.insertCell(1);
	var td3=x.insertCell(2);
	var td4=x.insertCell(3);
	var td5=x.insertCell(4);
	var td6=x.insertCell(5);
	var td7=x.insertCell(6);
	
	td1.innerHTML="<input type='text' name='sernum[]' required placeholder='required' style='width:150px' class='sernum'>";
	td2.innerHTML="<input type='text' name='tglkeluar[]' class='datepicker' required placeholder='yyyy-mm-dd' style='width:90px'>";
	td3.innerHTML="<input type='text' name='jasapengirim[]' required placeholder='required' style='width:120px'>";
	td4.innerHTML="<input type='text' name='pjnoc[]' required placeholder='required' style='width:100px'>";
	td5.innerHTML="<input type='text' name='tujuan[]' required placeholder='required' style='width:120px'>";
	td6.innerHTML="<input type='text' name='keterangan[]' class='selectform' style='width:200px' required='true'>";
	
	var pickerOpts = {
			dateFormat:"yy-mm-dd"
		};
		$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
			}
		
	);
	
$(".sernum").autocomplete("querybarang.php", {
width: 260,
matchContains: true,
//mustMatch: true,
//minChars: 0,
//multiple: true,
//highlight: false,
//multipleSeparator: ",",
selectFirst: false
});			  
		
	idrow++;
	pickerOpts;
		
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
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	
	<?php
	
	$tahun=date('Y');
	
	echo '
	<h3 class="judulok">Form Keluar Barang Tahun '.$tahun.' </h3>
	';
	echo '
	
		<form method="post" name="form" action="prosesexbr.php" onsubmit="return validasi()" enctype="multipart/form-data">
			<table id="datatable" class="tbrule" cellspacing="4px">
			 	<tr>				
				<td class="tdhead" valign="top">Serial Number</td>
				<td class="tdhead" valign="top">Tgl. Keluar</td>
				<td class="tdhead" valign="top">Jasa Pengiriman</td>
				<td class="tdhead" valign="top">PJ NOC</td>
				<td class="tdhead" valign="top">Tujuan Pemakaian</td>
				<td class="tdhead" valign="top">Keterangan</td>
			</tr>
            <tr>			
				
				<td><input type="text" name="sernum[]" required placeholder="required" style="width:150px" class="sernum"></td>
				<td><input type="text" name="tglkeluar[]" class="datepicker" required placeholder="yyyy-mm-dd" style="width:90px"></td>
				<td><input type="text" name="jasapengirim[]" required placeholder="required" style="width:120px"></td>
				<td><input type="text" name="pjnoc[]" required placeholder="required" style="width:100px"></td>
				<td><input type="text" name="tujuan[]" required placeholder="required" style="width:120px"></td>
				<td><input type="text" name="keterangan[]" class="selectform" style="width:200px" required="true"></td>
			</tr>
			<tr>				
				<td colspan="8"><input type="button" value="Tambah" onclick="tambah()">&nbsp;&nbsp;<input type="button" value="Hapus" onclick="hapus()"></td>
			</tr>
		    <tr>				
				<td colspan="8"><input type="image" src="images/cek.png" style="margin-top:2px; float:left"></td>
			</tr>
			</table>
		</form>
	';
	
	
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>