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
	<h3 class="judulok">Data Stock Barang Tahun '.$tahun.' </h3>
	<a href="inputbarang.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/barang.png" border="0px"></a>
	<a href="data-brkeluar.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/barangout.png" border="0px"></a>
	<a href="data-belanja.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/belanjabarang.png" border="0px"></a>
	';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdheadbold">Serial Number</td>
				<td class="tdheadbold">Nama Barang</td>
				<td class="tdheadbold">Merk</td>
				<td class="tdheadbold">Type</td>
				<td class="tdheadbold">Tanggal Masuk</td>
				<td class="tdheadbold">Lokasi Penyimpanan</td>
				<td class="tdheadbold">Status</td>
				<td class="tdheadbold">Keterangan</td>
				<td class="tdheadbold">Edit</td>
				
			</tr>';
	
	$level=$_SESSION['level'];	
	$bagian=$_SESSION['bagian'];	
	
	$sqlCount = "select count(serial_num) from tb_stbarang";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from tb_stbarang order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	$no='0';
	while($dataim=mysql_fetch_array($eksim)){
	$tahun=substr($dataim['tgl_masuk'],0,4);
	$bulan=substr($dataim['tgl_masuk'],5,2);
	$hari=substr($dataim['tgl_masuk'],8,2);
	$no++;
	if($no%2==0){
	echo '<tr bgcolor="#D5D6D3">';
	}else{
	echo '<tr bgcolor="#f6f6f6">';
	}
	echo '
			

				<td class="tdisi">'.$dataim['serial_num'].'</td>
				<td class="tdisi">'.$dataim['nama_barang'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['type'].'</td>
				<td class="tdisi">'.$hari.'-'.$bulan.'-'.$tahun.'</td>
				<td class="tdisi">'.$dataim['lokasistock'].'</td>
				<td class="tdisi">'.$dataim['status'].'</td>
				<td class="tdisi">'.$dataim['keterangan'].'</td>
				<td class="tdisi"><a href="editstock.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
				
			</tr>
	';
	}
	
	echo '</table>';
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
				   if($page != $i){
				   echo '<a href="data-barang.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
		
		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>