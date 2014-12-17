<?php

    $termkus="select * from instal_im";
    $ekskus=mysql_query($termkus);
    $daterm=mysql_fetch_array($ekskus);
    if($daterm['jenis_pekerjaan']=='Terminasi'){
    $sqlCount = "select count(id_imin) from instal_im where status_fin='OK' AND status_tm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_fin='OK' AND status_tm='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	
	$pilihfpa="select * from fpa_tb where noim='$noim'";
	$eksfpa=mysql_query($pilihfpa);
	$noimfpa=mysql_fetch_row($eksfpa);
	
	
	}else{
    $sqlCount = "select count(id_imin) from instal_im where status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	
	
	
	}
	while($dataim=mysql_fetch_array($eksim)){
	
	$dudatepra=substr($dataim['tglrfs'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tglrfs'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tglrfs'],-4);


		switch($dunamebln2)
		{
		case "January" : $namaBln = "01";
					 break;
		case "February" : $namaBln = "02";
					 break;
		case "March" : $namaBln = "03";
					 break;
		case "April" : $namaBln = "04";
					 break;
		case "May" : $namaBln = "05";
					 break;
		case "June" : $namaBln = "06";
					 break;
		case "July" : $namaBln = "07";
					 break;
		case "August" : $namaBln = "08";
					 break;
		case "September" : $namaBln = "09";
					 break;
		case "October" : $namaBln = "10";
					 break;
		case "November" : $namaBln = "11";
					 break;
		case "December" : $namaBln = "12";
					 break;
					 
		}
	
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
	
	$noimpra=$dataim['noim'];
	$pilihfpa="select * from fpa_tb where noim='$noimpra'";
	$eksfpa=mysql_query($pilihfpa);
	$noimfpa=mysql_fetch_row($eksfpa);
	
	echo '
        
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';


                    if($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_im']=='OK'){echo '<a href="formfpac.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
					elseif($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_im']=='NOK'){echo '<img src="images/follow2.png">';}
	                elseif($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}				
	                elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='NOK' && $noimfpa<=0){echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
					elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='NOK' && $noimfpa>0){echo '<img src="images/follow2.png">';}
					elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='OK' && $dataim['statvendor']==''){echo '<a href="upvendor.php?noim='.$dataim['noim'].'"><img src="images/editvendor.png"></a>';}
				
                    elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}

					elseif($dataim['jenis_pekerjaan']=='BOD' && $dataim['status_tm']=='NOK' && $noimfpa>0){echo '<img src="images/follow2.png">';}

                    elseif($dataim['jenis_pekerjaan']=='BOD' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}

                    elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='NOK'){echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
					elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='NOK' && $noimfpa>0 ){echo '<img src="images/follow2.png">';}
			        elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='OK' && $noimfpa>0 && $dataim['statvendor']=='' ){echo '<a href="upvendor.php?noim='.$dataim['noim'].'"><img src="images/editvendor.png"></a>';}
					elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}
				elseif($dataim['jenis_pekerjaan']=='Survey'){echo '<a href="appsur.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
				else{
				echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
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