# App configuration

[toc]

### Introduction
After installing Glowie into your server, you must configure your application before starting.

### Environment config
In the root folder of your project, you need to copy `.env.example` to `.env`. This is the file where your application settings for the current environment are stored. Each environment should have its own `.env` file, as some settings may change from one to another.

**Important!** This is the **only** file where you should store all your application sensitive data, like database passwords and encryption keys. You should not commit this file to your application source control.

From [Firefly](docs/%%version%%/extra/cli) CLI you can use the following command to make this initial setup automatically:

```plaintext
php firefly init
```

Anywhere in your application you can retrieve an environment config by using `Env::get()` method, passing the configuration key you want to retrieve.

_Example_
```php
use Glowie\Core\Env;
$value = Env::get('my_config');
```

You can also pass an optional default value as the second parameter, and this value will be returned if the key you provide does not exist in the current environment.

If you want to check if an environment setting is available, use `Env::has()`. Also, you can set a environment configuration during runtime by using `Env::set()` method.

### Config file
Your application general configuration file is stored in `app/config/Config.php`. These configurations are shared between all environments.

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

**skeltch.path**
Path where to store the cached views.

**error_reporting.level**
The error reporting level for PHP exceptions.

**error_reporting.logging**
Enables or disables error logging for your application.

**error_reporting.file**
Location of the error log file.

**session.name**
Name for the session cookie of your application.

**session.lifetime**
Maximum amount of time (in seconds) for storing unused session files.

**session.gc_cleaning**
Number of requests when to run the garbage collector and delete unused session files.

**session.path**
Path where to store the session files. **Caution:** It must not be a public accessible path, since it will contain sensitive data from your users.

**session.secure**
Blocks your application to use sessions while in non-HTTPS protocol.

**session.restrict**
Blocks your application scripts (like JS) from reading the session data.

**cookies.secure**
Blocks your application to use cookies while in non-HTTPS protocol.

**cookies.restrict**
Blocks your application scripts (like JS) from reading the cookies data.

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
- **strict** - Enable database strict mode.

Sensitive settings must not be stored in the config file. Use your `.env` instead.

_Example_
```php
'database' => [
    'default' => [
        'host' => Env::get('DB_HOST', 'localhost'),
        'username' => Env::get('DB_USERNAME', 'root'),
        'password' => Env::get('DB_PASSWORD', ''),
        'db' => Env::get('DB_DATABASE', 'glowie'),
        'port' => Env::get('DB_PORT', 3306),
        'charset' => 'utf8',
        'strict' => true
    ],

    'external' => [
        // ...
    ]
]
```

**migrations.table**
Name of the table used for tracking current database migrations. See [Migrations](docs/%%version%%/extra/migrations).

**cors.enabled**
Enable Cross-Origin Resource Sharing (CORS) settings.

**cors.allowed_methods**
Array of allowed CORS methods.

**cors.allowed_origins**
Array of allowed CORS origins.

**cors.allowed_headers**
Array of allowed CORS headers.

**cors.exposed_headers**
Array of exposed CORS headers.

**cors.max_age**
CORS preflight request cache time.

**cors.allow_credentials**
Allow CORS credentials to be exposed.

**plugins**
Array of classnames of your application plugins. See [Plugins](docs/%%version%%/extra/plugins).

**sandbox.alias**
Array of class alias to use in Firefly Sandbox REPL. See [CLI](docs/%%version%%/extra/cli).

**other.language**
Default language to use in internationalization. See [Internationalization](docs/%%version%%/extra/internationalization).

**other.timezone**
Default timezone to use with PHP date functions. Must be a valid [PHP timezone](https://php.net/manual/en/timezones.php).

**other.request_vars**
Precedence of request variables accessible through Request instance. If you use `GET_POST`, `POST` variables will override `GET` variables with the same name. If you want the inverse behavior, use `POST_GET`.

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

You can also use `Config::set()` to set a config value during runtime.