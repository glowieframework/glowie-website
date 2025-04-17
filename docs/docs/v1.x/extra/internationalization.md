# Internationalization

[toc]

### Introduction
Glowie provides a very simple, yet powerful module to work with multilanguage applications. This is a static class called `Babel`.

### Creating a language file
All your application language files should be stored in `app/languages`. Create a PHP file inside this folder with the name of the language you are using (example: `en.php`).

From [Firefly](docs/%%version%%/extra/cli) CLI you can use the following command to create a new language file:

```php
php firefly create-language --name=en
```

Inside this file you must return an associative array with your language strings and its keys.

_Example_
```php
return [
    'welcome' => 'Welcome to my application',
    'error' => 'An error has ocurred'
];
```

### Retrieving an internationalization string
You can retrieve an internationalization string from your controller, middleware, model or view by using `Babel::get()` function along with the string key and the language you want to use. If you do not specify the language, Babel will try to get the string from the current active language (see next).

If the key does not exists, this function returns `null`. If the language does not exist, Glowie will throw an exception.

_Example_
```php
$welcome = Babel::get('welcome', 'en'); # returns "Welcome to my application"
```

### Setting the active language
If you want to shorten the use of `Babel::get()` function, you can set a default language for retrieving internationalization strings.

_Example_
```php
Babel::setActiveLanguage('pt'); # sets "pt" as the default language
```

All `Babel::get()` functions (those used without the second parameter) from this moment will use the language you defined.

To retrieve the current active language name, use `Babel::getActiveLanguage()`.