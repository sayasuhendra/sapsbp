<?php

	$sqlCount = "select count(id_imin) from instal_im where tujuan='BOD'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where tujuan='BOD' order by id_imin limit $mulai_dari, $limit";
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
				<td class="tdisi"><a href="folim.php?id_imin='.$dataim['id_imin'].'"><img src="images/follow.png"></a></td>
                <td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>
			</tr>
	';
	}
	
	echo '</table>';
	
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				
				for($i=1; $i<=$banyakHalaman; $i++){

                    if($page != $i){

						echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';

					}else {

						echo "<a style='background-color:#d9d9d9'>$i</a>";

					}

				}

	echo "</ul></div>";

?>