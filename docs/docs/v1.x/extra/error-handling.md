# Error handling

[toc]

### Introduction
In order to handle and display custom HTTP error pages, Glowie has the `Glowie\Controllers\Error` controller, that comes by default with every Glowie installation.

This controller works as any other [Controller](docs/%%version%%/basic-application-modules/controllers) from your application, with the slight difference that it will be called automatically by the router when an HTTP error is raised.

By default, Glowie will simply render the default error view located in `app/views/error` with the corresponding message from [Internationalization](docs/%%version%%/extra/internationalization), but you can customize this controller to do whatever you want.

### 403 Forbidden
403 Forbidden errors are handled by the `forbidden()` action. This action is mainly triggered when a middleware handler fails.

```php
public function forbidden(){
    // Renders 403 error page
    $this->renderLayout('default', 'error/error', [
        'title' => 'Access forbidden',
        'code' => 403,
        'message' => Babel::get('forbidden')
    ]);
}
```

### 404 Not Found
404 Not Found errors are handled by the `notFound()` action. This action is mainly triggered when a requested route is not found.

```php
public function notFound(){
    // Renders 404 error page
    $this->renderLayout('default', 'error/error', [
        'title' => 'Page not found',
        'code' => 404,
        'message' => Babel::get('not_found')
    ]);
}
```

### 405 Method Not Allowed
405 Method Not Allowed errors are handled by the `methodNotAllowed()` action. This action is mainly triggered when a route is requested using a method that does not match your route configuration.

```php
public function methodNotAllowed(){
    // Renders 405 error page
    $this->renderLayout('default', 'error/error', [
        'title' => 'Not allowed',
        'code' => 405,
        'message' => Babel::get('not_allowed')
    ]);
}
```