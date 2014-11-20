<?php
$extfile=substr($datapro['file_speed'],-3);
echo '
<h3>Speedtest</h3>

			<div>';
			if($extfile=='jpg' || $extfile=='JPG' || $extfile=='jpeg' || $extfile=='JPEG' || $extfile=='png' || $extfile=='gif' || $extfile=='PNG' || $extfile=='GIF'){
			echo '<a href="speedtest/'.$datapro['file_speed'].'" target="_blank"><img src="speedtest/'.$datapro['file_speed'].'" width="500px"></a>';
			}else if($extfile==""){
			echo '<p>Maaf, File Speedtest Tidak Ada</p>';
			}
			else{
			echo '<p>File Speedtest Kemungkinan bukan dalam bentuk image, untuk dapat melihat klik logo PDF di bawah</p>';
			echo '<a href="speedtest/'.$datapro['file_speed'].'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
			}
			echo '
			</div>
			
';
			
?>		
					
