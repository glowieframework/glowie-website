# Middlewares

[toc]

### Introduction
A middleware is a mechanism designed to protect routes and filter incoming requests to your application. This means, before entering a controller and calling an action, the middleware will perform some tasks to ensure that this process is allowed, and then tell Glowie router to continue or not the execution.

_Example:_ Authentication. You have an admin page that only logged in users are allowed to access. With a middleware you can protect this restricted areas to properly check if the user is logged in before entering them. If he is not, the user is redirected back to the login page.

Basically, a middleware is an "extra layer" added between the route and the controller.

### Creating a middleware
A middleware is a simple PHP file with a middleware class in `Glowie\Middlewares` namespace stored in `app/middlewares` folder.

From [Firefly](docs/%%version%%/extra/cli) CLI you can use the following command to create a new middleware:

```plaintext
php firefly create-middleware --name=MyMiddleware
```

The middleware file must have the **exact same name** as the middleware class.

This is the default snippet for a middleware file:

```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Http\Middleware;

    class MyMiddleware extends Middleware{

       /**
        * The middleware handler.
        * @return bool Should return true on success or false on fail.
        */
       public function handle(){
           // This method is required
       }

    }

?>
```

### Assigning a route to a middleware
To create a protected route assigned to a middleware, in your route configuration file (see [Routes](docs/%%version%%/basic-application-modules/routes)), use the static `Rails::addProtectedRoute()` method.

This is basically the same as `Rails::addRoute()` method, with a difference that the **second** parameter is the full class name for the application middleware that will protect this route.

The middleware name must also include `Glowie\Middlewares` namespace. You can use `MiddlewareName::class` to get this property properly (see the example below).

If no middleware is specified, `Glowie\Middlewares\Authenticate` will be used by default.

_Example_
```php
use Glowie\Controllers\Admin;
use Glowie\Middlewares\Authenticate;

# myappurl.com/admin
Rails::addProtectedRoute('admin', Authenticate::class, Admin::class, 'index');
```

**Multiple middlewares**
If you want to assign multiple middlewares to a route, you can pass an array of middlewares as the second parameter of this method. Be aware that each middleware will be executed following the same order as in the array.

_Example_
```php
use Glowie\Controllers\Login;
use Glowie\Middlewares\Authenticate;
use Glowie\Middlewares\ValidateCsrfToken;

# myappurl.com/login
Rails::addProtectedRoute('login', [ValidateCsrfToken::class, Authenticate::class], Login::class, 'index');
```

### Middleware handler
Every middleware class **must have** a public `handle()` method. This is the method where the middleware validation logics will run when the protected route is called.

This method must return `true` or `false`, indicating if Glowie router should continue the execution or not.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Http\Middleware;

    class MyMiddleware extends Middleware{

       /**
        * The middleware handler.
        * @return bool Should return true on success or false on fail.
        */
       public function handle(){
           // Checks if the "token" header token is valid
           if($this->request->getHeader('token') == '1a79a4d60de6718e8e5b326e338ae533'){
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

    use Glowie\Core\Http\Middleware;

    class MyMiddleware extends Middleware{

       /**
        * The middleware handler.
        * @return bool Should return true on success or false on fail.
        */
       public function handle(){
           // Checks if the "token" header token is valid
           if($this->request->getHeader('token') == '1a79a4d60de6718e8e5b326e338ae533'){
               return true; # Continues to the controller
           }else{
               return false; # Stops the execution
           }
       }

       /**
        * Called if the middleware handler returns true.
        */
       public function success(){
           // Header is valid, store it in the session
           $this->session->token = $this->request->getHeader('token');

           // After this, the route controller is triggered
       }

    }

?>
```

### Middleware fail
If the middleware handler method returns `false`, Glowie will stop the route execution and return a 403 Forbidden response error. If you want to do something else if this happens, you can create an optional public `fail()` method in the middleware class and this method will be called instead.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Http\Middleware;

    class MyMiddleware extends Middleware{

       /**
        * The middleware handler.
        * @return bool Should return true on success or false on fail.
        */
       public function handle(){
           // Checks if the "token" header token is valid
           if($this->request->getHeader('token') == '1a79a4d60de6718e8e5b326e338ae533'){
               return true; # Continues to the controller
           }else{
               return false; # Stops the execution
           }
       }

       /**
        * Called if the middleware handler returns false.
        */
       public function fail(){
           // Header is not valid, redirect the user back to the index page
           $this->response->redirect('/');
       }

    }

?>
```

### The `init()` method
Every middleware can have an optional `init()` method. If this method exists, it will be called before the middleware handler.

This way you create common functions that will be propagated to the whole middleware before anything happens.

**Note:** You should not use the `__construct()` method in a middleware. Always use `init()` instead.

_Example_
```php
<?php
    namespace Glowie\Middlewares;

    use Glowie\Core\Http\Middleware;

    class MyMiddleware extends Middleware{

       public function init(){
           // init methods goes here
       }

       /**
        * The middleware handler.
        * @return bool Should return true on success or false on fail.
        */
       public function handle(){
           // init() will be called before this method is triggered
           return true;
       }

    }

?>
```