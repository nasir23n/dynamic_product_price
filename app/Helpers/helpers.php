<?php


// https://stackoverflow.com/questions/6311779/finding-cartesian-product-with-php-associative-arrays

function arrayCross($input) {
    $result = [[]];
    foreach ($input as $key => $values) {
        $append = array();
        foreach($result as $elem) {
            foreach($values as $item) {
                $elem[$key] = $item;
                $append[] = $elem;
            }
        }
        $result = $append;
    }
    return $result;
}

function valuesByKeys($arr, $keys) {
    foreach($keys as $key) {
        $output_arr[] = $arr[$key];
    }
    return $output_arr;
}

function arrayGetRandom($arr) {
    $rand = rand(1, count($arr));
    $ar_rand = ($rand == 1) ? [array_rand($arr, $rand)] : array_rand($arr, $rand);
    return valuesByKeys($arr, $ar_rand);
}

