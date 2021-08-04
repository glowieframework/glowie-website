# App configuration
After installing Glowie into your server, you must configure your application before starting.

### Config environments
Glowie allows you to have multiple configuration environments for different types of scenarios. This means you just need to edit a single file while switching from development to a production environment and vice-versa. You can also create as many environments as you want.

### Setting the active environment
You can set the current active environment by editing `GLOWIE_ENVIRONMENT` setting in `app/public/.htaccess`.

_Example_
```apache
# production environment
SetEnv GLOWIE_ENVIRONMENT production
```

**Note:** Some hosting providers may not correctly support `SetEnv`. If this is your case, comment this line in the `.htaccess` file and Glowie will automatically use the `production` environment.

### Config file
Before starting, you must rename `app/config/Config.example.php` to `app/config/Config.php`. This is the file where your application configs for all environments are stored.

**Important!** This file contains sensitive data as database passwords and encryption tokens. You should not commit this file to your application source control.

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
Global database connection settings (if applicable). Must be an associative **array** with the following properties:

- **host** - Database hostname URL.
- **username** - Username to use while connecting to the database.
- **password** - Password to use while autenticating user to the database.
- **db** - Database name to connect to.
- **port** - Database connection port.

_Example_
```php
'database' => [
    'host' => 'localhost',
    'username' => 'user',
    'password' => '123',
    'db' => 'glowie',
    'port' => 3306
]
```