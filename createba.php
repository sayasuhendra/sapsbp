<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
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
		include "koneksi.php";
		$waktu=date("Ymd");
		$pilihno="select * from instal_im";
		$eksno=mysql_query($pilihno);
		$datano=mysql_fetch_row($eksno);
		if($datano<=0){
		$nourut=0001;
			$nourutok=sprintf("%04s",$nourut);
			$nofpb='SBP/'.$waktu.'/'.$nourutok;
		}
		else if($datano>=1){
		$pilihfpb="select * from instal_im";
		$eksfpb=mysql_query($pilihfpb);
		while($datafpb=mysql_fetch_array($eksfpb)){
		    
			$nourut=$datafpb['nourut'] + '1';
			$nourutok=sprintf("%04s",$nourut);
			$nofpb='SBP/'.$waktu.'/'.$nourutok;
		}
		}
		
		
		
		
		
	echo '
		<h3 class="judulok">Form Internal Memo Instalasi</h3>
		<form method="post" name="formcari" action="prosesim.php">
		<table class="tbrule" cellspacing="10px">
			
			<tr>				
				<td>Area</td>
				<td>:</td>
				<td><select name="area" class="selectform">
						<option value="-">-- Pilih Area --</option>
						<option value="JKT">Jakarta</option>
						<option value="BTM">Batam</option>
						<option value="TPI">TPI</option>
						<option value="TBK">TBK</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td>No FPB</td>
				<td>:</td>
				<td><input type="text" readonly="true" name="nofpb" class="selectform" value="'.$nofpb.'"><input type="hidden" name="nourut" value="'.$nourutok.'"></td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td><input type="text" name="namapers" class="selectform">
				</td>
			</tr>
			<tr>				
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td><textarea name="alamat" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td>Kontak Person</td>
				<td>:</td>
				<td><input type="text" name="cp" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Telp / HP</td>
				<td>:</td>
				<td><input type="text" name="telp" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Jasa & Speed</td>
				<td>:</td>
				<td><input type="text" name="jasa" class="selectform">
				</td>
			</tr>
			<tr>				
				<td>Tgl. Ready For Service</td>
				<td>:</td>
				<td><input type="text" name="rfs" class="selectform">
				</td>
			</tr>
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td><textarea name="keterangan" cols="29" rows="5" style="padding:5px;"></textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top"><input type="hidden" name="tujuan" class="selectform" value="Teknikal Manajer"></td>
				<td valign="top"><input type="hidden" name="status" class="selectform" value="Pending"></td>
				<td></td>
			</tr>
			<tr>				
				<td>Jenis Pekerjaan</td>
				<td>:</td>
				<td><input type="text" name="jenpek" class="selectform" value="Instalasi" readonly="true">
				</td>
			</tr>
			<tr>				
				<td>Nama Sales</td>
				<td>:</td>
				<td><input type="text" name="namasales" class="selectform" value="'.$datauser['nama_lengkap'].'" readonly="true">
					<input type="hidden" name="status_im" class="selectform" value="OK">
					<input type="hidden" name="status_tm" class="selectform" value="NOK">
					<input type="hidden" name="status_fin" class="selectform" value="NOK">
					<input type="hidden" name="status_close" class="selectform" value="NOK">
				</td>
			</tr>';
			?>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>