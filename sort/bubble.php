<?php

//冒泡排序

$arr = file("rand", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

bubbleSort($arr);

var_dump($arr);

function bubbleSort(&$arr) {
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $len; $j++) {
            if (!isset($arr[$j + 1])) {
                break;
            }
            $prev = $arr[$j];
            $next = $arr[$j + 1];

            if ($prev > $next) {
                change($arr[$j], $arr[$j + 1]);
            }
        }
    }
}

function change(&$i, &$j) {
    $tmp = $i;
    $i = $j;
    $j = $tmp;
}