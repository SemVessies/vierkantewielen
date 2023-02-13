<?php
$conf["Username"]='root';
$conf["Password"]= '';
$conf["Host"]= 'localhost';
$conf["Database"]= 'vierkantewielen';

$connect = mysqli_connect($conf["Host"], $conf["Username"], $conf["Password"], $conf["Database"]);
if(!$connect) {
    echo "Kan geen verbinding maken met de database"; // Verbinding is mislukt!
}
?>
