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
		<h3 class="judulok">Proses Internal Memo</h3>
		
		<?php
		
		include "koneksi.php";
		include "roma.php";

		$area=$_POST['area'];
        $jenpek=$_POST['jenpek'];

		$waktuok=date('Ymd');
		$pilihfpb="select * from instal_im where jenis_pekerjaan='$jenpek'";
		$eksfpb=mysql_query($pilihfpb);
		$datano=mysql_fetch_row($eksfpb);

		if($datano==0){
		
			$nourut1=0001;
			$nourutok1=sprintf("%04s",$nourut1);
			$nofpb='SBP/FPB/'.$waktuok.'/'.$nourutok1;
			$nourut='1';
			$nourutok=sprintf("%04s",$nourut);

		}

		else if($datano >= 1){

			$pilihim = "select * from instal_im where jenis_pekerjaan='$jenpek'";
			$eksim = mysql_query($pilihim);

			while($datafpb=mysql_fetch_array($eksim)){

				$nourut1=$datafpb['nourut'] + '1';
				$nourutok1=sprintf("%04s",$nourut1);
				$nofpb='SBP/FPB/'.$waktuok.'/'.$nourutok1;
				$nourut=$datafpb['nourut'] + '1';
				$nourutok=sprintf("%04s",$nourut);

			}
		}
		
		date_default_timezone_set('Asia/Jakarta');
		$noim=$nourutok.'/SBP-'.$area.'/Instal/'.$roma.'/'.$tahun;
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$telp=$_POST['telp'];
		$biayain=$_POST['biayain'];
		$biayabul=$_POST['biayabul'];
		$tglrfs=$_POST['rfs'];
		$jasa=$_POST['services'];
		$tglrfs=$_POST['rfs'];
		$keterangan=$_POST['keterangan'];
		$tujuan=$_POST['tujuan'];
		$status=$_POST['status'];
		$sales=$_POST['namasales'];
		$statim=$_POST['status_im'];
		$stattm=$_POST['status_tm'];
		$statfin=$_POST['status_fin'];
		$statclose=$_POST['status_close'];
		$statinven=$_POST['status_inven'];
		$speed=$_POST['speed'];
		$email=$_POST['email'];
		$barang=$_POST['barang'];
		$spacerack=$_POST['spacerack'];
		$spacehosting=$_POST['spacehosting'];
		$media=$_POST['media'];
        $cur=$_POST['cur'];
		$curbul=$_POST['curbul'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		$lokasi_file=$_FILES['fupload']['tmp_name'];
		$tipe_file=$_FILES['fupload']['type'];
		$nama_file=$_FILES['fupload']['name'];
		$move = move_uploaded_file($lokasi_file,'po/'.$nama_file);



		$tglrfsbaru = new DateTime($tglrfs);
		$tanggalcirid = $tglrfsbaru->format('ymd');
		$cirid = $tanggalcirid . $nourutok;

		
		$inputdata="INSERT INTO instal_im (currency_bul,nomercircuit,currency,popel,tglupim,tglim,status_inven,media_akses,space_rack,space_hosting,barang,biayain,biayabul,akses_speed,status_im,status_tm,status_fin,status_close,jenis_pekerjaan,noim,nourut,nofpb,namapers,alamat,cp,telp,email,jasa,tglrfs,keterangan,tujuan,status,nama_sales) VALUES ('$curbul','$cirid','$cur','$nama_file','$waktu','$tanggal','$statinven','$media','$spacerack','$spacehosting','$barang','$biayain','$biayabul','$speed','$statim','$stattm','$statfin','$statclose','$jenpek','$noim','$nourutok1','$nofpb','$namapers','$alamat','$cp','$telp','$email','$jasa','$tglrfs','$keterangan','$tujuan','$status','$sales')";
		$query=mysql_query($inputdata);
		
		$inputmemo="INSERT INTO internal_memo (tglupim,nomercircuit,tglstart,noim,namapers,jenpek,tgl_req,orderby,status_im,status_tm,status_fin,status_close,status_inven) VALUES ('$waktu','$cirid','$selisih2','$noim','$namapers','$jenpek','$tglrfs','$sales','$statim','$stattm','$statfin','$statclose','$statinven')";
		$querymemo=mysql_query($inputmemo);
		
		$isireport='Internal Memo Baru telah di kirim oleh <b>'.$sales.'</b> untuk perusahaan <b>'.$namapers.'</b>. Dengan layanan jasa yang di pilih adalah <b>'.$jasa.'</b>. Untuk kontak person bisa menghubungi <b>'.$cp.'</b> di Nomor '.$telp.'<br>IM Instalasi [' . $noim . '] dan Circuid ID [' . $cirid . '].';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$sales','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
		
		$pilihtm="select * from usr_tb where level='DCO'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$to=$emailtm;
		$subject = "IM Instalasi [" . $noim . "] dan Circuid ID [" . $cirid . "]." ;
		$message = "Ada internal memo baru dari team sales, silahkan login ke sapsbp untuk lebih detailnya";
		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";

		mail($to,$subject,$message,$headers);
		}
			
		echo '<p>Terimakasih '.$sales.' data internal memo instalasi sudah di kirimkan ke departement DCO  untuk segera ditindaklanjuti</p>
		<p>Adapun detail dari internal memo adalah sbb :</p>
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>No Circuit ID</td>
				<td>:</td>
				<td>' . $cirid . '</td>
			</tr>
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
				<td>Tgl. Ready For Service</td>
				<td>:</td>
				<td>'.$tglrfs.'</td>
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