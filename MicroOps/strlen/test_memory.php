<?php namespace memstrlen;


function testOne($str)
{
    ob_start();
    strlen($str);
    ob_end_clean();
}

function main()
{
    $t1_total = 0.0;

    $str = "supercalifragilisticexpialidocious";

    for ($i = 0; $i < 100000; $i++) { 

        $t1_start = memory_get_peak_usage();
        testOne($str);
        $t1_end = memory_get_peak_usage();

        $t1_total += $t1_end - $t1_start;
    }

    fwrite(STDOUT, "    strlen memory: $t1_total" . PHP_EOL);
}

main();