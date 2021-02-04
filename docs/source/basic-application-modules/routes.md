# Routes
A route defines how your application will handle what the user types into the URL and take the correct action from there.

All your application route configuration is stored in `app/config/Routes.php`.

### Declaring routes
You can declare all your application routes into the `$glowieRoutes['routes']` setting array. The URI must be especified as the key (what the user types into the URL - relative to the app folder), and its configuration as an array with the following properties:

**controller**
The application controller that this route will instantiate. Must be an existing controller in `app/controllers`. You don't need to use "controller" in the name (eg: for `BlogController`, use only `blog`). 

For better reading, you can use dashes to separate words in the controller name (eg: for `MyAppController`, you can use `my-app`).

If no controller is specified, `main` will be used by default.

**action**
The action that this route will instantiate. Must be a valid action in the specified controller. You don't need to use "action" in the name (eg: for `newAction()` use only `new`).

For better reading, you can use dashes to separate words in the action name (eg: for `myAppAction()`, you can use `my-app`).

If no action is specified, `index` will be used by default.

_Example_
```php
$glowieRoutes['routes'] = array(
    # myappurl.com
    '/' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    # myappurl.com/blog
    'blog' => [      
        'controller' => 'blog'
        'action' => 'index'
    ],

    # myappurl.com/blog/new
    'blog/new' => [
        'controller' => 'blog',
        'action' => 'new'
    ]
);
```

If the specified `controller` or `action` is not found, Glowie will trigger an error.

**Note:** routes are parsed from first to last order, so the first matching route will be triggered.

### Using dynamic route parameters
If your route needs to get a dynamic parameter with a friendly URL (like an ID, name, etc.) you can set this parameter into the route by using `:parameter_name`.

_Example_
```php
$glowieRoutes['routes'] = array(
    # myappurl.com/blog/(post id)
    'blog/:id' => [
        'controller' => 'blog',
        'action' => 'index'
    ],

    # myappurl.com/products/(category name)/(product id)
    'products/:category/:id' => [
        'controller' => 'products',
        'action' => 'category'
    ]
);
```

You can retrieve this parameters from the controller by using `$this->params->param_name`. Parameter names should follow PHP class property naming conventions.

_Example_
```php
$category = $this->params->category; # returns the category name typed in the URL
$id = $this->params->id; # returns the ID typed in the URL
```

### Auto routing
Glowie has the capability of parsing routes automatically if no route for the requested URI was specified.

In order to enable auto routing, in `app/config/Routes.php` you must set:

```php
$glowieRoutes['auto_routing'] = true;
```

In auto routing the routes will be parsed in the following way: `(controller)/(action)/(parameters)`.

_Example_
- User types in `myappurl.com`. Glowie will call `MainController` with `indexAction()`.

- User types in `myappurl.com/about`. Glowie will call `AboutController` with `indexAction()`.

- User types in `myappurl.com/about/contact`. Glowie will call `AboutController` with `contactAction()`.

- User types in `myappurl.com/products/list/123/abc`. Glowie will call `ProductsController` with `listAction()` and the remaining parameters will be stored inside `$this->params` as a URI segment (split by slashes).

```php
echo $this->params->segment1; # returns 123
echo $this->params->segment2; # returns abc
```

If a corresponding controller or action is not found, Glowie will respond with a 404 HTTP response code.

### Redirecting routes
If you just want to simply redirect a route to an URL, you don't need to write a controller for that. You can simply set a `redirect` config in the route, with the target URL as the value.

_Example_
```php
$glowieRoutes['routes'] = array(
    # myappurl.com/blog
    'blog' => [
        'redirect' => 'https://myappblog.wordpress.com'
    ]
);
```

**Note:** `redirect` has higher privileges over `controller` and `action` configuration. If this config is specified, it will be the priority for the route.