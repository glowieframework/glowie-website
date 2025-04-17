# CLI

[toc]

Firefly is Glowie's command line tool. This tool is suited to help you increase your workflow speed and have access to several Glowie utilities.

To run Firefly, from your console navigate to the application root folder and run:

```plaintext
php firefly help
```

This will give you a list of all available commands from Firefly.

### Using commands and arguments
When running a Firefly command, you must type in `php firefly` followed by the command you want to use. Each command can have optional arguments, that passes options to the command itself.

To use an argument, write two hyphens (`--`) followed by the argument name, an equal sign and the value you want to pass. You can use multiple arguments separating them by spaces.

**Note:** You cannot use spaces inside argument names or values.

_Example_
```plaintext
php firefly create-controller --name=MyController
```

**Outside the command line**
If you want to use any Firefly command from outside the command line (e.g: from a controller or middleware) you can use the static `Firefly::call()` method.

The first parameter is the command you want to call, and the second (optional) is an associative array with the arguments you want to pass, with each argument name being the key of the array.

_Example_
```php
use Glowie\Core\CLI\Firefly;
Firefly::call('create-controller', ['name' => 'MyController']);
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

### Interactive mode
Firefly has a built-in REPL environment for testing and sandboxing PHP code in real time without the need to run a web server. To enter this mode, use:

```plaintext
php firefly sandbox
```

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

### Testing the database connection
If you want to test the database connection for the current environment, use:

```plaintext
php firefly test-database
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
php firefly create-language --name=pt
```

The `--name` argument is required, which is the name for your language.

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

- `--table` - The model table name. Defaults to the model name in snake case.
- `--primary` - The table primary key name. Defaults to `id`.
- `--timestamps` - Handle timestamp fields in the model. Defaults to `true`.
- `--created` - Table created at field name. Defaults to `created_at`.
- `--updated` - Table updated at field name. Defaults to `updated_at`.

### Creating and running migrations
See [Migrations](docs/%%version%%/extra/migrations) to understand how to work with migrations using Firefly.

### Custom commands
You can create your own commands to use in Firefly in order to work with Glowie modules to handle data or perform any other tasks from the CLI interface.

**Creating the command**
A custom command is a simple PHP file with a command class in `Glowie\Commands` namespace stored in `app/commands` folder.

From Firefly itself you can use the following command to create a new custom command:

```plaintext
php firefly create-command --name=MyCommand
```

The command file must have the **exact same name** as the command class.

This is the default snippet for a command file:

```php
<?php
    namespace Glowie\Commands;

    use Glowie\Core\CLI\Command;

    class MyCommand extends Command{

        /**
         * The command script.
         */
        public function run(){
            // This method is required
        }

    }

?>
```

**The command script**
Every command class **must have** a public `run()` method. This method will be what your command does when it runs.

_Example_
```php
<?php
    namespace Glowie\Commands;

    use Glowie\Core\CLI\Command;

    class MyCommand extends Command{

        /**
         * The command script.
         */
        public function run(){
            $this->print('Hello world!');
        }

    }

?>
```

**Running a custom command**
To run a custom command, use `php firefly` followed by your command name.

_Example_
```plaintext
php firefly my-command
```

Command names will be parsed to **PascalCase** in order to match the command class name.

_Example:_ `hello-world` command will match the `HelloWorld` class.

**Printing data in the console**
To print a message to the console from your command, use `$this->print()` method.

The first parameter is the text you want to print, and the second is an optional break option. If you pass `false` as the second parameter, the message will not have a line break at the end.

_Example_
```php
$this->print('This is my message');
```

There are some aliases to this method that changes the color of the text that will be printed. Parameters are the same for all of them:

- `$this->success()` - Prints a success text, in green.
- `$this->fail()` - Prints a failure text, in red.
- `$this->warning()` - Prints a warning text, in yellow.
- `$this->info()` - Prints an info text, in blue.
- `$this->error()` - Prints an error text, with red background and black text.

If you want to print blank lines in the console, use `$this->line()` method, passing the number of lines you want to print as the first parameter. Defaults to a single line.

_Example_
```php
$this->line(3); # Prints 3 blank lines in the console
```

**Working with user input**
To ask the user for inputting a value, use `$this->input()` method.  The first parameter is an optional message to prompt to the user. The second is an optional default value for the input.

This method returns the input value as a string, or the default one if the user leave it blank.

_Example_
```php
$name = $this->input('What is your name?', 'Glowie');
```

**Working with arguments**
To retrieve an argument value from your command, use `$this->getArg()` method. The first parameter is the argument name to get, and the second is an optional default value. If the argument was not passed, the default value will be returned.

_Example_
**CLI**
```plaintext
php firefly my-command --name=Glowie
```

**command script**
```php
$name = $this->getArg('name'); # returns "Glowie"
```

If you want to retrieve all arguments passed with your command, use `$this->getArgs()` method. This method will return an associative array with each key being the argument name.

**Argument fallback**
If you want to retrieve an argument value, but in case it was not passed and you want to ask the user for the value, use `$this->argOrInput()` method.

The first parameter is the argument name to retrive. The second parameter is an optional message to prompt to the user. The third is an optional default value for the input.

If the argument was not passed, the user will be prompted to input the value. If the user leave it blank, the default value will be returned.

_Example_
```php
$name = $this->argOrInput('name', 'What is your name?');
```

If you want to retrieve an argument value or throw an exception if it was not provided, use the `$this->argOrFail()` method passing the argument name to check.

_Example_
```php
$name = $this->argOrFail('name');
```