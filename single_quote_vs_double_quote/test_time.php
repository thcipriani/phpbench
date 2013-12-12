<?php namespace timestr;

function testOne()
{
    $i = 0;
    ob_start();
    while ($i < 1000000) {
        $a = "something";
        echo "SSSSSAAAAAAAAAYyyyyyyy " . $a;
        $i++;
    }
    ob_end_clean();
    unset($a, $i);
}

function testTwo()
{
    $i = 0;
    ob_start();
    while ($i < 1000000) {
        $a = 'something';
        echo 'SSSSSAAAAAAAAAYyyyyyyy ' . $a;
        $i++;
    }
    ob_end_clean();
    unset($a, $i);

}

function main()
{
    $t1_total = 0.0;
    $t2_total = 0.0;

    for ($i = 0; $i < 10; $i++) { 
        $t1_start = microtime(1);
        testOne();
        $t1_end = microtime(1);

        $t2_start = microtime(1);
        testTwo();
        $t2_end = microtime(1);

        $t1_total += $t1_end - $t1_start;
        $t2_total += $t2_end - $t2_start;
    }

    fwrite(STDOUT, "    Double Quote: $t1_total" . PHP_EOL);
    fwrite(STDOUT, "    Single Quote: $t2_total" . PHP_EOL);
}

main();