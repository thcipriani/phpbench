<?php
$red = `tput setaf 1`;
$reset = `tput sgr0`;
fwrite(STDOUT, "${red}Time Test:${reset}" . PHP_EOL);
include __DIR__ . '/test_time.php';

fwrite(STDOUT, PHP_EOL);

fwrite(STDOUT, "${red}Memory Test:${reset}" . PHP_EOL);
include __DIR__ . '/test_memory.php';