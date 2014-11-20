<?php
echo '
<h3>Dokumen Pendukung</h3>
		<div>';
		$noimpoven=$_GET['noim'];
		include "koneksi.php";
		$pilihpoven="SELECT * FROM instal_im WHERE noim='$noimpoven'";
		$ekspoven=mysql_query($pilihpoven);
		$datapoven=mysql_fetch_array($ekspoven);
		$namaclient=$datapoven['namapers'];
		$docven=$datapoven['povendor'];
		$docpel=$datapoven['popel'];

		echo '<table border="0px" cellpadding="10px">

			<tr>
				<td>PO Vendor</td>			
				<td>PO Pelanggan</td>			
			</tr>

			<tr>
				<td>'; 
			if($docven==""){ echo 'Maaf, Tidak ada PO Vendor';

			}else{
			echo '<a href="po/'.$docven.'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
			}
				echo '</td>			
				<td>'; 

			if($docpel==""){ echo 'Maaf, Tidak ada PO dari Pelanggan';

			}else{
			echo '<a href="po/'.$docpel.'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
			}

echo '</td>			
			</tr>


		      </table>';                
		
		
		echo'
		
</div>';

?>


