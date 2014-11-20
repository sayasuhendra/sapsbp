<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
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

  <script src="js/jquery-1.8.3.js"></script>
  
  
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

	<link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-ui.js"></script>
    
	
    <script>
    $(function() {
        $( "#accordion" ).accordion({ active: 2 });
    });
    </script>
</head>

<body>
	<div id="header">
		<div class="logo">
			<img src="images/logosbpok.png">
		</div>
	</div>
	
	<div id="isi2">
			<div id="isikiri">
			<?php
			$noim=$_GET['noim'];
			$pilihpro="select * from instal_im where noim='$noim'";
			$ekspro=mysql_query($pilihpro);
			$datapro=mysql_fetch_array($ekspro);
			
					
			echo '
					<h3 style="margin-top:-20px">FPA Untuk '.$datapro['namapers'].'</h3>';
					$pilihfpa="select * from fpa_tb where noim='$noim'";
					$eksfpa=mysql_query($pilihfpa);
					$datafpa=mysql_fetch_array($eksfpa);
					if($datafpa <= 0){
					echo '<div>Maaf Belum / Tidak Ada Data FPA untuk Project ini</div>';
					}else{
					echo '
			<div>
			
			
			<table class="tbrule" cellspacing="0px">
					<tr>				
						<td  class="td2">No IM</td>
						<td  class="td2">:</td>
						<td  class="td2">'.$datafpa['noim'].'</td>
					</tr>
					<tr>				
						<td  class="td1">No FPA</td>
						<td  class="td1">:</td>
						<td  class="td1">'.$datafpa['nofpa'].'</td>
					</tr>
					<tr>				
						<td class="td2">Nama Perusahaan</td>
						<td class="td2">:</td>
						<td class="td2">'.$datafpa['namapers'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Akses Usage</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datafpa['akses_usage'].'</td>
					</tr>
					<tr>				
						<td class="td2">Akses Status</td>
						<td class="td2">:</td>
						<td class="td2">'.$datafpa['akses_status'].'</td>
					</tr>
					<tr>				
						<td class="td1">Akses Speed</td>
						<td class="td1">:</td>
						<td class="td1">'.$datafpa['akses_speed'].'</td>
					</tr>
					<tr>				
						<td class="td2">Asal</td>
						<td class="td2">:</td>
						<td class="td2">'.$datafpa['asal'].'</td>
					</tr>
					<tr>				
						<td class="td1">Tujuan</td>
						<td class="td1">:</td>
						<td class="td1">'.$datafpa['tujuan'].'</td>
					</tr>
					<tr>				
						<td class="td2">Akses type</td>
						<td class="td2">:</td>
						<td class="td2">'.$datafpa['akses_type'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Akses Provider</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datafpa['akses_pro'].'</td>
					</tr>
					
					<tr>				
						<td class="td2" valign="top">Penjelasan</td>
						<td class="td2" valign="top">:</td>
						<td class="td2">'.$datafpa['penjelasan'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Target Operasional</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datafpa['target'].'</td>
					</tr>
					<tr>				
						<td class="td2" valign="top">TGL Terima IM</td>
						<td class="td2" valign="top">:</td>
						<td class="td2">'.$datafpa['tglim'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Status</td>
						<td class="td1" valign="top">:</td>
						<td class="td1"><span style="color:red; font-weight:bold; text-decoration:blink;">'.$datafpa['status'].'<span></td>
					</tr>
					<tr>				
						<td class="td2">Order By</td>
						<td class="td2">:</td>
						<td class="td2">'.$datafpa['orderby'].'</td>
					</tr>
                                        <tr>				
						<td class="td2"><input type="button" value="Print" onClick="window.print()"> </td>
						<td class="td2"></td>
						<td class="td2"></td>
					</tr>

					</table>
					</div>';
					}
			
				$pilihreport="select * from report_pro where noim='$noim' order by idreport DESC";
				$eksreport=mysql_query($pilihreport);
				
				echo '
				
				
				</div>
			 
				
			 
	</div>
	';
	
	?>
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>