<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];
$area=$datauser['area'];
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
</head>

<body>
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	
	<?php
	if($level=="Manajer"){
	echo '
	<h3 class="judulok">Edit Penunjukan Engineer Area</h3>';
	}else{
	echo '
	<h3 class="judulok">Edit Penunjukan Pelaksana</h3>';
	}
	
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">No FPB / No FPC</td>
				<td class="tdhead">Nama Perusahaan</td>
				<td class="tdhead">Tgl RFS</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead">Pelaksana</td>
				<td class="tdhead2">Edit Pelaksana</td>
	</tr>';
		
	if($level=='Manajer'){
	$sqlCount = "select count(id_imin) from instal_im where status_spk='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 6;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_spk='NOK' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
                <td class="tdisi">'.$dataim['tujuan'].'</td>
				<td class="tdisi2">';if($level=='Staff'){
                                  echo '<a><img src="images/follow2.png"></a>';
                                  }else if($level=='Manajer'){
                                  echo '<a href="editengarea.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
                                  }
                                 
                               echo '
                               </td>
			</tr>
	';
	}
	echo '</table>';
	}else{
	$sqlCount = "select count(id_imin) from instal_im where status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 6;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
                <td class="tdisi">'.$dataim['tujuan'].'</td>
				<td class="tdisi2">';if($level=='Staff'){
                                  echo '<a><img src="images/follow2.png"></a>';
                                  }else if($level=='Engineer'){
                                  echo '<a href="editpelaksana.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
                                  }
                                 
                               echo '
                               </td>
			</tr>
	';
	}
	echo '</table>';
	}
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
				   if($page != $i){
				   echo '<a href="editeng.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
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