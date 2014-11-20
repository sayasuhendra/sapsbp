<?php
$extfile=substr($datapro['file_foto'],-3);
echo '
<h3>Foto Perangkat</h3>

			<div>';
			if($extfile=='jpg' || $extfile=='JPG' || $extfile=='jpeg' || $extfile=='JPEG' || $extfile=='png' || $extfile=='gif' || $extfile=='PNG' || $extfile=='GIF'){
			echo '<img src="foto/'.$datapro['file_foto'].'" width="500px">';
			}else if($extfile==""){
			echo '<p>Maaf, File Foto Tidak Ada</p>';
			}
			else{
			echo '<p>Foto Kemungkinan bukan dalam bentuk image, untuk dapat melihat klik logo PDF di bawah</p>';
			echo '<a href="foto/'.$datapro['file_foto'].'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
			}
			echo '
			</div>
			
';
			
?>		
					
