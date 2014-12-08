<?php

require 'helper/file.php';

echo File::ext($_FILES['fupload']['name']);

?>