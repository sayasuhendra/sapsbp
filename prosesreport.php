<?php
		ob_start('ob_gzhandler');                
		include "koneksi.php";
		date_default_timezone_set('Asia/Jakarta');
		
		$noim=$_POST['noim'];
		$nofpb=$_POST['nofpb'];
		$user_report=$_POST['user_report'];
		$tanggal=date('d F Y');;
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam : '.$jam;
		$isi=$_POST['isireport'];
		$remind=$_POST['remind'];
		$tglremind=$_POST['tglremind'];
		$jamremind=$_POST['jamremind'];
		$pesanremind=$_POST['pesanremind'];
		
		$pilihpers="select * from instal_im where noim='$noim'";
		$ekspers=mysql_query($pilihpers);
		$pers=mysql_fetch_array($ekspers);
		$namapers=$pers['namapers'];
		$namesl=$pers['nama_sales'];
		
		$pilihreport="select * from report_pro where noim='$noim' order by idreport DESC limit 5";
		$eksreport=mysql_query($pilihreport);
		
				
		if($remind=='yes'){
			
		$inputremind="insert into tb_remind (noim,nama,tglremind,jamremind,pesanremind) values('$noim','$user_report','$tglremind','$jamremind','$pesanremind')";
		$eksinputremind=mysql_query($inputremind);
		
		
		$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$user_report','$waktu','$isi','$noim')";
		$queryreport=mysql_query($inputreport);
		$dco='DCO';
		
		
        $pilihrandom="select * from report_pro inner join usr_tb on report_pro.nama_user=usr_tb.nama_lengkap where report_pro.noim='$noim' order by report_pro.idreport DESC";
		$eksrandom=mysql_query($pilihrandom);

		while($datarandom=mysql_fetch_array($eksrandom)){
		$emailrandom=$datarandom['email'];
		$ccrand .=$emailrandom.',';
		}		
		
        $pilihtm2="select * from usr_tb where nama_lengkap='$namesl'";
		$ekstm2=mysql_query($pilihtm2);
        $tm2=mysql_fetch_array($ekstm2);
        $emailtm2=$tm2['email'];

		$pilihtm="select * from usr_tb where bagian='$dco'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$cc .=$emailtm.',';
		}
		
        $to=$emailtm2;
		$from = "SAPSBP";
        $headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Noim: " .$noim. "\r\n";
        $headers .= "Bcc: ".$ccrand."\r\n";
        $headers .= "Cc: ".$cc."\r\n";		
		$subject = "Update Progress [".$noim."] ".$namapers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">Update Report : '.$namapers.' </p>
<p style="font-size : 11px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; margin-bottom : 10px;
color : #3B3B3B; border-top-left-radius: 3px; border-top-right-radius: 3px; "><b>'.$user_report.'</b>, '.$datareport['tgl'].' </p>
<p style="font-size : 12px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; color : #3B3B3B;
margin-bottom : 15px; background-color : #edebeb; padding : 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; ">"'.$isi.'"</p>
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
							</tr>';
		}
		
		$message .='
		</body>
		</html>';
		mail($to,$subject,$message,$headers);
		
		
		
		header ('location:detailim.php?noim='.$noim);
		

		}else{
		
		include "koneksi.php";
		
		$inputreport="INSERT INTO report_pro (nofpb,nama_user,tgl,isi_report,noim) VALUES ('$nofpb','$user_report','$waktu','$isi','$noim')";
		$queryreport=mysql_query($inputreport);
		$dco='DCO';
        
		$pilihtm2="select * from usr_tb where nama_lengkap='$namesl'";
		$ekstm2=mysql_query($pilihtm2);
        $tm2=mysql_fetch_array($ekstm2);
        $emailtm2=$tm2['email'];
		
		$pilihrandom="select * from report_pro inner join usr_tb on report_pro.nama_user=usr_tb.nama_lengkap where report_pro.noim='$noim' order by report_pro.idreport DESC";
		$eksrandom=mysql_query($pilihrandom);
		while($datarandom=mysql_fetch_array($eksrandom)){
		$emailrandom=$datarandom['email'];
		$ccrand .=$emailrandom.',';
		}
		
        $pilihtm="select * from usr_tb where nama_lengkap='$namesl' or bagian='$dco'";
		$ekstm=mysql_query($pilihtm);
		while($tm=mysql_fetch_array($ekstm)){
		$emailtm=$tm['email'];
		$cc .=$emailtm.',';
		}
                $to=$emailtm2;
		$from = "SAPSBP";
                $headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
                $headers .= "Bcc: ".$ccrand."\r\n";
                $headers .= "Cc: ".$cc."\r\n";		
		$subject = "Update Progress [".$noim."] ".$namapers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">Update Report : '.$namapers.' </p>
<p style="font-size : 11px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; margin-bottom : 10px;
color : #3B3B3B; border-top-left-radius: 3px; border-top-right-radius: 3px; "><b>'.$user_report.'</b>, '.$datareport['tgl'].' </p>
<p style="font-size : 12px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; color : #3B3B3B;
margin-bottom : 15px; background-color : #edebeb; padding : 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; ">"'.$isi.'"</p>
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
							</tr>';
		}
		
		$message .='
		</body>
		</html>';
		mail($to,$subject,$message,$headers);
		
		
				
		header ('location:detailim.php?noim='.$noim);
		}
		
?>
