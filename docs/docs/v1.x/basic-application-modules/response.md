# Response

[toc]

### Introduction
A response tells your application what to send back to the user that made a request.

In order to manage the response, Glowie has the `Glowie\Core\Http\Response` class. From a controller or middleware, you don't need to instantiate this class to work with it, simply use `$this->response` property to directly access the `Response` object. If you want to retrieve the instance from other places, use the static `Rails::getResponse()` method.

### Setting the status code
To set the HTTP status code for the response, use `$this->response->setStatusCode()` method.

The first parameter is the code to set, and the second an optional custom reason phrase to send.

The `Response` class has a few constants with the most common status codes that can help you find faster the code you need.

_Example_
```php
use Glowie\Core\Http\Request;

// Sets a 403 Forbidden error code
$this->response->setStatusCode(Response::HTTP_FORBIDDEN);

// Sets a 403 Forbidden error code with custom message
$this->response->setStatusCode(Response::HTTP_FORBIDDEN, 'You cannot see this now!');
```

**Shortcuts**
There are some shortcuts for the most common response codes:

- `$this->response->deny()` - sets a **403 Forbidden** response code.

- `$this->response->notFound()` - sets a **404 Not Found** response code.

- `$this->response->fail()` - sets a **500 Internal Server Error** response code.

### Setting the response body
**As plain text**
In order to set a custom response body, you can use the `$this->response->setBody()` method. The first parameter is a plain text to send to the response.

_Example_
```php
$this->response->setBody('Success!');
```

**As JSON**
If you want to send a JSON output, use `$this->response->setJson()` method. The first parameter must be an associative array or an [Element](docs/%%version%%/forms-and-data/element) with the data to convert to JSON.

The remaining parameters are `flags` and `depth`, the same used in [json_encode()](https://php.net/manual/en/function.json-encode.php) method.

_Example_
```php
$data = ['success' => true, 'result' => 123];
$this->response->setJson($data);
```

**As XML**
You can also send a XML output using `$this->response->setXML()` method. The first parameter must be an associative array or an [Element](docs/%%version%%/forms-and-data/element) with the data to convert to XML. The second parameter is an optional XML root element.

_Example_
```php
$data = ['success' => true, 'result' => 123];
$this->response->setXML($data);
```

### Setting the response headers
In order to set a response header, use `$this->response->setHeader()` method. The first parameter is the header name, and the second the value you want to set.

_Example_
```php
$this->response->setHeader('Content-Encoding', 'gzip');
```

This method replaces existing headers with the same name. If you want to set a header without replacing its existing value, use `$this->response->appendHeader()`. Parameters are the same.

**Shortcuts**
There are also a few shortcuts to the most commonly used headers:

- `$this->response->setContentType()` - Sets the `Content-Type` header. The `Response` class has a few constants with the most common content types.

- `$this->response->setAuthorization()` - Sets a basic `Authorization` header. The first parameter is the username and the second is the password.

- `$this->response->setBearer()` - Sets a bearer `Authorization` header. The first parameter is the bearer token you want to set.

- `$this->response->setDownload()` - Forces a download of the content by setting the `Content-Disposition` header. The first parameter is the filename to set.

- `$this->response->disableCache()` - Disables the browser caching by setting the `Cache-Control` header.

### Redirecting URLs
In order to redirect your response to another URL, you can use the `$this->response->redirect()` method. The first parameter is the target URL to redirect to and the second an optional HTTP status code to pass with the redirect (default is **307**).

_Example_
```php
$this->response->redirect('https://google.com');
```

If you want to redirect to an URL or file relative to your application path, use `$this->response->redirectBase()`. The parameters are the same.

_Example_
```php
$this->response->redirectBase('myfile.pdf');
```

### Redirecting to a route
If you want to redirect to a specific route, use `$this->response->redirectRoute()` method.

The first parameter is the name of the route you want to redirect to. Must be a valid and named route from your application (see [Routes](docs/%%version%%/basic-application-modules/routes)).

The second parameter is an associative array of parameters to bind into the URL. If the route has dynamic parameters, you must pass all of them in this array. Remaining parameters will be appended to the URL query string.

_Example_
**Routes.php**
```php
use Glowie\Controllers\Products;
Rails::addRoute('products/:category', Products::class, 'index', [], 'products');
```

**controller**
```php
$this->response->redirectRoute('products', ['category' => 'computers', 'page' => 1]);
// Redirects to: myappurl.com/products/computers?page=1
```

There is also an optional third parameter with the HTTP status code to pass with the redirect (default is **307**).

If the route name is not valid or has missing parameters, Glowie will trigger an error.