<?php

echo '
<h3>BAO</h3>
		<div>';
		$noim2=$_GET['noim'];
		include "koneksi.php";
		$pilihfpa2="SELECT * FROM instal_im WHERE noim='$noim2'";
		$eksfpa2=mysql_query($pilihfpa2);
		$datafpa2=mysql_fetch_array($eksfpa2);
		$waktu=date('d-F-Y');
		$namaclient=$datafpa2['namapers'];
		$noba=str_replace("/Instal/","/Instal/BA/","$noim2");
		$pilihbao="select * from upload_bao where noim='$noim2'";
		$eksbao=mysql_query($pilihbao);
		$databao=mysql_fetch_array($eksbao);
                $baof=$databao['file_bao']; 
                $filebao=str_replace("'", "\'", $baof);
                
		echo '<h3 class="judulok">Form Berita Acara :<b>&nbsp;'.$namaclient.'</b></h3>
		<p style="font-size:12px; font-family:arial; margin-top:-15px;">Klik lambang PDF untuk melihat BAO</p>
		';
		echo '<a href="bao/'.$filebao.'" target="_blank"><img class="perimage" width="120px" src="images/pdf-icon.png" border="0px"></a>';
		
		
		echo'
		
</div>';

?>


