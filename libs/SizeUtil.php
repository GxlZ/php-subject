<?php

class SizeUtil {
    /*
     * 1Byte=>8bit
     * 1KB=>1024Byte
     * 1MB=>1024KB
     * 1GB=>1024MB
     */

    private $bitRule = array(//bit规则
        'b', 'bit', 'bIt', 'biT', 'bIT', 'Bit', 'BIt', 'BiT', 'BIT',
    );
    private $byteRule = array(//byte规则
        'B', 'byte', 'byTe', 'bytE', 'byTE', 'bYte', 'bYTe', 'bYtE', 'bYTE', 'Byte', 'ByTe', 'BytE', 'ByTE', 'BYte', 'BYTe', 'BYtE', 'BYTE'
    );
    private $kbRule = array(//kb规则
        'k', 'K', 'kb', 'kB', 'Kb', 'KB'
    );
    private $mbRule = array(//mb规则
        'm', 'M', 'mb', 'Mb', 'mB', 'MB'
    );
    private $gbRule = array(//gb规则
        'g', 'G', 'gb', 'gB', 'Gb', 'GB'
    );
    private $targetUnitRule = array(//允许的目标量级
        'bit', 'byte', 'kb', 'mb', 'gb'
    );
    private $sizeRule = array(//以字节为基准 计算
        'bit' => 0.125,
        'byte' => 1,
        'kb' => 1024,
        'mb' => 1048576,
        'gb' => 1073741824,
    );
    private $sourceSize; //原应用大小
    public $sourceUnit; //原单位
    private $byteSize; //单位统一为byte后大小
    private $targetUnit = 'mb'; //目标量级 默认mb

    const BYTE = 'byte';
    const KB = 'kb';
    const MB = 'mb';
    const GB = 'gb';

    /**
     * SizeUtil constructor.
     * @param $size
     */
    public function __construct($size) {
        $this->sourceSize = $size;
        $this->sourceUnit = $this->getUnit($this->sourceSize);
        //如果单位是字节 删除所有非数字
        if ($this->sourceUnit == 'byte') {
            $this->sourceSize = preg_replace('/\D/', '', $this->sourceSize);
        }
        $this->byteSize = $this->sizeToByte($size, $this->sourceUnit);
    }

    /**
     * @param $targetUnit
     */
    public function setTargetUnit($targetUnit) {
        if (in_array($targetUnit, $this->targetUnitRule)) {
            $this->targetUnit = $targetUnit;
        }
    }

    /**
     * @param $size
     * @param $unit
     * @return mixed
     */
    private function sizeToByte($size, $unit) {
        return $size * $this->sizeRule[$unit];
    }

    /**
     * @return string
     */
    public function getTargetUnitSize() {
        return sprintf('%.2f', $this->byteSize / $this->sizeRule[$this->targetUnit]);
    }

    /**
     * @param $size
     * @return string
     */
    private function getUnit($size) {
        if (is_numeric($size)) {
            return 'byte';
        }
        $pattern = '/\D{1,}/';
        preg_match_all($pattern, $size, $unitArr);
        $unit = end($unitArr[0]);
        if (in_array($unit, $this->bitRule)) {
            return 'bit';
        }
        if (in_array($unit, $this->byteRule)) {
            return 'byte';
        }
        if (in_array($unit, $this->kbRule)) {
            return 'kb';
        }
        if (in_array($unit, $this->mbRule)) {
            return 'mb';
        }
        if (in_array($unit, $this->gbRule)) {
            return 'gb';
        }
        return 'byte';
    }

}
