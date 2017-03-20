<?php
include '../Base.php';
ShellUtil::enter("begin");

$f = fopen('numbers', 'w+');
$lines = 5 * 1 << 20;//5M

for ($i = 1; $i <= $lines; $i++) {
    $n = rand(1,100000);
    fwrite($f, "{$n}\r\n");
    if ($i % 100000 == 0) {
        $progress = CommonUtil::progress($lines, $i);
        ShellUtil::enter("写入:{$progress['processed']},剩余:{$progress['surplus']},进度:{$progress['percent']}");
    }
}

fclose($f);
ShellUtil::enter("finish");
