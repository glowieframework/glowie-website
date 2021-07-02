# Skeltch
Skeltch is a templating engine for Glowie views. When working with Skeltch you can simplify the amount of PHP code in your views and make them a lot prettier and easier to understand.

### Processing Skeltch views
To start using Skeltch, from your controller or view pass a `true` option as the last parameter of `$this->renderView()` or `$this->renderLayout()` methods. This parameter will tell Glowie to compile your Skeltch view into plain PHP code before loading it.

**Note:** You must also pass this parameter in views rendered inside other views, even if the parent view was processed using Skeltch.

### Caching and performance
If the `cache` option is enabled in your [App configuration](docs/##VERSION##/getting-started/app-configuration), Skeltch will only compile a view if it hasn't been compiled yet or if there are any modifications to the view file. This cached view will be stored at `app/storage/cache`. We highly recommend leaving caching on in a production environment, since it will boost your application performance significantly.

### Variables
In order to display PHP variables in the view using Skeltch, put the variable between two pairs of curly braces.

_Example_
**controller**
```php
$this->renderView('index', ['name' => 'Glowie'], true);
```
**index view**
```html
<h2>Hello, {{$this->name}}</h2>
<!-- This will print "Hello, Glowie" (w/o quotes) -->
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

You can use any valid PHP iteration logic between the parentheses.

You can also use `break` and `continue` statements as:

```php
{continue}
```

```php
{break}
```

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

### Glowie shortcuts
Skeltch also provides shortcuts to common Glowie functions used in views:

`$this->renderView()` (see [Views](docs/##VERSION##/basic-application-modules/views))
```php
{@view('index', ['name' => 'Glowie'], true)}
```

`$this->renderLayout()` (see [Layouts](docs/##VERSION##/basic-application-modules/layouts))
```php
{@layout('default', 'index', ['name' => 'Glowie'], true)}
```

`echo Babel:get()` (see [Internationalization](docs/##VERSION##/extra/internationalization))
```php
{@babel('message', 'en')}
```

`echo Util::baseUrl()` (see [Util](docs/##VERSION##/extra/util))
```php
{@base('/')}
```

`echo Util::route()` (see [Util](docs/##VERSION##/extra/util))
```php
{@route('products', ['id' => 1])}
```

`echo $this->getContent()` (see [Layouts](docs/##VERSION##/basic-application-modules/layouts))
```php
{@content}
```

### Comments
You can create comments by adding text between one pair of curly braces, starting and ending with a hashtag. These comments will not be rendered into HTML.

_Example_
```php
{# Your comment goes here #}
```

### Raw PHP code
If you want to write raw PHP code in your Skeltch view, put your code between one pair of curly braces, starting and ending with a percent sign. 

**Note:** you must use semicolons when working with this kind of code.

_Example_
```php
{% $variable = 'test'; %}
```
