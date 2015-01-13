<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namalengkap=$datauser['nama_lengkap'];
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
  
  <link href="js/gaya.css" rel="stylesheet" type="text/css" />
  
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
	<h3 class="judulok">Data Project Progress</h3>';
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
	echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead" width="30px">No</td>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Circuit ID</td>
				<td class="tdhead">Nama Perusahaan</td>
				<td class="tdhead">Tgl RFS</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead">Jenis Pekerjaan</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPC</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Provisioning</td>
				<td class="tdhead2">Detail Project</td>
			</tr>';
	
	$sqlCount = "select count(idmemo) from internal_memo where jenpek='Isolir'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 7;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from internal_memo where jenpek='Isolir' order by idmemo DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	
	
	echo '
			<tr>
				<td class="tdisi" width="30px">'.$no.'</td>
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nomercircuit'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisi">'; if($dataim['status_im']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_fin']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_tm']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_spk']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				
				echo '</td>
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
				   echo '<a href="reqpro.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
		
		?>
		
	</div>
        <?php
            include "carikotak.php";
        ?>

	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
