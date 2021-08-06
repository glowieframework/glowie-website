# Firefly
Firefly is Glowie's command line tool. This tool is suited to help you increase your workflow speed and have access to several Glowie utilities.

To run Firefly, from your console navigate to the application root folder and run:

```plaintext
php firefly
```

This command will give you a list of all available commands from Firefly. You can also use `php firefly help` for that.

In order to see the current Firefly, Glowie and PHP CLI versions, use:

```plaintext
php firefly version
```

### Using commands and arguments
When running a Firefly command, you must type in `php firefly` followed by the command you want to use. Each command can have optional arguments, that passes options to the command itself.

To use an argument, write two hyphens (`--`) followed by the argument name, an equal sign and the value you want to pass.

**Important!** You cannot use spaces in arguments names or values.

You can use multiple arguments splitting them by spaces.

_Example_
```plaintext
php firefly test-database --env=development
```

**Outside the command line**
If you want to use any Firefly command from outside the command line (e.g: from a controller or middleware) you can use the static `Firefly::call()` method.

The first parameter is the command you want to call, and the second (optional) is an associative array with the arguments you want to pass, with each argument name being the key of the array.

_Example_
```php
use Glowie\Core\CLI\Firefly;
Firefly::call('test-database', ['env' => 'development']);
```

### Local development server
Firefly has the ability to run a local PHP development server in order to test Glowie locally without having Apache installed. To run this server, use:

```plaintext
php firefly shine
```

Optional arguments for this command are:

- `--host` - The hostname or IP address to use in the server. Defaults to `localhost`.
- `--port` - The port to use in the server. Defaults to `8080`.

To access your application, open http://localhost:8080 (or another host/port you've chosen) in your browser. Remember that this is only a testing server, **never use it in production**.

Also remember that the local development server does not come with any database server, so you must run it at your own.

### Clearing temporary files
To clear your application temporary files, use one of the following commands:

```plaintext
php firefly clear-cache
```

Clears the `app/storage/cache` folder. This will clear all [Skeltch](docs/%%version%%/extra/skeltch) prerendered views cache. Performance may be affected.

```plaintext
php firefly clear-session
```

Clears all stored sessions in `app/storage/session` folder. This will logout all users and flush all session data from your application.

```plaintext
php firefly clear-log
```

Clears the `app/storage/error.log` file.

### Testing a database connection
If you want to test an environment database connection, use the command `php firefly test-database`. There is an optional `--env` argument, that is the config environment (see [App configuration](docs/%%version%%/getting-started/app-configuration)) that you want to use while testing. Defaults to `production`.

_Example_
```plaintext
php firefly test-database --env=development
```

### Creating controllers
In order to create a new controller for your application, use:

```plaintext
php firefly create-controller --name=MyController
```

The `--name` argument is required, which is the name for your controller.

### Creating language files
In order to create a new language file for your application, use:

```plaintext
php firefly create-language --id=pt
```

The `--id` argument is required, which is the identificator for your language.

### Creating middlewares
In order to create a new middleware for your application, use:

```plaintext
php firefly create-middleware --name=MyMiddleware
```

The `--name` argument is required, which is the name for your middleware.

### Creating models
In order to create a new model for your application, use:

```plaintext
php firefly create-model --name=MyModel
```

The `--name` argument is required, which is the name for your model.

There are also the following optional arguments:

- `--table` - The model table name. Defaults to the model name lowercased.
- `--primary` - The table primary key name. Defaults to `id`.
- `--timestamps` - Handle timestamp fields in the model. Defaults to `true`.
- `--created` - Table created at field name. Defaults to `created_at`.
- `--updated` - Table updated at field name. Defaults to `updated_at`.

### Creating and running migrations
See [Migrations](docs/%%version%%/extra/migrations) to understand how to work with migrations using Firefly.