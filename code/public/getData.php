<?php 


require_once('../src/connect.php');

function getData() {
    try {
        $conn = getConnect();

        $qe = $conn->query("SELECT * FROM history");
        return $qe->fetchAll();

    } catch (Exception $e) {
        return null;
    }
}

$history = getData();

header('Content-Type: application/json');
if ($history !== null) {
    echo json_encode($history);
} else {
    echo json_encode(array('error' => 'Произошла ошибка :P'));
}
