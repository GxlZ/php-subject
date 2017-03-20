<?php

class CommonUtil {

    public static function progress($total, $processed) {
        $progress['percent'] = floor($processed / $total * 100) . '%';
        $progress['surplus'] = $total - $processed;
        $progress['processed'] = $processed;
        return $progress;
    }
}