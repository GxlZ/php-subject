<?php

//桶排序 简易实现

$arr = file("rand", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$sortArr = bucketSort($arr);

var_dump($sortArr);

function bucketSort($arr) {
    //获取最大的值
    $max = max($arr);

    /**
     * 创建一个桶
     * 这里不初始化桶 会导致 排序结果异常
     * 异常例子 2 2 1
     * 不初始化 [2 => 2, 1 => 1]
     * 初始化  [1 => 1, 2 => 2]
     */

    $bucketArr = [];
    for ($i = 1; $i <= $max; $i++) {
        $bucketArr[$i] = null;
    }

    //把重复出现的 数字 放到同一个桶中
    //这里模拟为 桶的值 +1
    foreach ($arr as $v) {
        if (!isset($bucketArr[$v])) {
            $bucketArr[$v] = 1;
        } else {
            $bucketArr[$v] += 1;
        }
    }

    //收集结果
    $sortArr = [];
    foreach ($bucketArr as $k => $v) {
        for ($i = 0; $i < $v; $i++) {
            $sortArr[] = $k;
        }
    }

    return $sortArr;

}
