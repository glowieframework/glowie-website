# Views

[toc]

### Introduction
Views are simple files with HTML content (and preferably little to none simple PHP code) that displays information and visual feedback to the user. Basically, this is what the user "sees" when he is in your application.

A view can be a whole page or fragment of page. This is useful to show common parts of a website (like a header or footer) in multiple pages, since when editing a single file it will reflect the changes dinamically to all pages.

In Glowie, views must be loaded from a controller or from another view.

### View files location
All your aplication views must be stored into `app/views` folder. View files must end with **.phtml** extension.

You can also store views inside subfolders for better organization. Just remember to include the folder name as well when referring to a view file.

### Rendering a view file
To render a view from a controller or from inside another view, simply use the function `$this->renderView()` along with the view filename (the extension is optional).

_Example_
```php
$this->renderView('index'); # renders app/views/index.phtml file
```

**Note:** while using `$this->renderView()` from another view, it will include the file exactly where the code was executed.

### Rendering a view file with parameters
You can pass any parameter to a view while rendering it. To do that, use `$this->renderView()` and pass as the second parameter an associative array of parameters, with the variable name being the key and the value being the value itself.

This is useful to render views with dynamic content that relies on this variables (see the example below).

View parameters will be set as properties of the view instance itself. So, to retrieve a parameter from within a view, simply use `$this->param_name`.

_Example_
**controller**
```php
$this->renderView('index', ['name' => 'Glowie']);
```
**index.phtml**
```html
<h2>Hello, <?php echo $this->name; ?>!</h2>
<!-- This will print "Hello, Glowie!" -->
```

### Passing view parameters globally
You can also pass parameters to the view by assuming them as properties of controller global `$this->view` object.

In this particular way, depending on the scope you used while setting the property, the parameter will be acessed from all rendered views from that moment in the current controller.

_Example_
**controller**
```php
$this->view->name = 'Glowie';
$this->renderView('index');
$this->renderView('about');
```
**index.phtml**
```html
<h2>Hello, <?php echo $this->name; ?>!</h2>
<!-- This will print "Hello, Glowie!" -->
```
**about.phtml**
```html
<h2>Your name is <?php echo $this->name; ?>.</h2>
<!-- This will print "Your name is Glowie." -->
```

**Important!** Parameters passed through `$this->renderView()` method have higher privileges over the global ones. If you pass two parameters with the same name, the global parameter will be overwritten.

### Taking your views to a next level
If you want to learn a new way to create dynamic, pretty and professional coded views, take a look at [Skeltch](docs/%%version%%/extra/skeltch), Glowie built-in templating engine.