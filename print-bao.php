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
  <script type="text/javascript" src="java/nivo.js"></script>
  <script type="text/javascript" src="java/jquery.watermark.min.js"></script>
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
		
	<div id="isi2">
			<div id="isikiri">
			<?php
			$noim=$_GET['noim'];
			$pilihpro="select * from instal_im where noim='$noim'";
			$ekspro=mysql_query($pilihpro);
			$datapro=mysql_fetch_array($ekspro);
					
		$noim2=$_GET['noim'];
		include "koneksi.php";
		$pilihfpa2="SELECT * FROM instal_im WHERE noim='$noim2'";
		$eksfpa2=mysql_query($pilihfpa2);
		$datafpa2=mysql_fetch_array($eksfpa2);
		$waktu=date('d-F-Y');
		$namaclient=$datafpa2['namapers'];
		$noba=str_replace("/Instal/","/Instal/BA/","$noim2");
		echo'
		<form method="post" name="formcari" action="#" style="padding-bottom:30px; margin-top:-115px">
                <input type="button" value="Print"  onClick="window.print()">
		<table width="990px" style="margin-left:-10px">
				   <tr>
					<td valign="top" style="width:990px; text-align:center">
					 					 
					
					<img src="images/logobaru.png" style="margin-top:-30px">
					<h3 style="font-family:georgia; font-size:19px; margin-top:-6px; color:#3d3c3c;">Berita Acara Operasional</h3> 
					
					 
					</td>
				   </tr>
		</table>
		<table>
			<tr>
			 <td style="font-size:19px; font-weight:bold;">NO BA</td><td style="font-size:19px; font-weight:bold;">:</td><td style="font-size:19px; font-weight:bold;"><input type="text" name="noba" value="'.$noba.'" class="inputbaopr"></td>
			</tr>
			<tr> 
			 <td style="font-size:19px; font-weight:bold;">Date</td><td style="font-size:19px; font-weight:bold;">:</td><td style="font-size:19px; font-weight:bold;"><input type="text" name="waktu" value="'.$waktu.'" class="inputbaopr"></td>
			</tr>
		</table>
		
		<table class="tbrule" cellspacing="10px">
		';
		
		echo'
			<tr>
				<td>
				  <table width="990px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh" valign="top">
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">INTERNET SERVICES</p>
					  <ul>
					   <li class="radio"><input type="radio" name="isp" value="Port Only">Port Only</li>
					   <li class="radio"><input type="radio" name="isp" value="Broadband">Broadband</li>
					   <li class="radio"><input type="radio" name="isp" value="Dedicated">Dedicated</li>
					   <li class="radio"><input type="radio" name="isp" value="upgrade">Upgrade Bandwidth</li>
					  </ul>
					</td>
					<td class="tdaneh" valign="top">
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">PRIVATE LEASED CIRCUIT</p>
					  <ul>
					   <li class="radio"><input type="radio" name="plc" value="local Only">Local Link Only</li>
					   <li class="radio"><input type="radio" name="plc" value="Domestic Private leased Circuit">Domestic Private leased Circuit</li>
					   <li class="radio"><input type="radio" name="plc" value="IPLC">IPLC</li>
					   <li class="radio"><input type="radio" name="plc" value="Metro eth">Metro eth</li>
					  </ul>
					</td>
					<td class="tdaneh" valign="top">
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">OTHER SERVICES</p>
					  <ul>
					   <li class="radio"><input type="radio" name="plc" value="Collocation">Collocation</li>
					   <li class="radio"><input type="radio" name="plc" value="Web Hosting">Web Hosting</li>
					   <li class="radio"><input type="text" style="width:50px; margin-left:19px;" name="hosting"> MB</li>
					  </ul>
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			<tr>
				<td>
				  <table width="950px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh2" valign="top">
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">Data Client</p>
					  <ul>
					   <li class="radio">Nama Client :</li>
					   <li class="datar"><input type="text" name="namapers" value="'.$namaclient.'" class="inputbaopr"></li>
					   					   
					   <li class="datar">ID Client :</li>
					     
					   <li class="radio">Alamat :</li>
					   <li class="datar">'.$datafpa2['alamat'].'</li>
					  </ul>
					</td>
					<td class="tdaneh2" valign="top">
					 
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">Kontak Person</p>
					  <ul>
					   <li class="radio">Kontak Person :</li>
					   <li class="datar"><input type="text" name="cp" value="'.$datafpa2['cp'].'" class="inputbaopr"></li>
					   					   
					   <li class="radio">Telepon :</li>
					   <li class="datar"><input type="text" name="telp" value="'.$datafpa2['telp'].'" class="inputbaopr"></li>
					   <li class="radio">Email :</li>
					   <li class="datar"><input type="text" name="email" value="'.$datafpa2['email'].'" class="inputbaopr"></li>
					  </ul>
					</td>
					<td class="tdaneh2" valign="top">
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">Sales Person</p>
					  <ul>
					   <li class="radio">Nama Sales :</li>
					   <li class="datar"><input type="text" name="sales" value="'.$datafpa2['nama_sales'].'" class="inputbaopr"></li>
					  </ul>
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			<tr>
				<td>
				  <table width="990px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh" valign="top"  colspan="2">
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">Delivery Tech. Data</p>
					  <table width="430px">
                                             <tr>
                                                    <td>Alokasi Bandwith : <input type="text" name="jasa" value="'.$datafpa2['jasa'].'" class="inputbaopr">&nbsp;<input type="text" name="speed" value="'.$datafpa2['akses_speed'].'" class="inputbaopr"></td>
					            <td>Jaringan Lokal : <input type="text" name="speedlok" value="'.$datafpa2['akses_speed'].'" class="inputbaopr"></td>
                                             </tr>
                                             <tr>   
					            <td>Alamat IP : <input type="text" name="ip" value="'.$datafpa2['ipadd'].'" class="inputbaopr"></td>
                                                    <td>Netmask : <input type="text" name="ip" value="'.$datafpa2['netmask'].'" class="inputbaopr"></td>
                                             </tr>
                                             <tr>
                                                    <td>Gateway : <input type="text" name="ip" value="'.$datafpa2['gateway'].'" class="inputbaopr"></td>
                                             </tr> 
					  </table>
					</td>
					<td class="tdaneh" valign="top">
					 
					 
					 <p style="border-bottom:solid 1px #111111; font-size:19px;">Work Order</p>
					  <ul>
					   <li class="radio"><input type="radio" name="wo" value="Instalation">Instalation</li>
					   <li class="radio"><input type="radio" name="wo" value="Mutation">Mutation</li>
					   <li class="radio"><input type="radio" name="wo" value="Activation">Activation</li>
					   <li class="radio"><input type="radio" name="wo" value="Upgrade">Upgrade</li>
					   <li class="radio"><input type="radio" name="wo" value="Downgrade">Downgrade</li>
					  </ul>
					</td>
					
				   </tr>
				   <tr>
					<td colspan="3" class="tdaneh3" valign="top"><p style="font-size:11px">With this, stating that the Service (Subscriptions Circuit) has completed installation and test with GOOD results and declared ready for use /
operation starting from : '.$datafpa2['tglrfs'].'</p></td>
				   </tr>
				   
				   <tr>
					<td colspan="3" class="tdaneh2" valign="top">
						<p style="border-bottom:solid 1px #111111; font-size:19px; margin-bottom: 0px; margin-top: 5px;">Checklist</p>
						<table>
							<tr>	
								<td valign="top" style="margin-left:10px;">
									<ul>
										<li class="radio"><input type="checkbox" name="cek[]" value="Ping">Ping</li>
										<li class="radio"><input type="checkbox" name="cek[]" value="Browsing">Browsing</li>
									</ul>	
									
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio"><input type="checkbox" name="cek[]" value="Download">Download</li>
										<li class="radio"><input type="checkbox" name="cek[]" value="Upload">Uplaod</li>
									</ul>	
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio"><input type="checkbox" name="cek[]" value="mail">Mail</li>
										<li class="radio"><input type="checkbox" name="cek[]" value="speedtest">Speedtest</li>
									</ul>	
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio"><input type="checkbox" name="cek[]" value="Throughput">Throughput</li>
										<li class="radio"><input type="checkbox" name="cek[]" value="Traceroute">Traceroute</li>
									</ul>	
								</td>
							</tr>
						</table>
					</td>
				   </tr>
				   <tr>
					<td colspan="3" class="tdaneh2" valign="top"><p style="border-bottom:solid 1px #111111; font-weight:bold;">Notes</p>
					<input type="text" name="keterangan" value="'.$datafpa2['keterangan'].'" class="baoketerangan">
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			
		</table>
		
			<p style="margin-left:0px; font-size:14px; width:950px;">With the signing of the BAO Statement means the customer otherwise bound by and comply with all regulations which have been agreed.</p>
		<table width="950px">
			<tr>
				<td valign="top"><span style="font-weight:bold; font-size:19px; float:left;">PT SOLUSINDO BINTANG PRATAMA</span></td>
				<td><span style="font-weight:bold; font-size:19px; float:right;">Pelanggan / Customer</span></td>
			</tr>
			<tr>
				<td><span style="font-weight:bold; font-size:19px; float:left; margin-top:60px;">'.$datafpa2['nama_sales'].'</span></td>
				<td><span style="font-weight:bold; font-size:19px; float:right; margin-top:60px;">......................................</span></td>
			</tr>
					
		</table>
		<br />
		
		
		
		</form>

				</div>
			 
				
			 
	</div>
	';
	
	?>
	
</body>
</html>
