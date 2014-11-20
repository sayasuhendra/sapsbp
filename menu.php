<div id="menu">
	<div class="white">
	<?php
			$level=$_SESSION['level'];
			$bagian=$_SESSION['bagian'];
			$username=$_SESSION['username'];
	echo '
	<ul id="mega-menu-9" class="mega-menu">
	
		';
		if($level=='Staff' && $bagian=='Sales' || $level=='Manajer' && $bagian=='Sales'){
		echo '
		<li><a href="reqpro.php">Home</a></li>
		
		<li><a href="#">Internal memo</a>
			<ul>
			<li><a href="createsurvey.php">Survey</a></li>
			<li><a href="createim.php">Instalasi</a></li>
			<li><a href="createbod.php">BOD</a></li>
            <li><a href="mutasi.php"> Mutasi</a></li>
			<li><a href="upload-fpc.php">FPC</a></li>';
				if($username=='stephanus'){

					echo '<li><a href="cabutim.php">Cabut</a></li>';

				}
			echo '
			
			</ul>
		</li>
		<li><a href="assi.php">Assignment</a></li>
		<li><a href="#">Project Progress</a>
			<ul>
                <li><a href="surpro.php">Survey Project</a></li>
				<li><a href="reqpro.php">Installation Progress</a></li>
				<li><a href="bodpro.php">BOD Project</a></li>
                <li><a href="mutpro.php">Mutasi Project</a></li> 
				<li><a href="terpro.php">Terminate Progress</a></li>
				<li><a href="isopro.php">Isolir Progress</a></li>
				<li><a href="finpro.php">Finished Project</a></li>
				<li><a href="allrejpro.php">Rejected Project</a></li>
			</ul>
		</li>
			';
		}
		else if($level=='Staff' && $bagian=='Finance' || $level=='Manajer' && $bagian=='Finance' || $level=='Staff' && $bagian=='AP' || $level=='Staff' && $bagian=='AR'){
		echo '
		<li><a href="assi.php">Home</a></li>
		<li><a href="billpro.php">On Billing Client</a></li>';
                if($level=='Manajer' && $bagian=='Finance'){
echo '<li><a href="data-barang.php">Data Stock Barang</a></li>';
}  
echo '
		<li><a href="#">Internal memo</a>
		<ul>
			<li><a href="cabutim.php">Terminasi / Isolir </a></li></ul>
		</li>
		<li><a href="assi.php">Assignment</a></li>
		<li><a href="#">Project Progress</a>
				<ul>
                    <li><a href="surpro.php">Survey Project</a></li>
					<li><a href="reqpro.php">Installation Progress</a></li>
					<li><a href="bodpro.php">BOD Project</a></li>
                    <li><a href="mutpro.php">Mutasi Project</a></li>  
					<li><a href="terpro.php">Terminate Progress</a></li>
					<li><a href="isopro.php">Isolir Progress</a></li>
					<li><a href="finpro.php">Finished Project</a></li>
					<li><a href="allrejpro.php">Rejected Project</a></li>
				</ul>
			</li>
		';
		}
		else if($level=='Staff' && $bagian=='Inventory' || $level=='Manajer' && $bagian=='Inventory'){
		echo '
		<li><a href="assi-inven.php">Home</a></li>
		<li><a href="assi-inven.php">Assignment</a></li>
		<li><a href="data-barang.php">Data Stock Barang</a></li>
		<li><a href="#">Project Progress</a>
				<ul>
                    <li><a href="surpro.php">Survey Project</a></li>
					<li><a href="reqpro.php">Installation Progress</a></li>
					<li><a href="bodpro.php">BOD Project</a></li>
                    <li><a href="mutpro.php">Mutasi Project</a></li>  
					<li><a href="terpro.php">Terminate Progress</a></li>
					<li><a href="isopro.php">Isolir Progress</a></li>
					<li><a href="finpro.php">Finished Project</a></li>
					<li><a href="allrejpro.php">Rejected Project</a></li>
				</ul>
			</li>
		';
		}
		else if($level=='Manajer' && $bagian=='Teknikal' || $level=='Super Admin' && $bagian=='Umum' || $level=='BOD' && $bagian=='Umum'){
		echo '
		<li><a href="assi.php">Home</a></li>
			<li><a href="#">Internal memo</a>
				<ul>
				<li><a href="createsurvey.php">Survey</a></li>
				<li><a href="createim.php">Instalasi</a></li>
				<li><a href="createbod.php">BOD</a></li>
                <li><a href="mutasi.php"> Mutasi</a></li>
				<li><a href="cabutim.php">Cabut</a></li>
				</ul>
			</li>
			<li><a href="assi.php">Assignment</a></li>
			<li><a href="#">Project Progress</a>
				<ul>
                    <li><a href="surpro.php">Survey Project</a></li>
					<li><a href="reqpro.php">Installation Progress</a></li>
					<li><a href="bodpro.php">BOD Project</a></li>
                    <li><a href="mutpro.php">Mutasi Project</a></li>    
					<li><a href="terpro.php">Terminate Progress</a></li>
					<li><a href="isopro.php">Isolir Progress</a></li>
					<li><a href="finpro.php">Finished Project</a></li>
					<li><a href="allrejpro.php">Rejected Project</a></li>
				</ul>
			</li>
                        <li><a href="editeng.php">Edit Engineer Area</a></li>
		<li><a href="data-barang.php">Data Stock Barang</a></li>
		';
		}		
		else if($level=='Staff' && $bagian=='Teknikal' || $level=='Staff' && $bagian=='DCO' || $level=='Engineer' && $bagian=='Teknikal' || $level=='Condev' && $bagian=='Teknikal'){
		echo '
		<li><a href="reqpro.php">Home</a></li>
			<li><a href="assi.php">Assignment</a></li>
			<li><a href="#">Project Progress</a>
				<ul>
                    <li><a href="surpro.php">Survey Project</a></li>
					<li><a href="reqpro.php">Installation Progress</a></li>
					<li><a href="bodpro.php">BOD Project</a></li>
                    <li><a href="mutpro.php">Mutasi Project</a></li> 
					<li><a href="terpro.php">Terminate Progress</a></li>
					<li><a href="isopro.php">Isolir Progress</a></li>
					<li><a href="finpro.php">Finished Project</a></li>
					<li><a href="allrejpro.php">Rejected Project</a></li>
				</ul>
			</li>
    			<li><a href="editeng.php">Edit Pelaksana</a></li>
       			<li><a href="datavendor.php">Data Vendor</a></li> 
		';
			if ($bagian=='DCO' ) {
				echo '<li><a href="editvendor.php">Edit Vendor</a></li>';
				
			}
		}
		
		if($level=='Super Admin' && $bagian=='Umum' || $level=='BOD' && $bagian=='Umum'){
		echo '
		<li><a href="um.php">User Management</a></li>';
		}
		
		echo '
			<li><a href="#">Request Barang</a>
				<ul>';
				if($level=='Manajer'){echo '
				<li><a href="assibr.php">Assignment</a></li>';
				}else if($level=='Staff' && $bagian=='Finance'){echo '
				<li><a href="assibrfin.php">Assignment</a></li>';
				}else if($level=='Staff' && $bagian=='Teknikal'){echo '
				<li><a href="datarevisi.php">Revisi Request</a></li>';
				}
				
			echo '
					<li><a href="reqbrpro.php">Progress Request</a></li>
					<li><a href="formreqbr.php">Form Request Barang</a></li>
				</ul>
			</li>
			<li><a href="editpas.php?username='.$username.'">Change Password</a></li>
         		<li><a href="datapelanggan.php">Data Pelanggan</a></li>
';
		
		
			?>
	</ul>
			</div>	
			</div>
