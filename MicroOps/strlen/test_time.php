<?php namespace timestrlen;

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

    for ($i = 0; $i < 1000000; $i++) { 

        $t1_start = microtime(1);
        testOne($str);
        $t1_end = microtime(1);

        $t1_total += $t1_end - $t1_start;
    }

    fwrite(STDOUT, "    strlen time: $t1_total" . PHP_EOL);
}

main();