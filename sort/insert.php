<?php

//直接插入排序

$arr = file("rand", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

insertSort($arr);

var_dump($arr);

function insertSort(&$arr) {

    for ($i = 1; $i < count($arr) - 1; $i++) {
        //如果当前元素 大于 上一个元素 不需要移动
        if ($arr[$i] > $arr[$i - 1]) {
            continue;
        }
        //当前位置的值
        $currentNumber = $arr[$i];

        //查找当前位置左边的元素 将比当前值大的数字 右移
        //但不能超过当前位置
        $j = $i;
        while ($j > 0 && $arr[$j - 1] > $currentNumber) {
            $arr[$j] = $arr[$j - 1];
            $j--;
        }

        //把当前值写入到
        //1.移动后空出的位置上
        //2.左边没有移动直接写入
        $arr[$j] = $currentNumber;
    }
}