# Templates
A template is a way to render views dynamically into a predefined file. When using a template you can create a single file with all common parts of code from your application views (like headers, footers, meta tags, scripts, etc) and just change the content inside of it dynamically, making your application layout easier to mantain.

### Template files location
All your aplication templates must be stored into `app/views/templates` folder. Template files must end with **.phtml** extension.

You can also store templates inside subfolders for better organization. Just remember to include the folder name as well when referring a template file (see next).

### Rendering templates
To render a template from a controller, simply use the function `$this->renderTemplate()` along with the template filename (**without** the extension).

Optionally, you can set a view to render dynamically inside this template, you just need to pass the view filename as the second parameter of this function (works the same way as described in [Views](docs/basic-application-modules/views)).

_Example_
```php
$this->renderTemplate('default', 'index'); # renders template 'default' with view 'index'
```

### Placing dynamic view content inside templates
When passing a view as the second parameter of `$this->renderTemplate()` function, from the template file you can retrieve its content dynamically by using `$this->content`.

_Example_
**controller**
```php
$this->renderTemplate('default', 'index');
```

**index view**
```html
<h2>Hello world!</h2>
```

**default template**
```html
<html>
    <head>
        <title>My template</title>
    </head>
    <body>
        <?php echo $this->content; ?>
        <!-- Prints "<h2>Hello world!</h2>" (w/o quotes) -->
    </body>
</html>
```

### Passing parameters to a template
The same way as in a view, you can pass parameters to a template as the third parameter of `$this->renderTemplate()` function (see [Views](docs/basic-application-modules/views)).

**Note:** this parameters can be accessed from both the template itself and from the dynamic rendered view inside the template.

_Example_
**controller**
```php
$this->renderTemplate('default', 'index', ['name' => 'Glowie']);
```

**index view**
```html
<h2>Hello, <?php echo $this->name; ?>!</h2>
```

**default template**
```html
<html>
    <head>
        <title>Hello, <?php echo $this->name; ?>!</title>
        <!-- Prints "Hello, Glowie!" (w/o quotes) -->
    </head>
    <body>
        <?php echo $this->content; ?>
        <!-- Prints "<h2>Hello, Glowie!</h2>" (w/o quotes) -->
    </body>
</html>
```

You can also pass parameters to the template file by using `$this->view` object (see [Views](docs/basic-application-modules/views)).