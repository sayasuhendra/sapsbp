<?php 

echo '
	<h3 class="judulok">Data Request Barang Assignment</h3>
	<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
                                
				<td class="tdhead2">Followup</td>
			</tr>';
	$sqlCount = "select count(id_barang) from barang where statustm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statustm='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				  }				  }
			  echo "</ul></div>";

			  ?>