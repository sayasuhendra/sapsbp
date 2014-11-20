<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$sqlCount = "select count(usrid) from usr_tb";  
$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
$banyakData = $rsCount[0];  
$page = isset($_GET['page']) ? $_GET['page'] : 1;  
$limit = 7;  
$mulai_dari = $limit * ($page - 1);  
$sql_limit = "select * from usr_tb order by username ASC limit $mulai_dari, $limit";  
$eksuser=mysql_query($sql_limit);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
  <link href="style.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="media/js/jquery.js"></script>
  <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript" src="media/js/dataTables.bootstrap.js"></script>

  <link rel="stylesheet" type="text/css" href="media/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="media/css/dataTables.bootstrap.css"/>

  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>

  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
  	#header {
  		height: 120px;
  		z-index: 100;

  	}
  	.mega-menu {
  		z-index: 300;
  	}
  	#menu{
  	height : 35px;
  	}
  </style>
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
	
	<?php
	include "header.php";
	include "menu.php";
	$sqlCount = "select count(cirid) from customer_new";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 100;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from customer_new";
	$eksim=mysql_query($pilihim);
	
	echo '
	<div id="isi">
		<h3 class="judulok">Data Pelanggan Existing PT Solusindo Bintang Pratama</h3>
		';
		echo '
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			        <thead>
			            <tr>
            				<th>CIRID</th>
            				<th width="350px">Nama Pelanggan</th>
            				<th width="300px">Bandwith Client</th>
                 			<th width="200px">Vendor</th>
            				<th width="300px">Sales</th>
            				<th>Detail</th>
            				<th>Edit</th>
			            </tr>
			        </thead>
			 
			        <tfoot>
			            <tr>
	    					<th>CIRID</th>
	    					<th width="350px">Nama Pelanggan</th>
	    					<th width="300px">Bandwith Client</th>
	    	     			<th width="200px">Vendor</th>
	    					<th width="300px">Sales</th>
	    					<th>Detail</th>
	    					<th>Edit</th>
			            </tr>
			        </tfoot>
			   <tbody>';
	
	while($clientsbp=mysql_fetch_array($eksim)){
	echo '

		<tr>
				<td>'.$clientsbp['cirid'].'</td>
				<td width="350px">'.$clientsbp['nama_perusahaan'].'</td>';
				if($clientsbp['bandwidth_client']==""){
				echo '<td width="300px">-</td>';
				}else{
				echo '<td width="300px">'.$clientsbp['bandwidth_client'].'</td>';
				}echo '
				<td width="200px">'.$clientsbp['nama_vendor'].'</td>';
				if($clientsbp['marketing']==""){
				echo '<td width="300px">-</td>';
				}else{
				echo '<td width="300px">'.$clientsbp['marketing'].'</td>';
				}				
				echo '
				<td><a href="detailpel.php?cirid='.$clientsbp['cirid'].'"><img src="images/detail.png"></a></td>
				<td><a href="editpel.php?cirid='.$clientsbp['cirid'].'"><img src="images/follow.png"></a></td>
		
	</tr>
	';
	}
	
	echo '
	</tbody>
	</table>';
	
	echo '
	
	</div>';
	
	?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers"
    } );
	} );
	</script>
</body>
</html>
