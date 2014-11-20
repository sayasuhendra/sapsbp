<?php
require 'start.php';
include "cek-sesion.php";
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
  <link rel="stylesheet" type="text/css" href="media/css/bootstrap.min.css"/>
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
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	include "menu.php";

	?>
	<div id="isi">
			<?php
				include "koneksi.php";
				date_default_timezone_set("Asia/Jakarta");
				$waktu=date("Ymd"); 
				?>

				<div class="col-md-4 col-md-offset-4">
				
				<h3 class="judulok" align="center">Form Edit Vendor</h3>
				<form method="post" name="form" class="form-horizontal" action="proseseditvendor.php">

					<div class="form-group">
					  <label for="noim" class="col-sm-5 control-label">Nomer Internal Memo</label>
					  <div class="col-sm-7">
					    <input type="text" class="form-control" id="noim" name="noim" placeholder="Nomer Internal Memo">
					  </div>
					</div>
					<div class="form-group">
					  <label for="namavendor" class="col-sm-5 control-label">Nama Vendor Baru</label>
					  <div class="col-sm-7">
					  	<?php

					  		$users = Vendor::all()->lists('nama_vendor', 'nama_vendor');
					  		echo '<select class="form-control" name="namavendor" id="namavendor">';
					  		echo '<option value="">Pilih Vendor Baru</option>';
					  		foreach ($users as $id => $vendor) {
					  			echo '<option value="'. $id . '">' . $vendor . '</option>';
					  		}
					  		echo '</select>';
					  		?>
					  </div>
					</div>
					
					<div class="form-group">
					  <div class="col-sm-offset-5 col-sm-7">
					    <button type="submit" class="btn btn-default">Edit</button>
					  </div>
					</div>

			
				</form>
				</div>

	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>