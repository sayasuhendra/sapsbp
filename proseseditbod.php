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
		
		
		$noim=$_POST['noim'];
                $nofpb=$_POST['nofpb'];
		$namapers=$_POST['namapers'];
		$alamat=$_POST['alamat'];
		$cp=$_POST['cp'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$jasa=$_POST['services'];
		$media=$_POST['media'];
		$kec=$_POST['speed'];
		$tglselesai=$_POST['tglselesai'];
		$tglmulai=$_POST['tglmulai'];
		$jangka=$_POST['jangka'];
		$barang=$_POST['barang'];
		$cur=$_POST['cur'];
		$hargabw=$_POST['hargabw'];
		$totalbiaya=$_POST['totalbiaya'];
		$biayalain=$_POST['biayalain'];
		$keterangan=$_POST['keterangan'];
		$sales=$_POST['namasales'];
		$jenpek=$_POST['jenpek'];
		
		
		$bwsatuan=$_POST['bwsatuan'];
		$hargasatuan=$_POST['hargasatuan'];
		$jangkasatuan=$_POST['jangkasatuan'];
		
		$speed=$kec.' '.$bwsatuan;
		
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam '.$jam;
		$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		$hargaper=$hargabw.'/'.$hargasatuan;
		
		
		$totbia=$totalbiaya+$biayalain;
		
		$jangkagab=$jangka.' '.$jangkasatuan;
		$ketharga='BOD Untuk '.$namapers.' Selama '.$jangkagab.' terhitung mulai tgl '.$tglmulai.' sampai dengan '.$tglselesai.' Dengan Kecepatan '.$speed.'. Harga per'.$hargasatuan.' sebesar : '.$cur.'.'.number_format($hargabw,0,",",".").'. dengan tambahan biaya lain sebesar : '.$cur.' '.number_format($biayalain,0,",",".").'. Sehingga Total biaya untuk BOD ini sebesar : '.$cur.' '.number_format($totbia,0,",",".");
		
		
		$updatedata="update instal_im set jenis_pekerjaan='$jenpek', kettambah='$ketharga', currency='$cur',  media_akses='$media', barang='$barang', akses_speed='$speed', namapers='$namapers', alamat='$alamat', cp='$cp', telp='$telp', email='$email', jasa='$jasa', keterangan='$keterangan', nama_sales='$sales' where noim='$noim'";
		$query=mysql_query($updatedata);
		
		$updatememo="update internal_memo set jenpek='$jenpek', namapers='$namapers', tgl_req='$tglmulai', orderby='$sales' where noim='$noim'";
		$querymemo=mysql_query($updatememo);
		
                $isireport='Perubahan Internal Memo BOD (Bandwidth on Demand) dilakukan oleh <b>'.$sales.'</b> untuk perusahaan <b>'.$namapers.'</b>. Dengan layanan jasa yang di pilih adalah <b>'.$jasa.'</b>. Selama '.$jangkagab.' dari tanggal '.$tglmulai.' sampai tanggal '.$tglselesai.' Untuk kontak person bisa menghubungi <b>'.$cp.'</b> di Nomor '.$telp.'';
		$inputreport="INSERT INTO report_pro (noim,nofpb,nama_user,tgl,isi_report) VALUES ('$noim','$nofpb','$sales','$waktu','$isireport')";
		$queryreport=mysql_query($inputreport);
			
		echo '<p>Terimakasih '.$sales.' data internal memo BOD sudah berhasil di edit</p>
		<p>Adapun detail dari internal memo adalah sbb :</p>
		<table class="tbrule" cellspacing="10px">
			
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