<?php

require_once('connect.php');

function brackets($str) {
    if ($str == '' || ctype_alpha($str)) {
        return false; 
    }

    $stack = [];
    $dictionary = [
        '(' => ')',
        '{' => '}',
        '[' => ']',
        '<' => '>'
    ];


    for ($i = 0; $i < strlen($str); $i++) {
        $currentChar = $str[$i];
        

        if (array_key_exists($currentChar, $dictionary)) {
            array_push($stack, $currentChar); 
        }
        elseif (in_array($currentChar, $dictionary)) {
            if (empty($stack)) {
                return false; 
            }
            $last = array_pop($stack); 
            if ($dictionary[$last] != $currentChar) {
                return false; 
            }
        }
        
    }

    return empty($stack);
}

function dataSaver($data, $result) {
    try {
        $conn = getConnect();

        $qe = $conn->prepare("INSERT INTO history (query, result) VALUES (:query, :result)");
        $qe->execute(['query' => $data, 'result' => $result ? 1 : 0]);
        
    } catch (\Throwable $th) {
        error_log('err');
    }
    
}
