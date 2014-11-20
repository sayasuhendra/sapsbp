<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$bagian=$datauser['bagian'];
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
	<h3 class="judulok">Data Progress Request Barang</h3>';
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
	echo '<table cellspacing="0px" width="1100px">
			<tr>
				<td class="tdhead">Pelanggan</td>				
				<td class="tdhead">Merk</td>
				<td class="tdhead">Type</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Jenis</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead">Tgl RFS</td>
				<td class="tdhead">Manajer / Atasan</td>
				<td class="tdhead">Inventory</td>
				<td class="tdhead">Finance</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">Status Request</td>
				<td class="tdhead">Edit Request</td>
				<td class="tdhead2">Detail Request</td>
			</tr>';
	
	$sqlCount = "select count(id_barang) from barang";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 6;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from barang order by id_barang DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
        $noimbr=$dataim['noim'];
        if($noimbr=='Kebutuhan Internal'){
        $namapersbr='Kebutuhan Internal';
        }else{
        $pilihimbr="select * from instal_im where noim='$noimbr'";
	$eksimbr=mysql_query($pilihimbr);
        $datbr=mysql_fetch_array($eksimbr);        
        $namapersbr=$datbr['namapers'];
        }
        
       
	echo '
			<tr>';
if($namapersbr==""){
echo '<td class="tdisi">'.$dataim['noim'].'</td>';
}else{
echo '<td class="tdisi">'.$namapersbr.'</td>';
}
                        
echo '

				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['type'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>';
				if($dataim['rfs'] =='0000-00-00'){
				echo '<td class="tdisi">-</td>';
				}else{echo '				
				<td class="tdisi">'.date("d-m-Y", strtotime($dataim['rfs'])).'</td>';}
				
				echo '
				<td class="tdisi">'; if($dataim['statustm']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statusin']=='OK' && $dataim['statusfin']=='NOK'){echo '<img src="images/cekok.png">';}else if($dataim['statusin']=='OK' && $dataim['statusfin']=='OK'){echo '<img src="images/cekok.png">';}else if($dataim['statusin']=='NOK' && $dataim['statusfin']=='OK'){echo '<img src="images/cekok2.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statusfin']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statuspo']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status']=='0'){echo 'OK';}else{echo 'Pending OR on Progress';}echo '</td>
				<td class="tdisi">'; if($dataim['orderby']==$namalengkap || $bagian=='Inventory'){echo '<a href="editreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a>';}else{echo '<img src="images/follow2.png">';}echo '</td>
				<td class="tdisi2"><a href="detailreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/detail.png"></a></td>
			</tr>
	';
	}
	
	

	echo '</table>';
	$banyakhalaman = ceil($banyakData / $limit);
	$halaman=isset($_GET['page']) ? $_GET['page']:1;
        $first=$halaman/$halaman;	
	echo '<div id="paging_button"><ul>';
    if ($halaman > 1 && $halaman <= 10 ){
	$prev=$halaman-1;
	echo '<a class="pn" href="billpro.php?page='.$prev.'">Prev</a>';
	} 
	elseif($halaman > 10){
		$prev=$halaman-1;
		echo '<a class="pn" href="billpro.php?page='.$first.'">First</a> <a class="pn" href="billpro.php?page='.$prev.'">Prev</a>';
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
		else echo '<a href="reqbrpro.php?page='.$i.'">'.$i.'</a> ';
		$tampilhalaman = $i;
		 }
		}
		if ($halaman < $banyakhalaman){
			$next=$halaman+1;
			echo '<a class="pn" href="reqbrpro.php?page='.$next.'">Next</a>';}
			else {echo '';}

		if (($halaman == $banyakhalaman) || ($i == 1) || ($halaman == $banyakhalaman)){
		echo '';

		}
	else {echo '<a class="pn" href="reqbrpro.php?page='.$banyakhalaman.'">Last</a>';}

			  echo "</ul></div>";
		
		?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
