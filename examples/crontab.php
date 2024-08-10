<?php

require __DIR__ . '/../vendor/autoload.php';

use ReactphpX\Crontab\Crontab;

new Crontab('*/2 * * * * *', function() {
    echo date('Y-m-d H:i:s')."\n";
});
