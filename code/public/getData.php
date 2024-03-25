<?php 


require_once('../src/connect.php');

function getData() {
    $conn = getConnect();
    if (!$conn) {
        return [];
    }

    $qe = $conn->query("SELECT * FROM history");
    return $qe->fetchAll();
}

$history = getData();
header('Content-Type: application/json');
echo json_encode($history);