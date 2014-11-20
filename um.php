<?php
include "cek-sesion.php";
include "koneksi.php";
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
	
	?>
	<div id="isi">
		<h3 class="judulok">Data User Admin SAPSBP</h3>
		<?php
		$no=0;
		echo '
		<a href="formum.php"><img style="margin-top:-15px; margin-bottom:10px;" src="images/adduser.png" border="0px"></a>
		<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead" width="30px">No.</td>
				<td class="tdhead">Username</td>
				<td class="tdhead">Level</td>
				<td class="tdhead">Bagian</td>
				<td class="tdhead" width="220px">Nama</td>
				<td class="tdhead" >Email</td>
				<td class="tdhead">Edit</td>
				<td class="tdhead2">Delete</td>
			</tr>';
		while($datauser=mysql_fetch_array($eksuser)){$no++;
		echo '
			<tr>
				<td class="tdisi" width="30px">'.$no.'</td>
				<td class="tdisi">'.$datauser['username'].'</td>
				<td class="tdisi">'.$datauser['level'].'</td>
				<td class="tdisi">'.$datauser['bagian'].'</td>
				<td class="tdisi" width="220px">'.$datauser['nama_lengkap'].'</td>
				<td class="tdisi" width="220px">'.$datauser['email'].'</td>
				<td class="tdisi"><a href="editum.php?usrid='.$datauser['usrid'].'"><img src="images/edite.png"></a></td>
				<td class="tdisi2"><a onClick="return confirm(\'Apakah Anda Yakin Akan Menghapus User Ini ?\')" href="hapusum.php?usrid='.$datauser['usrid'].'"><img src="images/delete.png"></a></td>
			</tr>
		';
		}	
		echo '
		</table>';
		$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
				   if($page != $i){
				   echo '<a href="um.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
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