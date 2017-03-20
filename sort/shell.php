<?php

//快速排序

$arr = file("rand", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

quickSort($arr, 0, count($arr) - 1);

var_dump($arr);

function quickSort(&$arr) {
    quickSortPart($arr, 0, count($arr) - 1);
}

function quickSortPart(&$arr, $l, $r) {
    if ($l >= $r) { //位置出现交叉重叠 退出
        return;
    }
    $i = $l;
    $j = $r;
    $base = $arr[$i]; //定义第一个位置为 基准数字
    while ($i < $j) { //位置出现交叉重叠 退出
        //从右向左找 小于$base 的数
        while ($i < $j && $arr[$j] >= $base) {
            $j--;
        }

        //从左向右找 大于$base 的数
        while ($i < $j && $arr[$i] <= $base) {
            $i++;
        }

        if ($i < $j) {//交换 i,j位置 的值
            change($arr[$i], $arr[$j]);
        }
    }

    //交换 base位置 和 i位置 的值
    change($arr[$l], $arr[$i]);

    //递归调用
    quickSortPart($arr, $l, $i - 1); //左半部分
    quickSortPart($arr, $i + 1, $r); //右半部分
}


function change(&$i, &$j) {
    $tmp = $i;
    $i = $j;
    $j = $tmp;
}