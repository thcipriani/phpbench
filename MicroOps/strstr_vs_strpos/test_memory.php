<?php namespace strmem;

function setup(&$str)
{
    $i = 0;

    while ($i < 10) {
        $str .= $i;
        $i++;
    }
}

function testOne($str)
{
    ob_start();
    echo strstr($str, '01234') !== false;
    ob_end_clean();
}

function testTwo($str)
{
    ob_start();
    echo strpos($str, '01234') !== false;
    ob_end_clean();

}

function main()
{
    $t1_total = 0.0;
    $t2_total = 0.0;

    /**
     * setup test 1
     */
    $str = '';
    setup($str);

    $t1_start = memory_get_peak_usage();
    for ($i = 0; $i < 100000; $i++) { 
        testOne($str);
    }
    $t1_end = memory_get_peak_usage();

    unset($str);

    /**
     * setup test 2
     */
    $str = '';
    setup($str);

    $t2_start = memory_get_peak_usage();
    for ($i = 0; $i < 100000; $i++) { 
        testTwo($str);
    }
    $t2_end = memory_get_peak_usage();

    unset($str);

    $t1_total += $t1_end - $t1_start;
    $t2_total += $t2_end - $t2_start;

    fwrite(STDOUT, "    StrStr: $t1_total" . PHP_EOL);
    fwrite(STDOUT, "    StrPos: $t2_total" . PHP_EOL . PHP_EOL);
}

main();