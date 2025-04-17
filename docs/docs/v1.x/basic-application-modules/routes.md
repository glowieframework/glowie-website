# Routes

[toc]

### Introduction
A route defines how your application will handle what the user types into the URL and take the correct action from there.

All your application route configuration is stored in `app/config/Routes.php` and handled by the `Glowie\Core\Http\Rails` class.

### Creating routes
You can create a new route in the route configuration file by using the static `Rails::addRoute()` method. The URI (what the user types into the URL - relative to the application folder) must be the first parameter, and the remaining parameters will be:

**controller**
The full class name for the application controller that this route will instantiate. Must be an existing controller in `app/controllers`.

The controller name must also include `Glowie\Controllers` namespace. You can use `ControllerName::class` to get this property properly (see examples below).

If no controller is specified, `Glowie\Controllers\Main` will be used by default.

**action**
The action that this route will instantiate. Must be a valid action from the specified controller.

If no action is specified, a **camelCase** version of the route name will be used.

**Note:** If the specified `controller` or `action` is not found, Glowie will trigger an error.

**methods**
The HTTP request methods that this route accepts. Can be a single method or an array of allowed methods (`get`, `post`, `put`, `patch` or `delete`). If the route is requested with a method other than the specified ones, Glowie will return a 405 Method Not Allowed error response.

If no method is specified, all methods will be accepted by default.

**name**
This is the name used to retrieve this route from your application. If no name is specified, a **kebab-case** version of the route URI will be used.

_Example_
```php
use Glowie\Controllers\Main;
use Glowie\Controllers\Blog;

# myappurl.com
Rails::addRoute('/', Main::class, 'index');

# myappurl.com/blog
Rails::addRoute('blog', Blog::class, 'index');

# myappurl.com/blog/new (only POST or PUT methods)
Rails::addRoute('blog/new', Blog::class, 'new', ['post', 'put'], 'blog-new');

```

**Note:** routes are parsed from first to last order, so the first matching route will be triggered.

**Important!** Route URIs and names are case-sensitive. This means route `blog` and `Blog` will be matched differently.

### Using dynamic route parameters
If your route needs to get a dynamic parameter within a friendly URL (like an ID, name, slug, etc.) you can bind this parameter into the route by using `:parameter_name`.

This means the route will accept **any value** (except slashes) in this segment.

_Example_
```php
use Glowie\Controllers\Blog;
use Glowie\Controllers\Products;

# myappurl.com/blog/(post id)
Rails::addRoute('blog/:id', Blog::class, 'index');

# myappurl.com/products/(category name)/(product id)
Rails::addRoute('products/:category/:id', Products::class, 'category');
```

You can retrieve this parameters from the controller or middleware by using `$this->params->param_name`.

_Example_
```php
$category = $this->params->category; # returns the category name typed in the URL
$id = $this->params->id; # returns the ID typed in the URL
```

### Optional route parameters
Currently, Glowie does not support optional route parameters natively, but there is a small workaround to work with this kind of route.

If you want to use an optional route parameter, create a new route for each of them, being sure to order your routes from the **most specific one** to the less specific one.

_Example_
```php
use Glowie\Controllers\Search;

// All parameters were filled
Rails::addRoute('search/:query/:page', Search::class, 'search');

// Only "query" parameter was filled
Rails::addRoute('search/:query', Search::class, 'search');

// No parameters were filled
Rails::addRoute('search', Search::class, 'search');
```

### Redirecting routes
If you just want to simply redirect a route to an URL, you don't need to write a controller for that. You can simply use `Rails::addRedirect()` method. The first parameter is the URI, and the remaining parameters are:

**target**
The target URL to redirect to.

**code**
The HTTP status code to send with the redirect (defaults to 307 Temporary Redirect).

**methods**
An single or an array of allowed HTTP request methods that will trigger this route. Same as in `Rails::addRoute()` methods setting (see above).

**name**
The route internal identifier. Same as in `Rails::addRoute()` methods setting (see above).

_Example_
```php
# myappurl.com/blog
Rails::addRedirect('blog', 'https://myappblog.wordpress.com');
```

### Mapping multiple routes
If you want to map multiple routes to a method at once, use the `Rails::mapRoutes()` method. It must receive an associative array as the first parameter, with the key being the route URI, and the value an array with the route **controller**, **action** and **name**. The second parameter is a single method or array of accepted methods.

_Example_
```php
use Glowie\Controllers\Blog;

Rails::mapRoutes([
    'blog/new' => [Blog::class, 'new', 'blog-new'],
    'blog/edit' => [Blog::class, 'edit', 'blog-edit'],
    'blog/delete' => [Blog::class, 'delete', 'blog-delete']
], ['post', 'put']);
```

### Auto routing
Glowie has the capability of parsing routes automatically if no route for the requested URI was specified.

Auto routing comes disabled by default. In order to enable it, in the route configuration file use:

```php
Rails::setAutoRouting(true);
```

In auto routing the routes will be parsed in the following way: `[controller]/[action]/[parameters...]`. Controller and action names will be resolved converting the URI to **PascalCase** (controller) and **camelCase** (action) versions.

_Example:_ `products-list-test` will be resolved to `ProductsListTest`.

If no controller is specified, `Glowie\Controllers\Main` will be used by default.

If no action is specified, `index` will be used by default.

_Example_
- User types in `myappurl.com`. Glowie will call `Main` controller with `index()` action.

- User types in `myappurl.com/about`. Glowie will call `About` controller with `index()` action.

- User types in `myappurl.com/about/contact`. Glowie will call `About` controller with `contact()` action.

- User types in `myappurl.com/products/list-products/123/abc`. Glowie will call `Products` controller with `listProducts()` action and the remaining parameters will be stored inside `$this->params` as an URI segment (split by each slash).

```php
echo $this->params->param1; # returns 123
echo $this->params->param2; # returns abc
```

If a corresponding controller or action is not found, Glowie will return a 404 Not Found error response.