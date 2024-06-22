# reactphp-framework-crontab

## install

```
composer require reactphp-framework/crontab -vvv
```

## Usage


```php

<?php
require __DIR__ . '/vendor/autoload.php';

use Reactphp\Framework\Crontab\Crontab;

new Crontab('*/2 * * * * *', function() {
    echo date('Y-m-d H:i:s')."\n";
});
```

## License

MIT
