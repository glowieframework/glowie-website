# Internationalization
Glowie provides a very simple, yet powerful module to work with multilanguage applications. This is a static class called `Babel`.

### Creating a language file
All your application language files should be stored in `app/languages`. Create a PHP file inside this folder with the name of the language you are using (example: `en.php`).

Inside this file, you can setup the language strings by using the function `Babel::set()`. The first parameter is the language identifier you are setting, and the second an associative array of internationalization strings with its key and value.

_Example_
```php
Babel::set('en', [
    'welcome' => 'Welcome to my application',
    'error' => 'An error has ocurred'
]);
```

**Note:** when using `Babel::set()` function, you replace the entire language configuration by the new array you've just set. If you want to add or change a single string dynamically without modifying the whole language setting, use `Babel::setString()` with the language identifier, string key and string value.

_Example_
```php
Babel::setString('en', 'error', 'Sorry! An error has ocurred');
# changes the "error" key in "en" language
```

### Retrieving an internationalization string
You can retrieve an internationalization string from your controller, middleware, model or view by using `Babel::get()` function along with the string key and the language you want to use. If you do not specify the language, Babel will try to get the string from the current active language (see next).

If the key does not exists, this function returns `null`. If the language does not exists, Glowie will trigger an error.

_Example_
```php
$welcome = Babel::get('welcome', 'en'); # returns "Welcome to my application" (w/o quotes)
```

### Setting the active language
If you want to short the use of `Babel::get()` function, you can set a default language for retrieving internationalization strings.

_Example_
```php
Babel::setActiveLanguage('pt'); # sets "pt" as the default language
```

All `Babel::get()` functions (those used without the second parameter) from this moment will use the language you defined.