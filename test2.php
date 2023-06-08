<?php
$filecontent = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
echo $filecontent;
?>