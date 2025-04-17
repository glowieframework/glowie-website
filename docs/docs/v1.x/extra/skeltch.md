# Skeltch

[toc]

### Introduction
Skeltch is a templating engine for Glowie views. When working with Skeltch you can simplify the amount of PHP code in your views and make them a lot prettier and easier to understand.

### Processing views with Skeltch
In order to use Skeltch, in your [App configuration](docs/%%version%%/getting-started/app-configuration) for the current environment, set the `skeltch` setting to `true`. This will enable Skeltch compiling for all your application views.

_Example_
**Config.php**
```php
'skeltch' => true,
```

### Caching and performance
If the `cache` option is enabled in your [App configuration](docs/%%version%%/getting-started/app-configuration), Skeltch will only compile a view if it hasn't been compiled yet or if there are any modifications to the view file. This cached view will be stored at `app/storage/cache`. We highly recommend leaving caching on in a production environment, since it will boost your application performance significantly.

### Variables
In order to display PHP variables in the view using Skeltch, put the variable between two pairs of curly braces.

_Example_
**controller**
```php
$this->renderView('index', ['name' => 'Glowie']);
```
**index view**
```html
<h2>Hello, {{$this->name}}</h2>
<!-- This will print "Hello, Glowie" -->
```

This snippet is a shortcut to PHP `echo()` function. This means you can use here any function that returns a printable string.

All content passed within this shortcut will be treated inside `htmlspecialchars()` function to prevent XSS attacks. If for some reason you want to bypass this treatment, use two exclamation marks right after and before the braces.

_Example_
```html
<h2>Hello, {{!! $this->name !!}}</h2>
```

### Bypassing Skeltch compiling
While working with some frontend frameworks that also uses the curly braces syntax you may run into conflicts with Skeltch compiler. For dealing with this kind of conflict, simply put an `@` before the expression and it will be ignored by Skeltch.

_Example_
```html
Hello, @{{$var}}
```

In this case, Skeltch will remove the `@` symbol, but the rest of the expression will remain untouched for your frontend framework parser.

### Conditionals
Conditionals in Skeltch views are written in the following way:

```php
{if($condition)}
    <!-- Your code here -->
{elseif($condition)}
    <!-- Your code here -->
{else}
    <!-- Your code here -->
{/if}
```

You can use any valid PHP logic between the parentheses.

### Checkers
You can check for variables using the shortcuts for the functions `empty()` and `isset()`:

```php
{empty($variable)}
    <!-- Your code here -->
{/empty}
```

```php
{notempty($variable)}
    <!-- Your code here -->
{/notempty}
```

```php
{isset($variable)}
    <!-- Your code here -->
{/isset}
```

```php
{notset($variable)}
    <!-- Your code here -->
{/notset}
```

You can also combine checkers with conditionals.

_Example_
```html
{empty($name)}
    <b>Your name is empty!</b>
    {elseif($name == 'Gabriel')}
        <b>You have a beautiful name, huh?</b>
    {else}
        <b>Hello, {{$name}}</b>
{/empty}
```

### Loops
In order to work with loops in the view using Skeltch, use any of the following snippets:

```php
{for($i=0; $i < $count; $i++)}
    <!-- Your code here -->
{/for}
```

```php
{foreach($variable as $key => $value)}
    <!-- Your code here -->
{/foreach}
```

```php
{while($variable)}
    <!-- Your code here -->
{/while}
```

```php
{switch($variable)}
    {case('value')}
    <!-- Your code here -->

    {default}
    <!-- Your code here -->
{/switch}
```

You can use any valid PHP iteration logic between the parentheses.

You can also use `break` and `continue` statements as:

```php
{continue}
```

```php
{break}
```

### Glowie shortcuts
Skeltch also provides shortcuts to common Glowie functions used in views:

`$this->renderView()` (see [Views](docs/%%version%%/basic-application-modules/views))
```php
{@view('index', ['name' => 'Glowie'])}
```

`$this->renderLayout()` (see [Layouts](docs/%%version%%/basic-application-modules/layouts))
```php
{@layout('default', 'index', ['name' => 'Glowie'])}
```

`echo $this->getContent()` (see [Layouts](docs/%%version%%/basic-application-modules/layouts))
```php
{@content}
```

`echo Babel:get()` (see [Internationalization](docs/%%version%%/extra/internationalization))
```php
{@babel('message', 'en')}
```

`echo Util::baseUrl()` (see [Util](docs/%%version%%/extra/util))
```php
{@url('/')}
```

`echo Util::route()` (see [Util](docs/%%version%%/extra/util))
```php
{@route('products', ['id' => 1])}
```

`echo Util::asset()` (see [Util](docs/%%version%%/extra/util))
```php
{@asset('style.css')}
```

`echo Util::csrfToken()` (see [CSRF Protection](docs/%%version%%/forms-and-data/csrf-protection))
```php
{@csrf}
```

### Comments
You can create comments by adding text between one pair of curly braces, starting and ending with a hashtag. These comments will not be rendered into HTML.

_Example_
```php
{# Your comment goes here #}
```

### Raw PHP code
If you want to write raw PHP code in your Skeltch view, put your code between one pair of curly braces, starting and ending with a percent sign.

_Example_
```php
{% $variable = 'test' %}
```