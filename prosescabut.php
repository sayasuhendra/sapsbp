<?php
include "cek-sesion.php";
include "koneksi.php";
include "roma.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$pilihno="select * from cabut_im";
$eksno=mysql_query($pilihno);
$datano=mysql_fetch_row($eksno);
$jeniscabut=$_POST['jeniscabut'];		
		if($datano<=0 && $jeniscabut=='Isolir'){
		$nourut=0001;
			$nourutok=sprintf("%04s",$nourut);
			$noiso=$nourutok.'/SBP/IM-ISO/'.$roma.'/'.$tahun;
		}elseif($datano<=0 && $jeniscabut=='Terminasi'){
		$nourut=0001;
			$nourutok=sprintf("%04s",$nourut);
			$noiso=$nourutok.'/SBP/IM-TERMINASI/'.$roma.'/'.$tahun;
		}
		else if($datano>=1 && $jeniscabut=='Isolir'){
		$pilihfpb="select * from cabut_im";
		$eksfpb=mysql_query($pilihfpb);
		while($datafpb=mysql_fetch_array($eksfpb)){
		    
			$nourut=$datafpb['nourut'] + '1';
			$nourutok=sprintf("%04s",$nourut);
			$noiso=$nourutok.'/SBP/IM-ISO/'.$roma.'/'.$tahun;
		}
		}elseif($datano>=1 && $jeniscabut=='Terminasi')
		{
		$pilihfpb="select * from cabut_im";
		$eksfpb=mysql_query($pilihfpb);
		while($datafpb=mysql_fetch_array($eksfpb)){
		    
			$nourut=$datafpb['nourut'] + '1';
			$nourutok=sprintf("%04s",$nourut);
			$noiso=$nourutok.'/SBP/IM-TERMINASI/'.$roma.'/'.$tahun;
		}
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
  $(document).ready(function($){
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>
</head>

<body>
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	include "menu.php";
	
	?>
	<div id="isi">
	<?php
		include "koneksi.php";
		$waktu=date("Ymd");
		$pilihcir="select * from customer_data";
		$ekscir=mysql_query($pilihcir);
				
	echo '
		<h3 class="judulok">Proses Internal Memo Isolir</h3>';
				
		$permintaan=$_POST['permintaan'];
		$imiso=$noiso;
		$idpel=$_POST['cirid'];
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$tglreq=$_POST['tglminta'];
		$alasan=$_POST['alasan'];
		$speed=$_POST['speed'];
		$tujuan=$_POST['tujuan'];	
		$status=$_POST['status'];	
		$nosuratkonf=$_POST['nosuratkonf'];	
		$orderby=$_POST['orderby'];	
		$statusim=$_POST['status_im'];	
		$statustm=$_POST['status_tm'];
		$statusfin=$_POST['status_fin'];
		$statusclose=$_POST['status_close'];
		

		$inputdata="INSERT INTO cabut_im (namapers,alamat,cp,tgl_minta,alasan,speed,nopel,permintaan,no_suratkonf,noim,orderby,jenis_pekerjaan,tujuan,nourut,status_im,status_tm,status_fin,status_close) values ('$namapers','$alamat','$cp','$tglreq','$alasan','$speed','$idpel','$permintaan','$nosuratkonf','$imiso','$orderby','$jeniscabut','$tujuan','$nourut','$statusim','$statustm','$statusfin','$statusclose')";
		$query=mysql_query($inputdata);
		
		$inputmemo="INSERT INTO internal_memo (noim,namapers,jenpek,tgl_req,orderby,status_im,status_tm,status_fin,status_close) VALUES ('$imiso','$namapers','$jeniscabut','$tglreq','$orderby','$statusim','$statustm','$statusfin','$statusclose')";
		$querymemo=mysql_query($inputmemo);
		
		$isireport='Internal Memo Baru Untuk Isolir perusahaan <b>'.$namapers.'</b> telah di kirim oleh <b>'.$orderby.'</b>.';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$imiso','$nourut','$orderby','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihtm="select * from usr_tb where level='Staff' AND bagian='Sales'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$to=$emailtm;
		$subject = "IM  Terminasi";
		$message = "Ada internal memo untuk cabut / isolir dari team finance, silahkan login ke sapsbp untuk lebih detailnya";
 		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";

		mail($to,$subject,$message,$headers);
		}
	echo '<p>Terimakasih '.$user.' internal memo untuk isolir pelanggan '.$namapers.' sudah di kirim ke Teknikal Manajer </p>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>';
	?>
</body>
</html>