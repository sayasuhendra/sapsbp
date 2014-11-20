<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  
  
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
		<h3 class="judulok">Proses Internal Memo BOD</h3>
		
		<?php
		
		include "koneksi.php";
		$area=$_POST['area'];
        $jenpek=$_POST['jenpek'];
		include "roma.php";
		$waktuok=date('Ymd');
		$pilihfpb="select * from instal_im where jenis_pekerjaan='$jenpek'";
		$eksfpb=mysql_query($pilihfpb);
		$datano=mysql_fetch_row($eksfpb);
		if($datano==0){
		
		$nourut1=0001;
		$nourutok1=sprintf("%04s",$nourut1);
		$nofpb='SBP/FPB/BOD/'.$waktuok.'/'.$nourutok1;
		$nourut='1';
		$nourutok=sprintf("%04s",$nourut);
		}
		else if($datano >= 1){
		$pilihim="select * from instal_im where jenis_pekerjaan='$jenpek'";
		$eksim=mysql_query($pilihim);
		while($datafpb=mysql_fetch_array($eksim)){
		$nourut1=$datafpb['nourut'] + '1';
		$nourutok1=sprintf("%04s",$nourut1);
		$nofpb='SBP/FPB/BOD/'.$waktuok.'/'.$nourutok1;
		$nourut=$datafpb['nourut'] + '1';
		$nourutok=sprintf("%04s",$nourut);
		}
		}
		
		date_default_timezone_set('Asia/Jakarta');
		$noim=$nourutok.'/SBP-'.$area.'/BOD/'.$roma.'/'.$tahun;
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$telp=$_POST['telp'];
		$jasa=$_POST['services'];
		$keterangan=$_POST['keterangan'];
		$tujuan=$_POST['tujuan'];
		$status=$_POST['status'];
		$sales=$_POST['namasales'];
		$kec=$_POST['speed'];
		$bwsatuan=$_POST['bwsatuan'];
		$speed=$kec.' '.$bwsatuan;
		$statim=$_POST['status_im'];
		$stattm=$_POST['status_tm'];
		$statfin=$_POST['status_fin'];
		$statclose=$_POST['status_close'];
		$statinven=$_POST['status_inven'];
		$email=$_POST['email'];
		$barang=$_POST['barang'];
		$media=$_POST['media'];
        $cur=$_POST['cur'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		$hargabw=$_POST['hargabw'];
		$hargasatuan=$_POST['hargasatuan'];
		$hargaper=$hargabw.'/'.$hargasatuan;
		$totalbiaya=$_POST['totalbiaya'];
		$biayalain=$_POST['biayalain'];
		$tglselesai=$_POST['tglselesai'];
		$tglmulai=$_POST['tglmulai'];
		$jangka=$_POST['jangka'];
		$totbia=$totalbiaya+$biayalain;
		$jangkasatuan=$_POST['jangkasatuan'];
		$jangkagab=$jangka.' '.$jangkasatuan;
		$ketharga='BOD Untuk '.$namapers.' Selama '.$jangkagab.' terhitung mulai tgl '.$tglmulai.' sampai dengan '.$tglselesai.' Dengan Kecepatan '.$speed.'. Harga per'.$hargasatuan.' sebesar : '.$cur.'.'.number_format($hargabw,0,",",".").'. dengan tambahan biaya lain sebesar : '.$cur.' '.number_format($biayalain,0,",",".").'. Sehingga Total biaya untuk BOD ini sebesar : '.$cur.' '.number_format($totbia,0,",",".");
		
		
		$inputdata="INSERT INTO instal_im (kettambah,currency,tglupim,tglim,status_inven,media_akses,barang,akses_speed,status_im,status_tm,status_fin,status_close,jenis_pekerjaan,noim,nourut,nofpb,namapers,alamat,cp,telp,email,jasa,keterangan,tujuan,status,nama_sales) VALUES ('$ketharga','$cur','$waktu','$tanggal','$statinven','$media','$barang','$speed','$statim','$stattm','$statfin','$statclose','$jenpek','$noim','$nourutok1','$nofpb','$namapers','$alamat','$cp','$telp','$email','$jasa','$keterangan','$tujuan','$status','$sales')";
		$query=mysql_query($inputdata);
		
		$inputmemo="INSERT INTO internal_memo (tglupim,tglstart,noim,namapers,jenpek,tgl_req,orderby,status_im,status_tm,status_fin,status_close,status_inven) VALUES ('$waktu','$selisih2','$noim','$namapers','$jenpek','$tglmulai','$sales','$statim','$stattm','$statfin','$statclose','$statinven')";
		$querymemo=mysql_query($inputmemo);
		
		$isireport='Internal Memo BOD (Bandwidth on Demand) Baru telah di kirim oleh <b>'.$sales.'</b> untuk perusahaan <b>'.$namapers.'</b>. Dengan layanan jasa yang di pilih adalah <b>'.$jasa.'</b>. Selama '.$jangkagab.' dari tanggal '.$tglmulai.' sampai tanggal '.$tglselesai.' Untuk kontak person bisa menghubungi <b>'.$cp.'</b> di Nomor '.$telp.'';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$sales','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihtm="select * from usr_tb where level='DCO'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$to=$emailtm;
       		$from = "SAPSBP";
                $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: sap@sbp.net.id \r\n";
		$subject = "Installation Project [".$noim."] ".$namapers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">
                                  Ada Internal Memo Baru BOD dari team sales, silahkan login ke SAP untuk follow up</p>';
		
		$message .='
		</body>
		</html>';
		mail($to,$subject,$message,$headers);                

		}
			
		echo '<p>Terimakasih '.$sales.' data internal memo BOD sudah di kirimkan ke departement DCO  untuk segera ditindaklanjuti</p>
		<p>Adapun detail dari internal memo adalah sbb :</p>
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>No FPB</td>
				<td>:</td>
				<td>'.$nofpb.'</td>
			</tr>
			<tr>				
				<td>Nama Perusahaan</td>
				<td>:</td>
				<td>'.$namapers.'</td>
			</tr>
			<tr>				
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td>'.$alamat.'</td>
			</tr>
			<tr>				
				<td>Kontak Person</td>
				<td>:</td>
				<td>'.$cp.'</td>
			</tr>
			<tr>				
				<td>Telp / HP</td>
				<td>:</td>
				<td>'.$telp.'</td>
			</tr>
			<tr>				
				<td>Email</td>
				<td>:</td>
				<td>'.$email.'</td>
			</tr>
			<tr>				
				<td>Jasa & Speed</td>
				<td>:</td>
				<td>'.$jasa.'</td>
			</tr>
			<tr>				
				<td>Tgl. Mulai</td>
				<td>:</td>
				<td>'.$tglmulai.'</td>
			</tr>
			<tr>				
				<td>Tgl. Berakhir</td>
				<td>:</td>
				<td>'.$tglselesai.'</td>
			</tr>
			<tr>				
				<td valign="top">Keterangan</td>
				<td valign="top">:</td>
				<td>'.$keterangan.'</td>
			</tr>
			
		</table>
		';
		
		?>
		
		
				
			
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>