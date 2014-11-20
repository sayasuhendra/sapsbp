<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$area=$datauser['area'];
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
				var htmlobjek;
				$(document).ready(function(){
				  $("#namapers").focus(function(){
					var namapers = $("#namapers").val();
					$.ajax({
					    url: "cirid.php",
						data: "namapers="+namapers,
						cache: false,
						success: function(msg){
							$("#cirid").val(msg);
							}
					});
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
							$("#cp").val(msg);
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
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	    include "menu.php";
	   	
					
	echo '
	<div id="isi">
		<h3 class="judulok">Form Upload FPC</h3>
		<form method="post" action="prosesupfpc.php" enctype="multipart/form-data" class="form-kontak">
		 <table class="tbrule" cellspacing="10px">
					
			<tr>				
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td><input type="text" name="namapers" id="namapers" class="selectform" required><input type="hidden" name="area" value="'.$area.'">
				
				</td>
			</tr>
			<tr>				
				<td>Jenis Pekerjaan <span style="color:red; font-size;9px;">*</span></td>
				<td>:</td>
				<td><input type="text" name="jenpek" class="selectform" value="Terminasi" readonly="true">
				</td>
			</tr>
					
			<tr>				
				<td>Akses Provider <span style="color:red; font-size;9px;">*</span></td>
				<td>:</td>
				<td><select name="provider" class="selectform">
						<option value="-">-- Pilih Akses Provider --</option>';
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
				<td>Target Tanggal Cabut</td>
				<td>:</td>
				<td><input type="text" name="rfs" class="selectform" id="datepicker">
				</td>
			</tr>
			<tr>				
				<td valign="top">Alasan <span style="color:red; font-size;9px;">*</span></td>
				<td valign="top">:</td>
				<td><textarea name="penjelasan" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			
			<tr>
				<td valign="top" class="text-contact">Browse FPC <span style="color:red; font-size;9px;">*</span></td>
				<td valign="top" class="text-contact">:</td>
		        <td valign="top" class="text-contact"><input type="file" name="fupload" required placeholder="Required">
				<input type="hidden" name="namalengkap" value="'.$namauser.'"></td>
			</tr>
			
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
			
		</table>
		</form>
	</div>';
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>