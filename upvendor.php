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

		$pilihim="select * from instal_im inner join fpa_tb on instal_im.noim=fpa_tb.noim where instal_im.noim='$noim'";

		$eksim=mysql_query($pilihim);

		$dataim=mysql_fetch_array($eksim);

		

		

	echo'

		<h3 class="judulok">Update Status Vendor Untuk Pelanggan '.$dataim['namapers'].'</h3>

		<form method="post" name="formfpa" action="updatevendor.php">

		<table class="tbrule" cellspacing="20px" cellpadding="20px">

		<table>	

			<tr>				

				<td>No IM</td>

				<td></td>

				<td><input type="text" readonly="true" name="noim" class="selectform" value="'.$noim.'"><input type="hidden" name="namapers" class="selectform" value="'.$dataim['namapers'].'"></td>

			</tr>
			<tr>				

				<td>Nama Vendor</td>

				<td></td>

				<td><input type="text" name="namavendor" class="selectform" value="'.$dataim['akses_pro'].'" readonly="true"></td>

			</tr>
			<tr>				

				<td>Bandwidth</td>

				<td></td>

				<td><input type="text" readonly="true" name="bw" class="selectform" value="'.$dataim['akses_speed'].'"></td>

			</tr>
			<tr>				

				<td>Tgl RFS</td>

				<td></td>

				<td><input type="text" readonly="true" name="rfs" class="selectform" value="'.$dataim['tglrfs'].'"></td>

			</tr>
				
			<tr>				

				<td></td>

				<td></td>

				<td></td>

			</tr>

			

			<tr>				
	

				<td colspan="3" style="padding:10px 0px 10px 0px;"><input style="margin-left:-2px;" type="checkbox" name="ikg" class="selectform" required>&nbsp;&nbsp;IKG (Instalasi Kabel Gedung)</td>

			</tr>
			
			<tr>				
	

				<td colspan="3" style="padding:10px 0px 20px 0px;"><input style="margin-left:-2px;" type="checkbox" name="aktivasi" class="selectform" required>&nbsp;&nbsp;Aktivasi Disisi Vendor</td>

			</tr>

			<tr>				

				<td valign="top" colspan="3">Keterangan</td>

				

				
			</tr>

			<tr>
			<td colspan="3"><textarea name="keterangan" required cols="30" rows="10"></textarea></td>

			</tr>

			<tr>				

				<td colspan="3"><input type="image" src="images/cek.png"></td>

			</tr>

			

		</table>

		</form>

	</div>

	

	<div id="footer">';

	?>

		copyright &copy; www.sbp.net.id 2012 condev-team

	</div>

</body>

</html>