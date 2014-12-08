<?php

echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead" width="350px">No FPB / No FPC</td>
				<td class="tdhead" width="300px">Nama Perusahaan</td>
     			<td class="tdhead" width="200px">Tgl RFS</td>
				<td class="tdhead" width="300px">Jenis Pekerjaan</td>
				<td class="tdhead">Order By</td>';
		if($level=='Staff' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Print SPK</td>
				<td class="tdhead">Print BAO</td>';
		}else if($level=='Condev' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Print SPK</td>
				<td class="tdhead">Print BAO</td>				
                                <td class="tdhead">Pelaksana</td>';
		}else if($level=='Engineer' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Pelaksana</td>
		<td class="tdhead">Perangkat</td>';
		}
	echo '
		<td class="tdhead">Followup</td>
                                <td class="tdhead2">Detail</td>
	</tr>';

	?>