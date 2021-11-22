# App configuration
After installing Glowie into your server, you must configure your application before starting.

Copy `app/config/Config.example.php` to `app/config/Config.php`. This is the file where your application settings for the current environment are stored. Each environment should have its own config file, as some settings may change from one to another.

**Important!** This file contains sensitive data as database passwords and encryption keys. You should not commit this file to your application source control.

Available configurations are:

**cache**
Enables caching for some Glowie features. This is highly recommended in a production environment.

_Example_
```php
'cache' => true,
```

**skeltch**
Enables [Skeltch](docs/%%version%%/extra/skeltch) templating engine to compile your application views.

_Example_
```php
'skeltch' => true,
```

**timezone**
Default timezone to use with PHP date functions. Must be a valid [PHP timezone](https://php.net/manual/en/timezones.php).

_Example_
```php
'timezone' => 'America/Sao_Paulo',
```

**error_reporting**
The error reporting level for PHP exceptions.

_Example_
```php
'error_reporting' => E_ALL,
```

**error_log**
Enables or disables error logging for your application.

_Example_
```php
'error_log' => true,
```

**session_lifetime**
Maximum amount of time (in seconds) for storing unused session files.

_Example_
```php
'session_lifetime' => 120,
```

**app_key**
Key to use with encrypting functions. Be sure to use a strong key.

_Example_
```php
'app_key' => 'f08e8ba131c7abab97dba275fab5a85e',
```

**app_token**
Token to use with encrypting functions (along with your app key). Be sure to use a strong key.

_Example_
```php
'app_token' => 'd147723d9e91340d9dd28fbd5a0b6651',
```

**database**
Global database connection settings (if applicable). Must be an associative array with the following properties:

- **host** - Database hostname URL.
- **username** - Username to use while connecting to the database.
- **password** - Password to use while autenticating user to the database.
- **db** - Database name to connect to.
- **port** - Database connection port.

_Example_
```php
'database' => [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'glowie',
    'port' => 3306
]
```

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