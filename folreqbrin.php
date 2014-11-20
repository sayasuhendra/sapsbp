<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$level=$_SESSION['level'];
$bagian=$_SESSION['bagian'];
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
var harga=document.form.harga.value;
if(harga==""){
alert("Harga Tidak Boleh Kosong, Isi 0 Jika Tidak Mengetahui Harga, Status Pending atau Status Rejected");
document.form.harga.focus();
return false;
}
return true;
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
	
	echo '
	<div id="isi">';
	if($level=='Staff' && $bagian=='Inventory'){echo '<form method="post" name="form" action="updatereqbrin.php" id="form" onsubmit="return validasi()">';}
	elseif($level=='Manajer' && $bagian=='Finance'){echo '<form method="post" name="form" action="updatereqbrfin.php" id="form" onsubmit="return validasi()">';}
	echo '
		<table class="tbrule" cellspacing="10px">';
	?>
		<?php
	
	echo '
	
	<h3 class="judulok">Followup Permintaan Barang</h3>
		';
		$id=$_GET['id_barang'];
		$pilihbar="select * from barang where id_barang='$id'";
		$eksbar=mysql_query($pilihbar);
		$databar=mysql_fetch_array($eksbar);
		
			echo '
			<tr>				
				<td>NOIM</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform" value="'.$databar['noim'].'">
				</td>
			</tr>
			
			<tr>				
				<td>Jenis Barang</td>
				<td>:</td>
				<td><input type="text" name="jenis" class="selectform" value="'.$databar['jenis'].'"></td>
			</tr>
			<tr>				
				<td valign="top">Merek barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="merk" class="selectform" value="'.$databar['merk'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Type</td>
				<td valign="top">:</td>
				<td><input type="text" name="type" class="selectform" value="'.$databar['type'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Jumlah Barang</td>
				<td valign="top">:</td>
				<td><input type="text" name="jumlah" class="selectform" value="'.$databar['jumlah'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Vendor</td>
				<td valign="top">:</td>
				<td><input type="text" name="vendor" class="selectform" value="'.$databar['vendor'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="29" rows="5" style="padding:5px;">'.$databar['keterangan'].'</textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Status Barang</td>
				<td valign="top">:</td>
				<td><select name="status">
						<option value="">-- Pilih Status --
						<option value="Approve">Approve
						<option value="Reject">Reject
						<option value="Pending">Pending
					</select>
					<input type="hidden" name="statusfinal" class="selectform" value="Pending"><input type="hidden" name="id_barang" class="selectform" value="'.$id.'"><input type="hidden" name="orderby" class="selectform" value="'.$databar['orderby'].'">
				</td>
			</tr>
			<tr>				
				<td valign="top"></td>
				<td valign="top"></td>
				<td><span style="font-size:11px;">&nbsp;* Jika Memilih Status Pending Atau Reject Silahkan tuliskan Alasan</span>
				</td>
			</tr>
			<tr>				
				<td valign="top">Alasan</td>
				<td valign="top">:</td>
				<td><textarea name="alasan" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top">Harga Barang</td>
				<td valign="top">:</td>
				<td>';
					if($level=='Staff'){
					echo '<input type="text" name="harga" class="selectform"><span style="font-size:11px;">&nbsp;* Jangan menggunakan titik atau koma dalam penulisan harga</span>';
					}elseif($level=='Manajer'){
					echo '<input type="text" name="hargarp" class="selectform" value="Rp '.number_format($databar['harga_barang'],0,",",".").'"><input type="hidden" name="harga" class="selectform" value="'.$databar['harga_barang'].'">';
					
					}
					
				echo '
				</td>
			</tr>
			';
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