# Middlewares
A middleware is a mechanism designed to protect routes and filter incoming requests to your application. This means, before entering a controller and calling an action, the middleware will perform some tasks to ensure that this process is allowed, and then tell Glowie router to continue or not the execution.

_Example:_ Authentication. You have an admin page that only logged in users are allowed to access. With a middleware you can protect this restricted areas to properly check if the user is logged in before entering them. If he is not, the user is redirected back to the login page.

Basically, a middleware is an "extra layer" added between the route and the controller.

### Creating a middleware
A middleware is a simple PHP file with a middleware class in `Glowie\Middlewares` namespace stored in `app/middlewares` folder.

The middleware file have the **exact same name** as the middleware class.

This is the default snippet for a middleware file:

```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Middleware;

    class MyMiddleware extends Middleware{

       public function handle(){
           // This method is required
       }

    }

?>
```

**Note:** middleware names SHOULD NOT include:
- accents
- dashes
- characters that are not letters, numbers or underscores

And for convention, every word in a middleware name must be capitalized.

_Example:_ for creating a `Hello world` middleware, the name must be `HelloWorld`.

### Assigning a route to a middleware
To create a protected route assigned to a middleware, in your route configuration file (see [Routes](docs/##VERSION##/basic-application-modules/routes)), use the static `Rails::addProtectedRoute()` method. 

This is basically the same as `Rails::addRoute()` method, with a difference that the **second** parameter is the full class name for the application middleware that will protect this route.

The middleware name must also include `Glowie\Middlewares` namespace. You can use `MiddlewareName::class` to get this property the correct way (see the example below).

If no middleware is specified, `Glowie\Middlewares\Authenticate` will be used by default.

_Example_
```php
use Glowie\Controllers\Admin;
use Glowie\Middlewares\Authenticate;

# myappurl.com/admin
Rails::addProtectedRoute('admin', Authenticate::class, Admin::class, 'index');
```

### Middleware handler
Every middleware class **must have** a public `handle()` method. This is the method where the middleware validation logics will run when the protected route is called.

This method must return `true` or `false`, indicating if Glowie router should continue the execution or not.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Middleware;

    class MyMiddleware extends Middleware{

       public function handle(){
           // Checks if the authorization header token is valid
           if($this->server->get('HTTP_AUTHORIZATION') == '1a79a4d60de6718e8e5b326e338ae533'){
               return true; # Continues to the controller
           }else{
               return false; # Stops the execution
           }
       }

    }

?>
```

### Middleware success
If the middleware handler method returns `true`, Glowie will send the request to the corresponding route controller and action. But, if you want the middleware to run something before that, you can create an optional public `success()` method in the middleware class.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Middleware;

    class MyMiddleware extends Middleware{

       public function handle(){
           // Checks if the authorization header token is valid
           if($this->server->get('HTTP_AUTHORIZATION') == '1a79a4d60de6718e8e5b326e338ae533'){
               return true; # Continues to the controller
           }else{
               return false; # Stops the execution
           }
       }

       public function success(){
           // Authorization token is valid, store it in the session
           $this->session->token = $this->server->get('HTTP_AUTHORIZATION');

           // After this, the route controller is triggered
       }

    }

?>
```

### Middleware fail
If the middleware handler method returns `false`, Glowie will stop the route execution and return a 403 Forbidden error. If you want to do something else if this happens, you can create an optional public `fail()` method in the middleware class and this method will be called instead.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Middleware;
    use Util;

    class MyMiddleware extends Middleware{

       public function handle(){
           // Checks if the authorization header token is valid
           if($this->server->get('HTTP_AUTHORIZATION') == '1a79a4d60de6718e8e5b326e338ae533'){
               return true; # Continues to the controller
           }else{
               return false; # Stops the execution
           }
       }

       public function fail(){
           // Authorization token is not valid, redirect the user to the index page
           Util::redirect('/');
       }

    }

?>
```

### init()
Every middleware can have an optional `init()` method. If this method exists, it will be called before the middleware handler.

This way you create common functions that will be propagated to the whole middleware before anything happens, instead of using the middleware constructor for that.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Middleware;

    class MyMiddleware extends Middleware{

       public function init(){
           // init methods goes here
       }

       public function handle(){
           // init() will be called before this method is triggered
       }

    }

?>
```