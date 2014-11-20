<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
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

  <script src="js/jquery-1.8.3.js"></script>
  
  
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

	<link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-ui.js"></script>
    
	
    <script>
    $(function() {
        $( "#accordion" ).accordion({ active: 2 });
    });
    </script>
</head>

<body>
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi2">
	<h3 class="judulok">Detail Request Barang</h3>
			<div id="isikiri">
			<?php
			$idbr=$_GET['id_barang'];
			$pilihpro="select * from barang where id_barang='$idbr'";
			$ekspro=mysql_query($pilihpro);
			$datapro=mysql_fetch_array($ekspro);
			$rupiah1 ='Rp '.number_format($datapro['harga_barang'],0, ",",".");
			$rupiah2 ='Rp '.number_format($datapro['total_biaya'],0, ",",".");
			echo '
			<div>
			<table class="tbrule" cellspacing="0px">
					<tr>				
						<td  class="td2">Nama Pelanggan</td>
						<td  class="td2">:</td>
						<td  class="td2">'.$datapro['noim'].'</td>
					</tr>
					<tr>				
						<td  class="td1">Jenis</td>
						<td  class="td1">:</td>
						<td  class="td1">'.$datapro['jenis'].'</td>
					</tr>
					<tr>				
						<td class="td2">Merk</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['merk'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Type</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['type'].'</td>
					</tr>
					<tr>				
						<td class="td2">Jumlah</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['jumlah'].'</td>
					</tr>
					<tr>				
						<td class="td1">Harga @ Barang</td>
						<td class="td1">:</td>
						<td class="td1">'.$rupiah1.'</td>
					</tr>
					<tr>				
						<td class="td2">Total Biaya</td>
						<td class="td2">:</td>
						<td class="td2">'.$rupiah2.'</td>
					</tr>
					<tr>				
						<td class="td1">Vendor Penyedia</td>
						<td class="td1">:</td>
						<td class="td1">'.$datapro['vendor'].'</td>
					</tr>
					<tr>				
						<td class="td2">Keterangan Kebutuhan</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['keterangan'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Total Biaya</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['total_biaya'].'</td>
					</tr>
					<tr>				
						<td class="td2" valign="top">Order By</td>
						<td class="td2" valign="top">:</td>
						<td class="td2">'.$datapro['orderby'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Alasan</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['alasan'].'</td>
					</tr>
					
					</table>
					</div>

				</div>
			 
				
			 
	</div>
	';
	
	?>
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>