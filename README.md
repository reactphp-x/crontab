# reactphp-framework-crontab

## install

```
composer require reactphp-framework/crontab -vvv
```

## Usage

parent process

```php

<?php
require __DIR__ . '/vendor/autoload.php';

use Reactphp\Framework\Crontab\Crontab;

new Crontab('*/2 * * * * *', function() {
    echo date('Y-m-d H:i:s')."-parent-process\n";
});
```

child process

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Reactphp\Framework\Process\ProcessManager;
use Reactphp\Framework\Crontab\Crontab;

ProcessManager::instance()->initProcessNumber(1);

$stream = ProcessManager::instance()->callback(function ($stream) {
    new Crontab('*/1 * * * * *', function() use ($stream) {
        $stream->write(date('Y-m-d H:i:s')."-child-process\n");
    });
    return $stream;
});

$stream->on('data', function ($buffer) {
    echo $buffer;
});

```

## License

MIT
