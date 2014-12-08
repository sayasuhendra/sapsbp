<?php

	$sqlCount = "select count(id_imin) from instal_im where status='Pending' AND tujuan='Sales' order by noim desc";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status='Pending' AND tujuan='Sales' order by noim desc limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';if($dataim['jenis_pekerjaan']=='Terminasi'){
				echo '<a href="appiso.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}else if($dataim['jenis_pekerjaan']=='Isolir'){
				echo '<a href="appiso.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
				}
				echo '
				</td>';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '

			</tr>
	';

		}
	
	echo '</table>';

?>