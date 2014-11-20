<?php
echo '
<h3>Internal Memo</h3>
			<div>
			<table class="tbrule" cellspacing="0px">
					<tr>				
						<td  class="td1">No IM</td>
						<td  class="td1">:</td>
						<td  class="td1">'.$datapro['noim'].'</td>
					</tr>
					<tr>				
						<td class="td2">Nama Perusahaan</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['namapers'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Alamat</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['alamat'].'</td>
					</tr>
					<tr>				
						<td class="td2">Kontak Person</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['cp'].'</td>
					</tr>
					
					<tr>				
						<td class="td1">Speed</td>
						<td class="td1">:</td>
						<td class="td1">'.$datapro['akses_speed'].'</td>
					</tr>
					<tr>				
						<td class="td2">Tgl. Permintaan</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['tglrfs'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Alasan dan Keterangan</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['keterangan'].'</td>
					</tr>
					<tr>				
						<td class="td2">Order By</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['nama_sales'].'</td>
					</tr>
					
					<tr>				
						<td class="td1" valign="top">Jenis Pekerjaan</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['jenis_pekerjaan'].'</td>
					</tr>
					<tr>				
						<td class="td2">Status Close</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['status_close'].'</td>
					</tr>
					</table>';
if($level=='Engineer' && $datapro['status_spk']=='NOK'){echo '<a href="pilih-term.php?noim='.$datapro['noim'].'" class="butfol">Followup</a>';}
echo '
					</div>';
					
?>