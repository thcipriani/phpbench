#!/usr/bin/env php
<?php

$quicksort = function($arr) use (&$quicksort)
{
    // Return the array if it has 1 or 0 elements
    if (count($arr) <= 1)
      return $arr;

    // Pick any number as the pivot and remove from array
    $pivot = array_shift($arr);

    // Create arrays to hold numbers less than and greater than the pivot
    $less = [];
    $more = [];

    // Loop through the numbers in the array (use while to prevent any creation of unnecessary arrays in memory)
    while(list($k, $v) = each($arr)) {

      // Add any numbers less or equal to pivot to the $less array
      if ($v <= $pivot) {
        $less[] = $v;

      // Add any numbers greater than pivot to the $less array
      } else {
        $more[] = $v;
      }
    }

    // Merge $less, pivot and $more, recursively call quicksort on $less and $more
    return array_merge($quicksort($less), [ $pivot ], $quicksort($more));
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
print_r($quicksort($list));

fwrite(STDOUT, 'Memory Use: ' . ((memory_get_peak_usage() -  $m_start) / 1024 / 1024) . ' MiB' . PHP_EOL);
fwrite(STDOUT, 'Time: ' . (microtime(1) -  $t_start) . ' Seconds' . PHP_EOL);
fwrite(STDOUT, 'Array size: ' . (count($list)) . PHP_EOL);