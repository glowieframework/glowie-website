# App configuration
After installing Glowie into your server, you must configure your application before starting.

Copy `app/config/Config.example.php` to `app/config/Config.php`. This is the file where your application settings for the current environment are stored. Each environment should have its own config file, as some settings may change from one to another.

**Important!** This file contains sensitive data as database passwords and encryption keys. You should not commit this file to your application source control.

The config file is a multi-dimensional array. Each "group" of settings must be another associative array with the key being the configuration name and the value the configuration itself. This configurations are retrieved using a dot notation search.

Available configurations are:

**maintenance.enabled**
Enables the application [Maintenance mode](docs/%%version%%/extra/maintenance-mode).

**maintenance.bypass_key**
Key to bypass the maintenance mode and enter the application during downtime.

**skeltch.enabled**
Enables [Skeltch](docs/%%version%%/extra/skeltch) templating engine to compile your application views.

**skeltch.cache**
Enables views caching for Skeltch. This is highly recommended in a production environment.

**error_reporting.level**
The error reporting level for PHP exceptions.

**error_reporting.logging**
Enables or disables error logging for your application.

**session.lifetime**
Maximum amount of time (in seconds) for storing unused session files.

**session.gc_cleaning**
Number of requests when to run the garbage collector and delete unused session files.

**secret.app_key**
Key to use with encrypting functions. Be sure to use a strong key.

**secret.app_token**
Token to use with encrypting functions (along with your app key). Be sure to use a strong key.

**database**
The database connection settings available for your application. Each database identifier must be a key, and the settings an associative array with the following properties:

- **host** - Database hostname URL.
- **username** - Username to use while connecting to the database.
- **password** - Password to use while autenticating user to the database.
- **db** - Database name to connect to.
- **port** - Database connection port.
- **charset** - Database charset.

_Example_
```php
'database' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'glowie',
        'port' => 3306,
        'charset' => 'utf8'
    ],

    'external' => [
        // ...
    ]
]
```

**migrations.table**
Name of the table used for tracking current database migrations. See [Migrations](docs/%%version%%/extra/migrations).

**other.timezone**
Default timezone to use with PHP date functions. Must be a valid [PHP timezone](https://php.net/manual/en/timezones.php).

### Custom configuration variables
If you want to work with aditional configuration variables, create a new key in the configuration array with the value you want.

_Example_
```php
'my_config' => 'value'
```

To retrieve this configuration anywhere in your application, use the static `Config::get()` method, passing the key for the configuration you want to retrieve.

_Example_
```php
use Glowie\Core\Config;
$value = Config::get('my_config'); # returns "value"
```

You can also pass an optional default value as the second parameter, and this value will be returned if the key you provide does not exist in the current environment.

If you want to check if a configuration exists, use the static `Config::has()` method, passing the key for the configuration you want to check.

_Example_
```php
use Glowie\Core\Config;
$exists = Config::has('my_config'); # returns true
```

<div class="links">
    <a href="docs/%%version%%/getting-started/folder-structure"><- Folder structure</a>
    <a href="docs/%%version%%/getting-started/autoloading">Autoloading -></a>
</div>