<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$level=$_SESSION['level'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
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
		$noim=$_GET['noim'];
		$pilihim="select * from instal_im where noim='$noim'";
		$eksim=mysql_query($pilihim);
		$dataim=mysql_fetch_array($eksim);
		$pilihim2="select * from barang where noim='$noim' order by id_barang";
	    $eksim2=mysql_query($pilihim2);
		$barim2=mysql_fetch_row($eksim2);
		if($barim2<=0){
		echo '<p style="margin-top:20px; font-family:verdana; font-size:13px">
		 Klik <a href="formreqbreng.php?noim='.$noim.'">Disini</a> Jika Perlu Request barang, Klik <a href="isi-ip.php?noim='.$noim.'">Disini</a> Jika tidak perlu Request Barang</p>';	
		}else{
	echo '
	<h3 class="judulok">Data request barang yang sudah di ajukan</h3>';
	
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
	echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead">Pelanggan</td>				
				<td class="tdhead">Merk</td>
				<td class="tdhead">Type</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Jenis</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead">Manajer / Atasan</td>
				<td class="tdhead">Inventory</td>
				<td class="tdhead">Finance</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">Status Request</td>
				<td class="tdhead2">Detail Request</td>
			</tr>';
	
	
	$pilihim="select * from barang where noim='$noim' order by id_barang";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
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
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">'; if($dataim['statustm']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statusin']=='OK' && $dataim['statusfin']=='NOK'){echo '<img src="images/cekok.png">';}else if($dataim['statusin']=='OK' && $dataim['statusfin']=='OK'){echo '<img src="images/cekok.png">';}else if($dataim['statusin']=='NOK' && $dataim['statusfin']=='OK'){echo '<img src="images/cekok2.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statusfin']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['statuspo']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status']=='0'){echo 'OK';}else{echo 'Pending OR on Progress';}echo '</td>
				
				<td class="tdisi2"><a href="detailreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/detail.png"></a></td>
			</tr>
	';
	}
	
	
	
	echo '</table>';
		
	echo '<p style="margin-top:20px; font-family:verdana; font-size:13px">
		 Klik <a href="formreqbreng.php?noim='.$noim.'">Disini</a> Jika Perlu Request Barang Lain, Klik <a href="isi-ip.php?noim='.$noim.'">Disini</a> Jika tidak perlu Request Barang</p>';
		 }
	echo '
	</div>
	
	<div id="footer">';
	?>
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>