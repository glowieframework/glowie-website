# Skeltch
Skeltch is a PHP preprocessor for Glowie views. When working with Skeltch you can simplify the amount of PHP code in your views and make them a lot prettier and easier to understand.

### Processing Skeltch views
To start using Skeltch, from your controller pass a `true` option as the last parameter of `$this->renderView()` or `$this->renderTemplate()` methods. This parameter will tell Glowie to process your Skeltch view into plain PHP code before loading it.

### Skeltch caching
If the `cache` option is enabled in your [App configuration](docs/getting-started/app-configuration), Skeltch will only compile a view if it hasn't been compiled yet or if there are any modifications to the view file. This cached view will be stored at `app/cache`. We highly recommend leaving caching on in a production environment, since it will boost your application performance significantly.

### Variables
In order to display PHP variables in the view using Skeltch, put the variable between two pairs of curly braces.

_Example_
**controller**
```php
$this->renderView('index', ['name' => 'Glowie'], true);
```
**index view**
```html
<h2>Hello, {{$name}}</h2>
<!-- This will print "Hello, Glowie" (w/o quotes) -->
```

This snippet is a shortcut to PHP `echo()` function. This means you can use here any function that returns a printable string.

All content passed within this shortcut will be treated inside `htmlspecialchars()` function to prevent XSS attacks. If for some reason you want to bypass this treatment, use two exclamation marks right after the first two braces.

_Example_
```html
<h2>Hello, {{!!$name}}</h2>
```

### Conditionals
Conditionals in Skeltch views are written in the following way:

```php
{@if($condition)}
    <!-- Your code here -->
{@elseif($condition)}
    <!-- Your code here -->
{@else}
    <!-- Your code here -->
{@endif}
```

You can use any valid PHP logic between the parentheses.

### Loops
In order to work with loops in the view using Skeltch, use any of the following snippets:

```php
{@for($i=0; $i < $count; $i++)}
    <!-- Your code here -->
{@endfor}
```

```php
{@foreach($variable as $key => $value)}
    <!-- Your code here -->
{@endforeach}
```

You can use any valid PHP iteration logic between the parentheses.

You can also use `break` and `continue` statements as:

```php
{@continue}
```

```php
{@break}
```

### Checkers
You can check for variables using the shortcuts for the functions `empty()` and `isset()`:

```php
{@empty($variable)}
    <!-- Your code here -->
{@endempty}
```

```php
{@notempty($variable)}
    <!-- Your code here -->
{@endempty}
```

```php
{@isset($variable)}
    <!-- Your code here -->
{@endisset}
```

```php
{@notset($variable)}
    <!-- Your code here -->
{@endisset}
```

You can also combine checkers with conditionals.

_Example_
```html
{@empty($name)}
    <b>Your name is empty!</b>
    {@else}
    <b>Hello, {{$name}}</b>
{@endempty}
```

### Rendering views and templates
The following snippets are shortcuts to `$this->renderView()` and `$this->renderTemplate()` functions. It uses the same parameters as described in [Views](docs/basic-application-modules/views) and [Templates](docs/basic-application-modules/templates).

```php
{@view('index', ['name' => 'Glowie'], true)}
```

```php
{@template('default', 'index', ['name' => 'Glowie'], true)}
```

### Comments
You can create comments by adding text between one pair of curly braces, starting with a hashtag. These comments will not be rendered into HTML.

_Example_
```php
{# Your comment goes here}
```

### Raw PHP code
If you want to write raw PHP code in your Skeltch view, put your code between one pair of curly braces, starting with a percent sign. 

**Note:** you must use semicolons when working with this kind of raw code.

_Example_
```php
{% $variable = 'test';}
```