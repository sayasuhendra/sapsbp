<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$level=$_SESSION['level'];
$area=$_SESSION['area'];
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$bulan = $array_bulan[date('n')];
		$tanggal1=date('d');
		$tahun=date('Y');
		$tanggal=$tanggal1.' '.$bulan.' '.$tahun;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery-1.8.3.js"></script>
  
  
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

	<link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-ui.js"></script>
    
	
    <script>
    $(function() {
        $( "#accordion" ).accordion({ active: 2 });
    });
    </script>
</head>

<body>
		
	<div id="isi2">
			<div id="isikiri">
			<?php
			$noim=$_GET['noim'];
			$pilihpro="select * from instal_im where noim='$noim'";
			$ekspro=mysql_query($pilihpro);
			$datapro=mysql_fetch_array($ekspro);
					
		$noim2=$_GET['noim'];
		include "koneksi.php";
		$pilihfpa2="SELECT * FROM instal_im WHERE noim='$noim2'";
		$eksfpa2=mysql_query($pilihfpa2);
		$datafpa2=mysql_fetch_array($eksfpa2);
		$waktu=date('d-F-Y');
		$namaclient=$datafpa2['namapers'];
		$noba=str_replace("/Instal/","/INS/","$noim2");
		echo'
		<form method="post" name="formcari" action="#" style="padding-bottom:30px; margin-top:-115px">
                <input type="button" value="Print"  onClick="window.print()">
		<table width="990px" style="margin-left:-10px">
				   <tr>
					<td valign="top" style="width:990px;">
					 					 
					
					<img src="images/logobaru.png" style="margin-top:-30px; margin-left:240px; ">
					<h3 style="font-family:georgia; margin-left:165px; font-size:19px; margin-top:-6px; color:#3d3c3c;">SURAT PERINTAH TERMINASI</h3> 
					<h3 style="font-family:georgia; margin-left:175px;  font-size:19px; margin-top:-15px; color:#3d3c3c;">'.$noba.'</h3> 
					 
					</td>
				   </tr>
		</table>
		<table style="margin-top:20px;" widt="1024px">
                  <tr>
                    <td colspan="3" style="padding-bottom:-20px; font-size:18px;" >Yang bertandatangan dibawah ini : </td>
                  </tr>
                  <tr>
                   <td style="font-size:18px; padding-top:-10px; width:200px; border-bottom:solid 1px #919394;" colspan="3"></td>
                  </tr>

                  <tr>
                   <td style="font-size:18px; width:200px; padding-top:10px" valign="top">Nama</td><td> :</td><td>'.$datafpa2['nama_sales'].'</td>
                  </tr>

                  <tr>
                    <td colspan="3" style="font-size:18px; padding-bottom:-10px; padding-top:20px">Dengan Ini Memerintahkan Kepada : </td>
                  </tr>
                  <tr>
                   <td style="font-size:18px; padding-top:-10px; width:200px; border-bottom:solid 1px #919394;" colspan="3"></td>
                  </tr>
                  <tr>
                   <td style="font-size:18px; padding-bottom:10px; padding-top:10px" valign="top">Nama</td><td> :</td><td>'.$datafpa2['tujuan'].'</td>
                  </tr>				
                  <tr>
                   <td style="padding-bottom:10px; font-size:18px;" valign="top">Departement</td><td valign="top"> :</td><td valign="top">NOC</td>
                  </tr>				
                  <tr>
                   <td style="padding-bottom:10px; font-size:18px; ">Jenis Pekerjaan</td><td valign="top"> :</td><td valign="top">Pencabutan Perangkat Internet</td>
                  </tr>				
				  <tr>
                   <td style="padding-bottom:10px; font-size:18px; " colspan="2">Detail Perangkat yang di cabut</td><td valign="top">:</td>
                  </tr>				
				  <tr>
				  </table>
				  <table cellspacing="0">
				  <tr>
                   <td>
						<tabel border="1px" cellspacing="0">
							<tr>
								<td style="border:solid 1px #5a5858; width:30px; text-align:center">No</td>
								<td style="border:solid 1px #5a5858; border-left:0px; text-align:center; width:250px">Nama Perangkat</td>
								<td style="border:solid 1px #5a5858; border-left:0px; width:150px; text-align:center">Nomor Seri</td>
								<td style="border:solid 1px #5a5858; border-left:0px; width:100px; text-align:center">Jumlah</td>
							</tr>
							<tr>
								<td style="border:solid 1px #5a5858; border-top:0px; height:10px; width:30px; text-align:center; font-size:12px; padding:5px 0px 5px 0px;">1.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; text-align:center; width:250px; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:150px; text-align:center; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:100px; text-align:center; font-size:1px;">.</td>
							</tr>
							<tr>
								<td style="border:solid 1px #5a5858; border-top:0px; height:10px; width:30px; text-align:center; font-size:12px; padding:5px 0px 5px 0px;">2.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; text-align:center; width:250px; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:150px; text-align:center; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:100px; text-align:center; font-size:1px;">.</td>
							</tr>
							<tr>
								<td style="border:solid 1px #5a5858; border-top:0px; height:10px; width:30px; text-align:center; font-size:12px; padding:5px 0px 5px 0px;">3.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; text-align:center; width:250px; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:150px; text-align:center; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:100px; text-align:center; font-size:1px;">.</td>
							</tr>
							<tr>
								<td style="border:solid 1px #5a5858; border-top:0px; height:10px; width:30px; text-align:center; font-size:12px; padding:5px 0px 5px 0px;">4.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; text-align:center; width:250px; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:150px; text-align:center; font-size:1px;">.</td>
								<td style="border:solid 1px #5a5858; border-top:0px; border-left:0px; width:100px; text-align:center; font-size:1px;">.</td>
							</tr>
						</table>
				   </td>
                  </tr>
				  
				  </table>
				  <table>
                  <tr>
                   <td style="padding-bottom:10px; font-size:18px; padding-top:20px">Nama Customer</td><td> :</td><td>'.$datafpa2['namapers'].'</td>
                  </tr>				
                  <tr>
                   <td valign="top" style="padding-bottom:10px; font-size:18px;">Alamat</td><td valign="top"> :</td><td>'.$datafpa2['alamat'].'</td>
                  </tr>				
                  <tr>
                   <td style="padding-bottom:10px; font-size:18px;">Telp</td><td> :</td><td>'.$datafpa2['telp'].'</td>
                  </tr>				
                  <tr>
                   <td style="padding-bottom:10px; font-size:18px;">Contact Person</td><td> :</td><td>'.$datafpa2['cp'].'</td>
                  </tr>				
                  
                  <tr>
                   <td style="padding-top:20px; font-size:18px; padding-bottom:5px;" colspan="3">Demikian surat perintah kerja ini dibuat untuk dapat dipergunakan sebagaimana mestinya.	</td>
                  </tr>			
                  <tr>
                   <td style="padding-top:10px; font-size:18px; padding-bottom:10px; text-align:right;" colspan="3">'.$area.' , '. $tanggal.'</td>
                  </tr>			
                  <tr>
                   <td style="padding-bottom:10px; font-size:17px;">Pelaksana SBP</td><td width="30px"></td><td style="text-align:right;">PT. Solusindo Bintang Pratama,</td>
                  </tr>			
                  <tr>
                   <td style="padding-bottom:10px; padding-top:20px; font-size:18px;">'.$datafpa2['tujuan'].'</td><td width="30px"></td><td style="text-align:right;">'.$datafpa2['nama_sales'].'</td>
                  </tr>			
		</table>
		
		</form>

				</div>
			 
				
			 
	</div>
	';
	
	?>
	
</body>
</html>