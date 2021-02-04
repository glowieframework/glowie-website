After installing Glowie into your server, you must configure your application before starting.

### Config environments
Glowie allows you to have multiple configuration environments for different types of scenarios. This means you just need to edit a single file while switching from development to a production environment and vice-versa. You can also create as many environments as you want.

### Setting the active environment
You can set the current active environment by editing `GLOWIE_ENV` setting in `app/.htaccess`.

_Example_
```apache
# production environment
SetEnv GLOWIE_ENV production
```

### Config file
Before starting, you must rename `app/config/Config.example.php` to `app/config/Config.php`. This is the file where your application configs for all environments are stored.

**Note:** This file contains sensitive data as database passwords and encryption tokens. You should not commit this file to your application source control.

Available configurations are:

**app_folder**\
The folder (relative to the domain URL) where your app will run from. If your app runs in the root folder, leave this empty. If it runs in a subfolder, specify its path.

_Example_
```php
# myappurl.com/foo
'app_folder' => '/foo/'
```

**timezone**\
Timezone to use with PHP `date` functions. Must be a valid PHP timezone.

_Example_
```php
'timezone' => 'America/Sao_Paulo';
```

**error_reporting**\
The error reporting level for PHP.

_Example_
```php
'error_reporting' => E_ALL;
```

**api_key**\
Key to use with encrypting functions. Be sure to use a strong key.

_Example_
```php
'api_key' => 'Rj1UQHJfajlLKGN1WjhQYXBcSy4='
```

**api_token**\
Token to use with encrypting functions (along with API key). Be sure to use a strong key.

_Example_
```php
'api_token' => 'ckVdU3g3fkQmS0h0KyotTV1YdSs='
```

**database**\
Database connection settings (if applicable). Must be an associative array with the following properties:

- **host** - Database host URL.
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
];
```