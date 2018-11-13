<?php

class LatencyTest{

    const PINGCMD = 'ping ';
    const TIMEPATT = '/time=([0-9]{1,4})ms/';

    protected $hostA;
    protected $hostB;
    protected $outputA = array();
    protected $outputB = array();

    public function __construct($hostA,$hostB,$sleepTime,$numRuns){
        $this->hostA = $hostA;
        $this->hostB = $hostB;
        for($i = 0; $i < $numRuns; $i++){
            $this->_pushOutput($hostA,$this->_doPing($hostA));
            $this->_pushOutput($hostB,$this->_doPing($hostB));
            sleep($sleepTime);
        }
        echo $this->hostA . " Average Latency: " . $this->_calculateAverage($this->hostA) . " ms\n";
        echo $this->hostB . " Average Latency: " . $this->_calculateAverage($this->hostB) . " ms\n";
    }
    protected function _buildPingCmd($host){
        return self::PINGCMD . $host;
    }
    protected function _parseResults($resultStr){
        $matches = array();
        $results = array();
        if(preg_match_all(self::TIMEPATT,$resultStr,$matches)){
            foreach($matches[1] as $match){
                $results[] = $match;
            }
        }
        return $results;
    }
    protected function _pushOutput($host,$arr){
        if($host == $this->hostA){
            $field = "outputA";
        }else{
            $field = "outputB";
        }
        foreach($arr as $a){
            $this->$field[] = $a;
        }
        return $this;
    }
    protected function _doPing($host){
        return $this->_parseResults(shell_exec($this->_buildPingCmd($host)));
    }
    protected function _calculateAverage($host){
        if($host == $this->hostA){
            $field = "outputA";
        }else{
            $field = "outputB";
        }
        return array_sum($this->$field) / count($this->$field);
    }
}
