<?php
require '../dbConnect.php';
$display_query = "select lesDatum, lesTijdBegin, lesDuur, lesDoel, lesOpmerking from les";
$results = mysqli_query($connect, $display_query);
$count = mysqli_num_rows($results);

if ($count > 0) {
    $data_arr = array();
    $i = 0;
    while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
//      $data_arr[$i]['lesNummer'] = $data_row['lesNummer'];
        $new['title'] = $data_row['lesDoel'];
        $new['start'] = date("Y-m-d", strtotime($data_row['lesDatum']));
//        $new['lesDatumEind'] = date("Y-m-d", strtotime($data_row['lesDatumEind']));
        $new['lesStart'] = $data_row['lesTijdBegin'];
        $new['lesDuur'] = $data_row['lesDuur'];
        $new['lesOpmerking'] = $data_row['lesOpmerking'];
        $new['color'] = 'green' . substr(uniqid(), -6); // 'green'; pass colour name
        $data_arr[] = $new;
        $i++;
    }
    $data = array(
//        'status' => true,
//        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error!'
    );
}
//var_dump($data_arr);
echo json_encode($data_arr);
//echo '{"title": "All Day Event", "start": "2023-01-01"}';
