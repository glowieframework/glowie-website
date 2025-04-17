# Layouts

[toc]

### Introduction
A layout is a way to render views dynamically into a predefined file. When using a layout you can create a single file with all common parts of code from your application views (like headers, footers, meta tags, scripts, etc) and just change the content inside of it dynamically, making your application views easier to mantain.

### Layout files location
All your aplication layouts must be stored into `app/views/layouts` folder. Layout files must end with **.phtml** extension.

You can also store layouts inside subfolders for better organization. Just remember to include the folder name as well when referring to a layout file (see next).

### Rendering layouts
To render a layout from a controller, simply use the function `$this->renderLayout()` along with the layout filename (extension is optional).

Optionally, you can set a view to render dynamically inside this layout, you just need to pass the view filename as the second parameter of this function (works the same way as described in [Views](docs/%%version%%/basic-application-modules/views)).

_Example_
```php
$this->renderLayout('default', 'index'); # renders layout 'default' with view 'index'
```

### Placing dynamic view content inside layouts
When passing a view as the second parameter of `$this->renderLayout()` function, from the layout file you can retrieve its content dynamically by using `$this->getView()` function.

_Example_
**controller**
```php
$this->renderLayout('default', 'index');
```

**index view**
```html
<h2>Hello world!</h2>
```

**default layout**
```html
<html>
    <head>
        <title>My layout</title>
    </head>
    <body>
        <?php echo $this->getView(); ?>
        <!-- Prints "<h2>Hello world!</h2>" -->
    </body>
</html>
```

### Passing parameters to a layout
The same way as in a view, you can pass parameters to a layout as the third parameter of `$this->renderLayout()` function (see [Views](docs/%%version%%/basic-application-modules/views)).

**Note:** this parameters can be accessed from both the layout itself and from the dynamic rendered view inside the layout.

_Example_
**controller**
```php
$this->renderLayout('default', 'index', ['name' => 'Glowie']);
```

**index view**
```html
<h2>Hello, <?php echo $this->name; ?>!</h2>
```

**default layout**
```html
<html>
    <head>
        <title>Hello, <?php echo $this->name; ?>!</title>
        <!-- Prints "Hello, Glowie!" -->
    </head>
    <body>
        <?php echo $this->getView(); ?>
        <!-- Prints "<h2>Hello, Glowie!</h2>" -->
    </body>
</html>
```

You can also pass parameters to the layout file by using `$this->view` object (see [Views](docs/%%version%%/basic-application-modules/views)).