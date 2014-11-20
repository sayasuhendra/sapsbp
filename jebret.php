 <?php

    include "koneksi.php";
    $pilihim="select * from internal_memo";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih2=$dataim['tglstart'];
	$delta=$selisih1 - $selisih2;
	$dudatepra=substr($dataim['tgl_req'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tgl_req'],2);
    $dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
    $duthn=substr($dataim['tgl_req'],-4);
	
    $bulanaksi=date('F');
	$aneh=date('F');

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
	$dateasik=$duthn.'-'.$namaBln.'-'.$dudatepra;
    
    
	$insertdata="update internal_memo set tglreqok='$dateasik' where noim='$noimbr'";
	$eksdata=mysql_query($insertdata);
    
    echo $dateasik;
    }

    echo "date berhasil di update";
	?>