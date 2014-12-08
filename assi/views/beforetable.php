<?php

	echo '
        <p style="margin-bottom:-15px; color : #ED2024">Selamat datang <b>'.$nama_lengkap.' !</b> </p>
	<h3 class="judulok">Data Internal Memo Assignment</h3>
        <table width="600px" border="0px" cellspacing="10px" style="margin:-10px 10px 10px -10px;">
		<tr>
			<td><img src="images/sevenday.png"></td>
		
		
			<td><img src="images/fourday.png"></td>
		
			<td><img src="images/aman.png"></td>
		</tr>
		
		
	</table>
	<form name="pilih" method="GET" action="assiurut.php">

	    <select onchange="this.form.submit()" name="tgl" id="confirmThis" style="margin-top : -10px; margin-bottom:10px">
		<option value="">Tampilkan Berdasarkan</option>
		<option value="rfslama">Tanggal RFS Terlama</option>
		<option value="rfsbaru">Tanggal RFS Terbaru</option>
		<option value="update">Last Update</option>
		</select>
		
	</form>
';

?>