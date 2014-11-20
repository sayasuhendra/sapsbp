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
	$bulan=date('m');
	$namabulan=date('F');
	
	?>
	<div id="isi">
	
	<?php
	
	$tahun=date('Y');
	
	echo '
	<h3 class="judulok">Data Belanja Barang Bulan '.$namabulan.' Tahun '.$tahun.' </h3>
	<form method="POST" name="pilihbulan" action="data-belanjabln.php" style="margin-top:-10px; margin-bottom: 30px;">
		<label style="font-size:12px;">Pilih Bulan</label> : 
		<select name="bulan">
			<option value="'.$bulan.'">'.$namabulan.'
			<option value="01"> Januari
			<option value="02"> Februari
			<option value="03"> Maret
			<option value="04"> April
			<option value="05"> Mei
			<option value="06"> Juni
			<option value="07"> Juli
			<option value="08"> Agustus
			<option value="09"> September
			<option value="10"> Oktober
			<option value="11"> Januari
			<option value="12"> Januari
		</select>
		<label style="font-size:12px;">Pilih Tahun</label> : 
		<select name="tahun"><option value="'.$tahun.'">'.$tahun.'
		';
		   $tahunawal=$tahun-3;
		   for ($i=$tahunawal;$i<=2100;$i++){
		   echo '<option value="'.$i.'"> '.$i;
		   }
		echo '
		</select>
		<input type="submit" value="Proses">
	</form>
	<a href="data-barang.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/datastock.png" border="0px"></a>
	<a href="data-brkeluar.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/barangout.png" border="0px"></a>
	<a href="belanjabarang.php"><img style="margin-top:-15px; margin-bottom:10px;" alt="tambah barang" src="images/formbelanja.png" border="0px"></a>
	';
		
	$level=$_SESSION['level'];	
	$bagian=$_SESSION['bagian'];	
	
	$pilihim="select * from tb_bljbarang where month(tgl_beli)='$bulan' and year(tgl_beli)='$tahun' order by id_beli";
	$eksim=mysql_query($pilihim);
	
	$pilihim2="select * from tb_bljbarang where month(tgl_beli)='$bulan' and year(tgl_beli)='$tahun' order by id_beli";
	$eksim2=mysql_query($pilihim2);
	$im2=mysql_fetch_array($eksim2);
	if($im2==0){
	echo '<p>Tidak Ada Data Belanja Barang Pada Bulan '.$bulan.'</p>';
	}else{
	echo '<table cellspacing="0px" width="890px">
			<tr>
				
				<td class="tdheadbold">Nama Barang</td>
				<td class="tdheadbold">Merk</td>
				<td class="tdheadbold">Type</td>
				<td class="tdheadbold">Tanggal Masuk</td>
				<td class="tdheadbold">Jumlah Beli</td>
				<td class="tdheadbold">Status</td>
				<td class="tdheadbold">Harga</td>
				<td class="tdheadbold">Subtotal</td>
			</tr>';
	$no='0';
	while($dataim=mysql_fetch_array($eksim)){
	$tahun=substr($dataim['tgl_beli'],0,4);
	$bulan=substr($dataim['tgl_beli'],5,2);
	$hari=substr($dataim['tgl_beli'],8,2);
	$no++;
	$harganya[]=$dataim['harga']*$dataim['jumlah_beli'];
	$subtotal=$dataim['harga']*$dataim['jumlah_beli'];
	if($no%2==0){
	echo '<tr bgcolor="#D5D6D3">';
	}else{
	echo '<tr bgcolor="#f6f6f6">';
	}
	echo '
			
				
				<td class="tdisi">'.$dataim['nama_barang'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['type'].'</td>
				<td class="tdisi">'.$hari.'-'.$bulan.'-'.$tahun.'</td>
				<td class="tdisi">'.$dataim['jumlah_beli'].'</td>
				<td class="tdisi">'.$dataim['status'].'</td>
				<td class="tdisi">'.number_format($dataim['harga'],0,',','.').',-</td>
			    <td class="tdisi">'.number_format($subtotal,0,',','.').',-</td>
			</tr>
	';
	}
	
	echo '
			
			<tr>
			<td class="tdisi" colspan="7"><span style="font-weight:bold; font-size:14px;">Grand Total</span></td>
				<td class="tdisipinggir"><b style="color:#CC3319; font-size:13px">Rp '.number_format(array_sum($harganya),0,',','.').',-</b></td>
			</tr>';
	}
	echo '</table>';
	
		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>