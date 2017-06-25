<?php
$jsonData = $_POST['userdatafile'];
$f = @fopen("userdata.json", "r+");
if ($f !== false) {
    ftruncate($f, 0);
    fwrite($f, $jsonData);
}
?>