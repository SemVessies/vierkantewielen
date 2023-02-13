<?php
require 'database_connection.php';
$instructeurNummer = $_POST['instructeurNummer'];
$meldingDatum = date("y-m-d", strtotime($_POST['meldingDatum']));


$insert_query = "insert into `ziekmelding`(`instructeurNummer`, `meldingDatum`) values ('" . $instructeurNummer . "','" . $meldingDatum ."')";
//echo $insert_query;
if (mysqli_query($con, $insert_query)) {
    $data = array(
        'status' => true,
        'msg' => 'Melding added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Melding not added.'
    );
}
echo json_encode($data);
