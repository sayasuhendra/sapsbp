<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];
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
	<h3 class="judulok">Data Request Barang yang Harus di Revisi</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead2">Revisi</td>
				<td class="tdhead2">Delete</td>
			</tr>';
		
	$sqlCount = "select count(id_barang) from barang where statustm='Revisi' AND orderby='$nama_lengkap'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statustm='Revisi' AND orderby='$nama_lengkap' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="formrevisi.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
				<td class="tdisi2"><a onClick="return confirm(\'Apakah Yakin Request Barang Ini Akan Di hapus ?\')" href="hapus-barang.php?id_barang='.$dataim['id_barang'].'"><img src="images/delete.png"></a></td>
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
				   echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
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