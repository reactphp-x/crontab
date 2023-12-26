<?php

require __DIR__ . '/../vendor/autoload.php';

use Reactphp\Framework\Process\ProcessManager;
use Reactphp\Framework\Crontab\Crontab;

ProcessManager::instance()->initProcessNumber(1);

$stream = ProcessManager::instance()->callback(function ($stream) {
    $i = 0;
    $crontab = new Crontab('*/1 * * * * *', function() use ($stream, &$i, &$crontab) {
        $i++;
        if ($i>10) {
            $crontab->destroy();
            $stream->end();
        } else {
            $stream->write(date('Y-m-d H:i:s')."-child-process-$i\n");
        }
    });
    return $stream;
});

$stream->on('data', function ($buffer) {
    echo $buffer;
});

$stream->on('close', function () {
    echo "close\n";
    ProcessManager::instance()->terminate();
});