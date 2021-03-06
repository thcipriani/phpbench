<?php namespace time;

function setup(&$i, &$arr)
{
    while ($i < 100000) {
        $arr[] = $i;
        $i++;
    }
}

function testOne($arr)
{
    ob_start();
    foreach($arr as $val) {
        echo $val;
    }
    ob_end_clean();
}

function testTwo($arr)
{
    ob_start();
    while(list(,$val) = each($arr)) {
        echo $val;
    }
    ob_end_clean();

}

function main()
{
    $t1_total = 0.0;
    $t2_total = 0.0;

    for ($i = 0; $i < 10; $i++) { 
        $arr = [];
        $j   = 0;

        setup($j, $arr);

        $t1_start = microtime(1);
        testOne($arr);
        $t1_end = microtime(1);

        $t2_start = microtime(1);
        testTwo($arr);
        $t2_end = microtime(1);

        $t1_total += $t1_end - $t1_start;
        $t2_total += $t2_end - $t2_start;
    }

    fwrite(STDOUT, "    Foreach: $t1_total" . PHP_EOL);
    fwrite(STDOUT, "    While-Each: $t2_total" . PHP_EOL);
}

main();