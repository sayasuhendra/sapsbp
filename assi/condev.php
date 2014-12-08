<?php 

	$sqlCount = "select count(id_imin) from instal_im where status_close='NOK' AND tujuan='Team Condev'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' AND tujuan='Team Condev' order by id_imin limit $mulai_dari, $limit";
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
				<td class="tdisi"><a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi"><a target="_blank" href="print-bao.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
                                <td class="tdisi">'.$dataim['tujuan'].'</td>';
                                 if($dataim['jenis_pekerjaan']=='Instalasi'){
                                echo '<td class="tdisi"><a href="report-condev.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<td class="tdisi"><a href="report-term.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Survey'){
                                echo '<td class="tdisi"><a href="report-survey.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '

			</tr>
	';
	}
	
	echo '</table>';

?>