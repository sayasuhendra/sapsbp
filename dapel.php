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
	$sqlCount = "select count(cirid) from customer_new";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from customer_new order by cirid limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	
	echo '
	<div id="isi">
		<h3 class="judulok">Data Pelanggan Existing PT Solusindo Bintang Pratama</h3>
                <p style="margin:-15px 15px 10px 0px; color : #3B3B47; font-family : Georgia,arial;">Halaman <b>'.$page.' </b> </p>
		';
		echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead">CIRID</td>
				<td class="tdhead" width="350px">Nama Pelanggan</td>
				<td class="tdhead" width="300px">Bandwith Client</td>
     			<td class="tdhead" width="200px">Vendor</td>
				<td class="tdhead" width="300px">Sales</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
		
	</tr>';
	
	while($clientsbp=mysql_fetch_array($eksim)){
	echo '
		<tr>
				<td class="tdisi">'.$clientsbp['cirid'].'</td>
				<td class="tdisi" width="350px">'.$clientsbp['nama_perusahaan'].'</td>';
				if($clientsbp['bandwidth_client']==""){
				echo '<td class="tdisi" width="300px">-</td>';
				}else{
				echo '<td class="tdisi" width="300px">'.$clientsbp['bandwidth_client'].'</td>';
				}echo '
				<td class="tdisi" width="200px">'.$clientsbp['nama_vendor'].'</td>';
				if($clientsbp['marketing']==""){
				echo '<td class="tdisi" width="300px">-</td>';
				}else{
				echo '<td class="tdisi" width="300px">'.$clientsbp['marketing'].'</td>';
				}				
				echo '
				<td class="tdisi"><a href="detailpel.php?cirid='.$clientsbp['cirid'].'"><img src="images/detail.png"></a></td>
				<td class="tdisi2"><a href="editpel.php?cirid='.$clientsbp['cirid'].'"><img src="images/follow.png"></a></td>
		
	</tr>
	';
	}
	
	echo '
	</table>';
	$banyakhalaman = ceil($banyakData / $limit);
	$halaman=isset($_GET['page']) ? $_GET['page']:1;
        $first=$halaman/$halaman;	
	echo '<div id="paging_button"><ul>';
    if ($halaman > 1 && $halaman <= 10 ){
	$prev=$halaman-1;
	echo '<a class="pn" href="dapel.php?page='.$prev.'">Prev</a>';
	} 
	elseif($halaman > 10){
		$prev=$halaman-1;
		echo '<a class="pn" href="dapel.php?page='.$first.'">First</a> <a class="pn" href="dapel.php?page='.$prev.'">Prev</a>';
	}	
	else {
		echo '';
    }

	for ($i=1; $i <= $banyakhalaman; $i++){
            $urlink='Halaman-'.$i;   
		 if ((($i >= $halaman - 3) && ($i <= $halaman + 3)) || ($i == 1))
		{
		if (($i == 1) && ($i != 2))  echo "";
		if (($i != ($banyakhalaman - 1)) && ($i == $banyakhalaman))  echo "";
		if ($i == $halaman) echo "<a style='background-color : #b5b0b0'>".$i."</a> ";
		else echo " <a href='dapel.php?page=".$i."'>".$i."</a> ";
		$tampilhalaman = $i;
		 }
		}
		if ($halaman < $banyakhalaman){
			$next=$halaman+1;
			echo '<a class="pn" href="dapel.php?page='.$next.'">Next</a>';}
			else {echo '';}

		if (($halaman == $banyakhalaman) || ($i == 1) || ($halaman == $banyakhalaman)){
		echo '';

		}
	else {echo '<a class="pn" href="dapel.php?page='.$banyakhalaman.'">Last</a>';}

			  echo "</ul></div>";
	
	echo '
	
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
