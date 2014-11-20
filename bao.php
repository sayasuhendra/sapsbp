<?php

echo '
<h3>BAO</h3>
		<div>
		<h3 class="judulok">Form Berita Acara</h3>';
		$noim2=$_GET['noim'];
		include "koneksi.php";
		$pilihfpa2="SELECT * FROM instal_im WHERE noim='$noim2'";
		$eksfpa2=mysql_query($pilihfpa2);
		$datafpa2=mysql_fetch_array($eksfpa2);
		$waktu=date('d-F-Y');
		$namaclient=$datafpa2['namapers'];
		$noba=str_replace("/Instal/","/Instal/BA/","$noim2");
		echo'
		<form method="post" name="formcari" action="baopdf-ok.php" style="padding-bottom:30px;">
		<table>
			<tr>
			 <td style="font-size:12px; font-weight:bold;">NO BA</td><td style="font-size:12px; font-weight:bold;">:</td><td style="font-size:12px; font-weight:bold;"><input type="text" name="noba" value="'.$noba.'" class="inputbao"></td>
			</tr>
			<tr> 
			 <td style="font-size:12px; font-weight:bold;">Date</td><td style="font-size:12px; font-weight:bold;">:</td><td style="font-size:12px; font-weight:bold;"><input type="text" name="waktu" value="'.$waktu.'" class="inputbao"></td>
			</tr>
		</table>
		
		<table class="tbrule" cellspacing="10px">
		';
		
		echo'
			<tr>
				<td>
				  <table width="550px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh" valign="top">
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">INTERNET SERVICES</p>
					  <ul>
					   <li class="radio2"><input type="radio" name="isp" value="Port Only">Port Only</li>
					   <li class="radio2"><input type="radio" name="isp" value="Broadband">Broadband</li>
					   <li class="radio2"><input type="radio" name="isp" value="Dedicated">Dedicated</li>
					   <li class="radio2"><input type="radio" name="isp" value="upgrade">Upgrade Bandwidth</li>
					  </ul>
					</td>
					<td class="tdaneh" valign="top">
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">PRIVATE LEASED CIRCUIT</p>
					  <ul>
					   <li class="radio2"><input type="radio" name="plc" value="local Only">Local Link Only</li>
					   <li class="radio2"><input type="radio" name="plc" value="Domestic Private leased Circuit">Domestic Private leased Circuit</li>
					   <li class="radio2"><input type="radio" name="plc" value="IPLC">IPLC</li>
					   <li class="radio2"><input type="radio" name="plc" value="Metro eth">Metro eth</li>
					  </ul>
					</td>
					<td class="tdaneh" valign="top">
					 <p style="border-bottom:solid 1px #c3c3c3;">OTHER SERVICES</p>
					  <ul>
					   <li class="radio2"><input type="radio" name="plc" value="Collocation">Collocation</li>
					   <li class="radio2"><input type="radio" name="plc" value="Web Hosting">Web Hosting</li>
					   <li class="radio2"><input type="text" style="width:50px; margin-left:20px;" name="hosting"> MB</li>
					  </ul>
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			<tr>
				<td>
				  <table width="550px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh2" valign="top">
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">Data Client</p>
					  <ul>
					   <li class="radio2">Nama Client :</li>
					   <li class="datar2"><input type="text" name="namapers" value="'.$namaclient.'" class="inputbao"></li>
					   					   
					   <li class="datar2">ID Client :</li>
					     
					   <li class="radio2">Alamat :</li>
					   <li class="datar2"><textarea name="alamat" class="inputbao">'.$datafpa2['alamat'].'</textarea></li>
					  </ul>
					</td>
					<td class="tdaneh2" valign="top">
					 
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">Kontak Person</p>
					  <ul>
					   <li class="radio2">Kontak Person :</li>
					   <li class="datar2"><input type="text" name="cp" value="'.$datafpa2['cp'].'" class="inputbao"></li>
					   					   
					   <li class="radio2">Telepon :</li>
					   <li class="datar2"><input type="text" name="telp" value="'.$datafpa2['telp'].'" class="inputbao"></li>
					   <li class="radio2">Email :</li>
					   <li class="datar2"><input type="text" name="email" value="'.$datafpa2['email'].'" class="inputbao"></li>
					  </ul>
					</td>
					<td class="tdaneh2" valign="top">
					 <p style="border-bottom:solid 1px #c3c3c3;">Sales Person</p>
					  <ul>
					   <li class="radio2">Nama Sales :</li>
					   <li class="datar2"><input type="text" name="sales" value="'.$datafpa2['nama_sales'].'" class="inputbao"></li>
					  </ul>
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			<tr>
				<td>
				  <table width="550px" style="margin-left:-10px">
				   <tr>
					<td class="tdaneh2" valign="top"  colspan="2">
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">Delivery Tech. Data</p>
					  <ul>
					   <li class="radio2">Alokasi Bandwith :</li>
					   <li class="datar2"><input type="text" name="jasa" value="'.$datafpa2['jasa'].'" class="inputbao2">&nbsp;<input type="text" name="speed" value="'.$datafpa2['akses_speed'].'" class="inputbao2"></li>
					   					   
					   <li class="radio2">Jaringan Lokal :</li>
					   <li class="datar2"><input type="text" name="speedlok" value="'.$datafpa2['akses_speed'].'" class="inputbao2"></li>
					   
					   <li class="radio2">Alamat IP:</li>
					   <li class="datar2"><input type="text" name="ip"></li>
					  </ul>
					</td>
					<td class="tdaneh2" valign="top">
					 
					 
					 <p style="border-bottom:solid 1px #c3c3c3;">Work Order</p>
					  <ul>
					   <li class="radio2"><input type="radio" name="wo" value="Instalation">Instalation</li>
					   <li class="radio2"><input type="radio" name="wo" value="Mutation">Mutation</li>
					   <li class="radio2"><input type="radio" name="wo" value="Activation">Activation</li>
					   <li class="radio2"><input type="radio" name="wo" value="Upgrade">Upgrade</li>
					   <li class="radio2"><input type="radio" name="wo" value="Downgrade">Downgrade</li>
					  </ul>
					</td>
					
				   </tr>
				   <tr>
					<td colspan="3" class="tdaneh2" valign="top"><p>With this, stating that the Service (Subscriptions Circuit) has completed installation and test with GOOD results and declared ready for use /
operation starting from : Mei, 1st 2012</p></td>
				   </tr>
				   
				   <tr>
					<td colspan="3" class="tdaneh2" valign="top">
						<p style="border-bottom:solid 1px #c3c3c3;">Checklist</p>
						<table cellspacing="15px">
							<tr>	
								<td valign="top" style="margin-left:10px;">
									<ul>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Ping">Ping</li>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Browsing">Browsing</li>
									</ul>	
									
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Download">Download</li>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Upload">Uplaod</li>
									</ul>	
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio2"><input type="checkbox" name="cek[]" value="mail">Mail</li>
										<li class="radio2"><input type="checkbox" name="cek[]" value="speedtest">Speedtest</li>
									</ul>	
								</td>
								<td valign="top" margin-left:10px;>
									<ul>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Throughput">Throughput</li>
										<li class="radio2"><input type="checkbox" name="cek[]" value="Traceroute">Traceroute</li>
									</ul>	
								</td>
							</tr>
						</table>
					</td>
				   </tr>
				   <tr>
					<td colspan="3" class="tdaneh2" valign="top"><p style="border-bottom:solid 1px #c3c3c3; font-weight:bold;">Notes</p>
					<input type="text" name="keterangan" value="'.$datafpa2['keterangan'].'" class="baoketerangan">
					</td>
				   </tr>
				  </table>
				</td>
			</tr>
			
		</table>
		
			<p style="margin-left:0px; font-size:12px;">With the signing of the BAO Statement means the customer otherwise bound by and comply with all regulations which have been agreed.</p>
		<table>
			<tr>
				<td valign="top"><span style="font-weight:bold; font-size:11px; float:left;">PT SOLUSINDO BINTANG PRATAMA</span></td>
				<td><span style="font-weight:bold; font-size:11px; margin-left:150px; float:right;">Pelanggan / Customer</span></td>
			</tr>
			<tr>
				<td><span style="font-weight:bold; font-size:11px; float:left; margin-top:40px;">'.$datafpa2['nama_sales'].'</span></td>
				<td><span style="font-weight:bold; font-size:11px; float:right; margin-top:40px;">'.$datafpa2['cp'].'</span></td>
			</tr>
					
		</table>
		<br />
		
		<a href="print-bao.php?noim='.$noim.'" class="printbut" target="_blank">Print BAO</a>
		
		</form>
</div>';

?>