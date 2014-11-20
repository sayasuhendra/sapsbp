<?php
$extfile=substr($datapro['file_topologi'],-3);
echo '
<h3>Topologi</h3>

			<div>';
			if($extfile=='jpg' || $extfile=='JPG' || $extfile=='jpeg' || $extfile=='JPEG' || $extfile=='png' || $extfile=='gif' || $extfile=='PNG' || $extfile=='GIF'){
			echo '<a href="topologi/'.$datapro['file_topologi'].'" target="_blank"><img src="topologi/'.$datapro['file_topologi'].'" width="500px"></a>';
			}else if($extfile==""){
			echo '<p>Maaf, File Topologi Tidak Ada</p>';
			}
			else{
			echo '<p>Toplogi Kemungkinan bukan dalam bentuk image, untuk dapat melihat klik logo PDF di bawah</p>';
			echo '<a href="topologi/'.$datapro['file_topologi'].'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
			}
			echo '
			</div>
			
';
			
?>		
					
