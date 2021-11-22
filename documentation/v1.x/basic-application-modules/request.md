# Request
Whenever one of your application URLs are called, a request is received. This request carries the information that will be delivered to your application in order to get a proper response, this means, tell your application what to do and how to do, also sending data to your application.

In order to manage and work with this requests, Glowie has the `Glowie\Core\Http\Request` class. This class has useful methods to help you handle every kind of request your application receives.

From a controller or middleware, you don't need to instantiate this class to work with it, simply use `$this->request` property to directly access the `Request` object. If you want to retrieve the instance from other places, use the static `Rails::getRequest()` method.

### Retrieving request details
In order to retrieve details about a request your application received, you can use the following functions:

- `$this->request->getURL()` - Returns the full requested URL. This means, the entire URL (including query string parameters) the user typed to access your application.

- `$this->request->getURI()` - Returns the clean requested URI. This means, only the URI (see [Routes](docs/%%version%%/basic-application-modules/routes)) the user typed. This does not includes the hostname or query string parameters.

- `$this->request->getIPAddress()` - Returns the IP address used in the request, if available. If the IP address is not available, this method returns `0.0.0.0`.

- `$this->request->getMethod()` - Returns the HTTP method used in the request.

- `$this->request->isAjax()` - Returns `true` if the request was made using AJAX. Note that information relies in the `X-Requested-With` header. Be aware that this header cannot be sent by default from every Javascript framework.

- `$this->request->isSecure()` - Returns `true` if the request was made using a secure HTTPS connection.

### Retrieving request data
In order to retrieve data that was passed through the request, use the `$this->request->getVar()` method.

The first parameter is the variable key to get. The second is an optional default value. If the variable exists, its value will be returned. Otherwise, the default value will be returned.

This method can retrieve data passed from any kind of HTTP request method.

_Example_
```php
# user types in myappurl.com/search?query=products&page=1
$query = $this->request->getVar('products'); # returns "products"
$page = $this->request->getVar('page') # returns "1"
```

To retrieve all the request data at once as an associative array, use `$this->request->getVars()`.

**Raw data**
In order to get the raw request body as a string, use `$this->request->getBody()`.

**JSON data**
If the request data was sent as a JSON string, you can also use `$this->request->getJson()` to get an [Element](docs/%%version%%/forms-and-data/element) with the request data.

**Shortcuts**
See [Retrieving data](docs/%%version%%/forms-and-data/retrieving-data) for a list of shortcuts to retrieve request data.

### Working with request headers
Headers are piece of information that each request carries with it. In order to retrieve a specific request header value, use the `$this->request->getHeader()` method.

The first argument is the name of the header you want to get, and the second is an optional default value. If the header exists, its value will be returned. Otherwise, the default value will be returned.

_Example_
```php
$token = $this->request->getHeader('token');
```

To retrieve all the request headers at once as an associative array, use `$this->request->getHeaders()`.

**Shortcuts**
There are a few shortcuts to the most commonly used headers:

- `$this->request->getContentType()` - Returns the `Content-Type` header value or `null` if not available.

- `$this->request->getAuthorization()` - Returns an [Element](docs/%%version%%/forms-and-data/element) with the username and password passed through a basic `Authorization` header. If the header is not present or the Authorization is invalid, this method returns `null`.

- `$this->request->getPreviousUrl()` - Returns the previous URL where the user was refered from. Note that this information relies in the `Referer` header. Be aware that this header cannot be always available.

<div class="links">
    <a href="docs/%%version%%/basic-application-modules/middlewares"><- Middlewares</a>
    <a href="docs/%%version%%/basic-application-modules/response">Response -></a>
</div>