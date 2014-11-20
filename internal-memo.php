<?php
            $pilihbrim="select * from barang where noim='$noim'";
			$eksbrim=mysql_query($pilihbrim);

echo '
<h3>Internal Memo</h3>
			<div>
			<table class="tbrule" cellspacing="0px">
					<tr>				
						<td  class="td2">No IM</td>
						<td  class="td2">:</td>
						<td  class="td2">'.$datapro['noim'].'</td>
					</tr>
					<tr>				
						<td  class="td1">No FPB</td>
						<td  class="td1">:</td>
						<td  class="td1">'.$datapro['nofpb'].'</td>
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
						<td class="td1">Telp / HP</td>
						<td class="td1">:</td>
						<td class="td1">'.$datapro['telp'].'</td>
					</tr>
					<tr>				
						<td class="td2">Email</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['email'].'</td>
					</tr>
					<tr>				
						<td class="td1">Jasa & Speed</td>
						<td class="td1">:</td>
						<td class="td1">'.$datapro['jasa'].'</td>
					</tr>
                                        <tr>				
						<td class="td1">Bandwidth</td>
						<td class="td1">:</td>
						<td class="td1">'.$datapro['akses_speed'].'</td>
					</tr>
					';
					if($level=='Sales' || $bagian=='Finance' || $level=='Super Admin' || $level=='BOD' || $bagian=='AR'){
					$rupiah1 =$datapro['currency'].' '.number_format($datapro['biayain'],0, ",",".");
					$rupiah2 =$datapro['currency'].' '.number_format($datapro['biayabul'],0, ",",".");
					echo '
					<tr>				
						<td class="td1" valign="top">Biaya Instalasi</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$rupiah1.'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Biaya Bulanan</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$rupiah2.'</td>
					</tr>
					';
					}
					
					echo '
					<tr>				
						<td class="td2">Tgl. Ready For Service</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['tglrfs'].'</td>
					</tr>
					<tr>				
						<td class="td1" valign="top">Keterangan</td>
						<td class="td1" valign="top">:</td>
						<td class="td1">'.$datapro['keterangan'].'</td>
					</tr>
                                        <tr>				
						<td class="td2">Barang Input dari Sales</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['barang'].'</td>
					</tr>

                                        <tr>				
						<td class="td2">Barang yang diperlukan</td>
						<td class="td2">:</td>
						<td class="td2">';
                                                while($brim=mysql_fetch_array($eksbrim)){
                                                echo '- '.$brim['merk'].' '.$brim['type'].'<br>';
                                                }
echo '</td>
					</tr>
					<tr>				
						<td class="td2">Nama Sales</td>
						<td class="td2">:</td>
						<td class="td2">'.$datapro['nama_sales'].'</td>
					</tr>
					</table>';
        if($level=='Engineer' && $datapro['status_spk']=='NOK'){echo '<a href="folprov.php?noim='.$datapro['noim'].'" class="butfol">Followup</a>';}

echo '
					</div>';

					
?>
