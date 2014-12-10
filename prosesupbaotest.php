<?php

require 'helper/file.php';

echo File::ext($_FILES['fupload']['name']);

var_dump($_FILES['fupload']);

?>