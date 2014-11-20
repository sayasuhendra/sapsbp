<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
$area=$_SESSION['area'];
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
<script type="text/javascript" src="jquery-ui-1.8.22.custom.min.js"></script>
<link href="css/ui-lightness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
  <script>
	Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"d MM yy"
		};
		
		$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'd MM yy'
			}
		
		);
				
	});

</script>
<script type="text/javascript">

function validasi(){
var namapers=document.form.namapers.value;
if(namapers==""){
alert("Nama Perusahaan Tidak Boleh Kosong !");
document.form.namapers.focus();
return false;
}

var alamat=document.form.alamat.value;
if(alamat==""){
alert("Alamat Tidak Boleh Kosong !");
document.form.alamat.focus();
return false;
}

var cp=document.form.cp.value;
if(cp==""){
alert("Kontak Person Tidak Boleh Kosong !");
document.form.cp.focus();
return false;
}
var telp=document.form.telp.value;
if(telp==""){
alert("No Telepon Tidak Boleh Kosong !");
document.form.telp.focus();
return false;
}
var email=document.form.email.value;
if(email==""){
alert ("Email Tidak Boleh Kosong");
document.form.email.focus();
return false;
}
 str=document.form.email.value;
   filter=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
   if (filter.test(str)!=true)
   {
   alert("Format Penulisan email anda salah, contoh format penulisan email yang benar : ponco@yahoo.com atau kontak@pancaweb.com!");
   document.form.email.focus();
   return false;
  }

var jenko=document.form.jasa.value;
if(jenko==""){
alert("Jenis Koneksi Tidak Boleh Kosong !");
document.form.jasa.focus();
return false;
}
var speed=document.form.speed.value;
if(speed==""){
alert("Speed Tidak Boleh Kosong !");
document.form.speed.focus();
return false;
}
var rfs=document.form.rfs.value;
if(rfs==""){
alert("Tanggal RFS Tidak Boleh Kosong !");
document.form.rfs.focus();
return false;
}
var barang=document.form.barang.value;
if(barang==""){
alert("Silahkan tulis barang yang di butuhkan untuk project ini!");
document.form.barang.focus();
return false;
}
var biayain=document.form.biayain.value;
if(biayain==""){
alert("Biaya Instalasi Harus Diisi!");
document.form.biayain.focus();
return false;
}
var biayabul=document.form.biayabul.value;
if(biayabul==""){
alert("Biaya Bulanan Harus Diisi!");
document.form.biayabul.focus();
return false;
}
return true;
}
</script>
</head>

<body>
	
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	<?php
		include "koneksi.php";
		$waktu=date("Ymd");
		$namapers=$_POST['namapers'];
		$noim=$_POST['noim'];
		$status=$_POST['status'];
		$keterangan=$_POST['keterangan'];
		$statusok='OK';
		$tanggal=date('d F Y');;
		$jam=date('h:i:s');
		$waktu=$tanggal.', Jam : '.$jam;
		$nofpb=$_POST['nofpb'];
		$namsel=$_POST['namsel'];
		
	    $upreject="update instal_im set status='Rejected', status_im='$statusok', status_tm='$statusok', status_fin='$statusok', status_inven='$statusok', status_spk='$statusok', status_close='$status', kettambah='$keterangan' where noim='$noim'";
		$proupreject=mysql_query($upreject);
		
		$uprejectmemo="update internal_memo set status_im='$statusok', status_tm='$statusok', status_fin='$statusok', status_inven='$statusok', status_spk='$statusok', status_close='$status' where noim='$noim'";
		$prouprejectmemo=mysql_query($uprejectmemo);
		
		$isi='Project untuk '.$namapers.' dengan No IM : '.$noim.' telah di close oleh '.$namauser.' Dengan keterangan : '.$keterangan;
		
		$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$namauser','$waktu','$isi','$noim')";
		$queryreport=mysql_query($inputreport);
		
		$pilihreport="select * from report_pro where noim='$noim' order by idreport DESC limit 5";
		$eksreport=mysql_query($pilihreport);
		
		$pilihtm="select * from usr_tb where nama_lengkap='$namsel'";
		$ekstm=mysql_query($pilihtm);
		$tm=mysql_fetch_array($ekstm);
		$emailtm=$tm['email'];
		
        $to=$emailtm;
		$from = "SAPSBP";
		$headers = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: sap@sbp.net.id \r\n";		
		$subject = " Project ".$namapers. "Rejected";
		$message = '<html><body><p>Project untuk Perusahaan '.$namapers.' telah di cancel / reject oleh '.$namauser.'</p><p>Dengan Alasan '.$keterangan.' </p>
                <h3 style="font-weight:bold; font-size: 14px;">History Progress</h3><table>';

		
		
			while($datareport=mysql_fetch_array($eksreport)){
									$message .= '
							<tr>
								<td class="tdcomment">
									<p style="font-size : 11px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; margin-bottom : 10px;
color : #3B3B3B; border-top-left-radius: 3px; border-top-right-radius: 3px; "><b>'.$datareport['nama_user'].'</b>, '.$datareport['tgl'].' </p>
									<p style="font-size : 12px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; color : #3B3B3B;
margin-bottom : 15px; background-color : #edebeb; padding : 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; ">"'.$datareport['isi_report'].'"</p>
									
								</td>
							</tr>';}
		
		$message .= '
		</body>
		</html>';
		
		mail($to,$subject,$message,$headers);
		
		echo 'Terima kasih project sudah berhasil di reject';
		
		
			?>
			
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>