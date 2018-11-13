# latency_test_php

Intended to run on a Windows system where pings are non-continuous. Each "run" represents a single ping command, resulting in 4 pieces of output.

LatencyTest accepts 4 parameters:
* $host1 // The first host you would like to test
* $host2 // The second host you would like to test
* $sleep // The number of seconds to sleep between each run
* $numRuns // The total number of runs you would like to program to make


## Usage

```
require_once __DIR__ . '/latencyTest.php';
$host1 = '127.0.0.1';
$host2 = '127.0.0.1';
$sleep = 5;
$runCount = 10;
$test = new LatencyTest($host1,$host2,$sleep,$runCount);
```

