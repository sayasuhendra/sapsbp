<?php

$sqlCount = "select count(id_imin) from instal_im where status_close='NOK' AND tujuan='$nama_lengkap'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' AND tujuan='$nama_lengkap' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	$dudatepra=substr($dataim['tglrfs'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tglrfs'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tglrfs'],-4);


		require 'assi/bulan.php';
	
	$batasakhir=$dudate.'-'.$namaBln.'-'.$duthn;
	$warningrsf=strtotime('-0 day',strtotime($batasakhir));
	
	$batasrfslum=$warningrsf-$jatuhtempo;
	$batasrfs = floor($batasrfslum / 86400);
	if($batasrfs <= 7){
	echo '
			<tr class="tdgawat">';
	}else if($batasrfs >= 7 && $batasrfs <= 14){
	echo '
			<tr class="tdwarning">';
	}else if($batasrfs > 14){
	echo '
			<tr style="background-color:none;">';
	}
	echo '

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<a target="_blank" href="print-spkterm.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                }else{echo '<a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                }
                                echo '
				<td class="tdisi"><a target="_blank" href="print-bao.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                if($dataim['jenis_pekerjaan']=='Instalasi'){
                                echo '<td class="tdisi"><a href="report-bao.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<td class="tdisi"><a href="report-term.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Mutasi'){
                                echo '<td class="tdisi"><a href="report-mut.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Survey'){
                                echo '<td class="tdisi"><a href="report-survey.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='BOD'){
                                echo '<td class="tdisi"><a href="reportbod.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
				
			</tr>
	';
	}
	
	echo '</table>';

?>