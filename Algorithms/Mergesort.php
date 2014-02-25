#!/usr/bin/env php
<?php

$merge = function($left, $right) {
  $result = [];
  while(count($left) || count($right)) {
    if (count($left) && count($right)) {
      if ($left[0] <= $right[0]) {
        $result[] = array_shift($left);
      } else {
        $result[] = array_shift($right);
      }
    } else if (count($left)) {
      $result[] = array_shift($left);
    } else if (count($right)) {
      $result[] = array_shift($right);
    }
  }
  return $result;
};

$mergesort = function($list) use (&$mergesort, &$merge) {
  if (count($list) <= 1)
    return $list;

  $middle = count($list) / 2;
  $less = array_slice($list, 0, $middle);
  $more = array_slice($list, $middle);

  $less = $mergesort($less);
  $more = $mergesort($more);

  return $merge($less, $more);
};

// Create an array
$list = range(0, 100000, mt_rand(5, 100));

// Randomize them
shuffle($list);

// Print before
print_r($list);

$m_start = memory_get_peak_usage();
$t_start = microtime(1);
// Print sorted result
print_r($mergesort($list));

fwrite(STDOUT, 'Memory Use: ' . ((memory_get_peak_usage() -  $m_start) / 1024 / 1024) . ' MiB' . PHP_EOL);
fwrite(STDOUT, 'Time: ' . (microtime(1) -  $t_start) . ' Seconds' . PHP_EOL);
fwrite(STDOUT, 'Array size: ' . (count($list)) . PHP_EOL);