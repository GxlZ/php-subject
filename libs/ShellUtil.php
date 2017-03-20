<?php
require_once('SizeUtil.php');

class ShellUtil {

    /**
     * @param $msg
     * @param int $count
     * @return string
     */
    public static function enter($msg, $count = 1) {
        $enterStr = str_repeat("\r\n", $count);
        $usedMemory = memory_get_usage();
        $sizeObj = new SizeUtil($usedMemory);
        $sizeObj->setTargetUnit(SizeUtil::MB);
        $usedSize = $sizeObj->getTargetUnitSize();
        $fmtUsedSize = $usedSize . SizeUtil::MB;
        echo date('Y-m-d H:i:s') . "[内存用量 {$fmtUsedSize}] {$msg}{$enterStr}";
    }

}
