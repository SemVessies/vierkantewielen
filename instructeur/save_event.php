<?php
require '../dbConnect.php';
$lesDatum = date("y-m-d", strtotime($_POST['lesDatum']));
//$lesDatumEind = date("y-m-d", strtotime($_POST['lesDatumEind']));
$lesTijdBegin = $_POST['lesTijdBegin'];
$lesDuur = $_POST['lesDuur'];
$lesDoel = $_POST['lesDoel'];
$lesOpmerking = $_POST['lesOpmerking'];

// Slaat ingevoerde gegevens op in de tabel "les"
$insert_query = "insert into `les`(`lesDatum`, `lesTijdBegin`,`lesDuur`,`lesDoel`,`lesOpmerking`) values ('" . $lesDatum . "','" . $lesTijdBegin . "','" . $lesDuur . "','" . $lesDoel . "','" . $lesOpmerking . "')";
//echo $insert_query;
if (mysqli_query($connect, $insert_query)) {
    $data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Event not added.'
    );
}
echo json_encode($data);
?>
