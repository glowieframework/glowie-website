# Debugger
Debugger is a plugin for [Glowie Framework](https://github.com/glowieframework/glowie) with a powerful debug bar for developers.

<img style="width: 100%; max-width: 600px; margin-bottom: 30px;" src="https://i.imgur.com/mfcu69M.png" alt="Debugger">

## Table of contents
[toc]

## Features
- Beautiful and simple debug bar with zero configuration
- Print and filter messages, warnings, errors and variables to a console window
- Catch and print exceptions and stack traces to the console
- Measure long operations to a timeline and improve your app performance
- Inspect Request and Response variables and headers
- Inspect Session and Cookies data
- Log SQL queries, bindings and query durations
- Inspect rendered views, layouts and all its parameters
- Inspect application info, routes, memory usage, software versions, request time and more
- Automatic light and night mode themes

## Installation
Install in your Glowie project using Composer:

```shell
composer require glowieframework/debugger
```

Then add the Debugger class to the `app/config/Config.php` file, into the `plugins` array:

```php
'plugins' => [
    // ... other plugins here
    \Glowie\Plugins\Debugger\Debugger::class,
],
```

Inside your application main layout or desired view, add the Skeltch directive to the bottom of the page, before the closing `</body>` tag:

```html
<body>
    <!-- your page content here -->
    { debugger }
</body>
```

If you are not using Skeltch templating engine, you can also use the default PHP call:

```php
<body>
    <!-- your page content here -->
    <?php \Glowie\Plugins\Debugger\Debugger::render(); ?>
</body>
```

## Debug mode
**The debug bar must not be used in production mode.** In order to work, the `APP_DEBUG` configuration in your app `.env` file must be set to `true`. **Don't forget to disable this in production environment.**

```env
APP_DEBUG=true
```

### Enabling or disabling the debug bar at runtime
To enable or disable the rendering of the debug bar at runtime, use:

```php
use Glowie\Plugins\Debugger\Debugger;

Debugger::enable();

Debugger::disable();
```

>**Note:** The `enable()` method won't do anything if the debug mode is disabled in your app env.

## Usage

### Console window
To send messages to the console window, use any of the following methods:

```php
use Glowie\Plugins\Debugger\Debugger;

Debugger::log('Hello world!'); // Prints an info message
// or
Debugger::info('Hello world!');

Debugger::error('Something went wrong...'); // Prints an error message

Debugger::warning('Remember to check the docs.'); // Prints a warning message

Debugger::dump($myVar); // Dumps a variable to the console
```

### Exceptions window
To catch exceptions and print them to the exceptions tab, use:

```php
use Glowie\Plugins\Debugger\Debugger;

try {
    throw new Exception('Whoops!');
} catch (Exception $e) {
    Debugger::exception($e);
}
```

### Timeline window
You can measure operations using:

```php
use Glowie\Plugins\Debugger\Debugger;

Debugger::startTimer('test', 'My timer description');
// your long operation
Debugger::stopTimer('test');

// or
Debugger::measure('Test', function(){
    // your long operation
});
```

### Cross-request data
The debug bar data is saved only during the current request, and subsequents requests will erase the data.

If you need to persist the data over to the next request, use:

```php
use Glowie\Plugins\Debugger\Debugger;

Debugger::startCapture();
// your Debugger calls here
Debugger::stopCapture();

// or
Debugger::capture(function(){
    // your Debugger calls here
});
```

### Clear information
In order to clear the debug bar data, use:

```php
use Glowie\Plugins\Debugger\Debugger;

Debugger::clear(); // Clears the console

Debugger::clearExceptions(); // Clears the exceptions

Debugger::clearTimers(); // Clears the timers

Debugger::clearQueries(); // Clears the queries
```

## Credits
Debugger and Glowie are currently being developed by [Gabriel Silva](https://gabrielsilva.dev.br).