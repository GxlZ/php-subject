<?php
include '../Base.php';

ShellUtil::enter("begin");

$slicesPath = "slices";
if (!file_exists($slicesPath)) {
    mkdir("slices");
}

//$sourceFile = "numbers";

//逐行读取 切分为小文件
//sliceFile($sourceFile, 100000);

//sortFile("slices/1");

mergeSort("slices/1.sorted", "slices/2.sorted");

ShellUtil::enter("end");

//生成排序文件
function sortFile($filePath) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    sort($lines);

    $f = fopen("{$filePath}.sorted", "w+");
    foreach ($lines as $line) {
        fwrite($f, $line . PHP_EOL);
    }
    fclose($f);
}

//切分文件为小文件
function sliceFile($filePath, $grained) {
    $f = fopen($filePath, 'r');
    $sliceDirPath = "slices";
    $fileName = $i = 1;

    $sliceFilePath = "{$sliceDirPath}/{$fileName}";

    $sliceFile = fopen($sliceFilePath, 'w+');
    while (!feof($f)) {  //使用feof判断是否到达文件末尾
        $line = fgets($f); //使用fgets按行读取文件内容
        if (!$line) {
            break;
        }
        if ($i % $grained == 0) {
            fclose($sliceFile);
            $fileName++;
            $sliceFilePath = "{$sliceDirPath}/{$fileName}";
            $sliceFile = fopen($sliceFilePath, 'w+');
        }

        fwrite($sliceFile, $line);
        $i++;

        ShellUtil::enter("write file:{$sliceFilePath}; number:{$line}");
    }

    fclose($sliceFile);
}

//归并排序
function mergeSort($f1Path, $f2Path) {
    $f1FileName = substr($f1Path, strpos($f1Path, '/') + 1);
    $f2FileName = substr($f2Path, strpos($f2Path, '/') + 1);
    $mergeName = "{$f1FileName}_{$f2FileName}";

    $f1 = fopen($f1Path, 'r');
    $f2 = fopen($f2Path, 'r');
    $mergeFile = fopen("merge/{$mergeName}_merge", 'w+');

    $p1 = 1;
    $p2 = 1;
    for ($i = 0; $i < 5; $i++) {
        $f1End = feof($f1);
        $f2End = feof($f2);
        if ($f1End || $f2End) {
            break;
        }
        $n1 = fgets($f1);
        $n2 = fgets($f2);
        $trimN1 = trim($n1);
        $trimN2 = trim($n2);

        ShellUtil::enter("n1[{$trimN1}],n2[{$trimN2}],point1[{$p1}],point2[{$p2}]");
        if ($trimN1 <= $trimN2) {
            fwrite($mergeFile, $n1);
            ShellUtil::enter("write {$f1FileName},line[{$p1}],value[{$trimN1}]");
            fseek($f1, ++$p1);
        } else {
            fwrite($mergeFile, $n2);
            ShellUtil::enter("write {$f2FileName},line[{$p2}],value[{$trimN2}]");
            fseek($f2, ++$p2);
        }
        ShellUtil::enter('');
    }
    if (!$f1End) {
        ShellUtil::enter("{$f1FileName} surplus");
        $surplusFile = $f1;
        fwrite($mergeFile, $n1);
    }
    if (!$f2End) {
        ShellUtil::enter("{$f2FileName} surplus");
        $surplusFile = $f2;
        fwrite($mergeFile, $n2);
    }

    if (empty($surplusFile)) {
        ShellUtil::enter('end');
        exit(0);
    }

    while (!feof($surplusFile)) {
        $n = fgets($surplusFile);
        ShellUtil::enter("line[{$p2}],value[" . trim($n) . "]");
        fwrite($mergeFile, $n);
    }

    echo '<pre>';
    var_dump('end');
    exit();

    die('2');
}