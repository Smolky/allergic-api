allergic-api
------------

Install
=======
1. use composer
2. Create a config.php

```php
<?php

// Configuration
// ----------------------------------------------------------------------------
$config = [
    
    // General config
    'displayErrorDetails' => true,
    
    
    // Database
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'pollution',
        'username' => 'username',
        'password' => 'password',
        'charset'   => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix'    => ''  
    ]
];
```
