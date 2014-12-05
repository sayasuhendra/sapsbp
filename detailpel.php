<?php
include "cek-sesion.php";
include "koneksi.php";
require "start.php";
$user=$_SESSION['username'];
$sqlCount = "select count(usrid) from usr_tb";  
$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
$banyakData = $rsCount[0];  
$page = isset($_GET['page']) ? $_GET['page'] : 1;  
$limit = 7;  
$mulai_dari = $limit * ($page - 1);  
$sql_limit = "select * from usr_tb order by username ASC limit $mulai_dari, $limit";  
$eksuser=mysql_query($sql_limit);
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
</head>

<body>
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	include "menu.php";
	$id=$_GET['cirid'];
	$pilihim="select * from customer_new where cirid='$id'";
	$eksim=mysql_query($pilihim);
	$client=mysql_fetch_array($eksim);

	$instalim = Instal::where('namapers', $client['nama_perusahaan'])->first();
	
	
	echo '
	<div id="isi">
		<h3 class="judulok">Detail Data Pelanggan '.$client['nama_perusahaan'].'</h3>
		<table border="0" class="tbdetail" width="800px">
			
			<tr>
				<th colspan="3" class="detail">'.$client['nama_perusahaan'].'</th>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Status</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">';
				if($client['status']=='Active'){
				echo '<b style="color:#6cba06">'.$client['status'].'</b>';
				}else{
				echo '
				<b style="color : #ec1f0a">'.$client['status'].'</b>';
				}
				
				echo '
				</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Cirid</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['cirid'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Alamat Perusahaan</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['alamat_perusahaan'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Kontak Finance</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['cp_finance'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Kontak Teknis</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['cp_teknis'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Marketing</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['marketing'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Tanggal Register</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['register_date'].'</td>
			</tr>

			<tr>
				<th colspan="3" class="detail">Data Kontak dari IM</th>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Nama Contact Person</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'. $instalim->cp .'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Telepon</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'. $instalim->telp .'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Email</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'. $instalim->email .'</td>
			</tr>



			<tr>
				<th colspan="3" class="detail">Layanan</th>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Bandwidth</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['bandwidth_client'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Nama Vendor</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['nama_vendor'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">IP Public</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['ippublic'].'</td>
			</tr>
			<tr>
				<th colspan="3" class="detail">Data Pendukung</th>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Url Smokeping</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['url_smokeping'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Url Cacti</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">'.$client['url_cacti'].'</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Topologi</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">';
				if($client['file_topologi']==""){
				echo "Tidak ada file Topologi";
				}else{
				echo '<a href="topologi/'.$client['file_topologi'].'" target="_blank"><img src="images/net.png"></a>';
				}
				echo '</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">File BW Test</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">';
				if($client['file_speed']==""){
				echo "Tidak ada file Bandwitdh Test";
				}else{
				echo '<a href="speedtest/'.$client['file_speed'].'" target="_blank"><img src="images/download.png"></a>';
				}
				echo '</td>
			</tr>
			<tr>
				<td class="tdetail" width="150px;">Foto Perangkat</td>
				<td class="tdetail" width="20px;">:</td>
				<td class="tdetail">';
				if($client['file_foto']==""){
				echo "Tidak ada file Foto";
				}else{
				echo '<a href="foto/'.$client['file_foto'].'" target="_blank"><img src="images/cam.png"></a>';
				}
				echo '</td>
			</tr>
			<tr>
				<th colspan="3" class="detail"><a class="printbut" href="editpel.php?cirid='.$client['cirid'].'" target="_blank">Edit</a></th>
			</tr>
			
						
		</table>
	
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
