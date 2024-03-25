<?php



require_once '../src/bracketsFunction.php';

header('Content-Type: application/json');

//$input = file_get_contents('php://input');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $input = $data["data"] ?? 'err';
    $inputRaw = $data["dataRaw"] ?? 'dataRaw';
    
    //if($inputRaw !== 'dataRaw'){
        $result = ['success' => brackets($input), 'data' => dataSaver($inputRaw, brackets($input) == 1 ? 'true' : 'false')];
    //}
    
    
    echo json_encode($result);
}