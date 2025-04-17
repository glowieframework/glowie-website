# HTTP requests

[toc]

### Introduction
An HTTP request is a way to "communicate" your application with external sources on the web. Using requests you can call APIs, retrieve data from another websites, among other functionalities.

You can make HTTP requests in a very simple and intuitive way using Glowie `Crawler` class.

From your controller, create a new instance of `Glowie\Core\Tools\Crawler` using:

```php
use Glowie\Core\Tools\Crawler;
$crawler = new Crawler();
```

You can pass three optional parameters in the constructor: the first is an array of custom headers to send in the request. Must be an associative array with the key being the **name** of the header and the value the header **value** (can be a string or an array of strings).

_Example_
```php
use Glowie\Core\Tools\Crawler;

$headers = [
    'Content-Type' => 'text/plain',
    'X-Foo' => ['Bar', 'Baz']
];

$crawler = new Crawler($headers);
```

The second parameter is an array of custom cookies to send in the request. Must be an associative array with the key being the **name** of the header and the value the header **value**.

_Example_
```php
use Glowie\Core\Tools\Crawler;

$cookies = [
    'mycookie' => '1234'
]

$crawler = new Crawler($headers, $cookies);
```

The third parameter is the **timeout** setting. See below how it works.

### Adding request headers
If you want to add a header to the request, use the `$crawler->addHeader()` method. The first parameter is the header name, and the second the value you want to set.

_Example_
```php
$crawler->addHeader('Content-Encoding', 'gzip');
```

**Shortcuts**
There are also a few shortcuts to the most commonly used headers:

- `$crawler->setContentType()` - Sets the `Content-Type` header. The `Crawler` class has a few constants with the most common content types.

- `$crawler->setAuthorization()` - Sets a basic `Authorization` header. The first parameter is the username and the second is the password.

### Adding request cookies
If you want to pass custom cookies in the request, use the `$crawler->addCookie()` method. The first parameter is the cookie name, and the second the value you want to set.

_Example_
```php
$crawler->addCookie('mycookie', '1234');
```

### Setting the request timeout
If you want to set the request timeout, use `$crawler->setTimeout()` method.

The first parameter is the maximum number of seconds that the request can wait for a response before failing. Default is `30 seconds`. Use `0` for unlimited.

_Example_
```php
$crawler->setTimeout(10); # Sets the timeout to 10 seconds
```

### Making the request
To perform a request, use `$crawler->request()` function. This function accepts the following parameters:

**url**
The URL you want to request.

**method**
The HTTP method you want to use in the request. Default is `GET`.

**data**
Data to send in the request. `Content-Type` header must be needed depending on chosen data type.

_Example_
```php
$data = [
    'id' = 1,
    'name' => 'Glowie'
];

$result = $crawler->request('https://myrequesturl.com', 'POST', $data);
```

**Shortcuts**
You can use shortcuts to the most used request methods with any of the following functions:

```php
$crawler->get(); # GET request
$crawler->post(); # POST request
$crawler->put(); # PUT request
$crawler->patch(); # PATCH request
$crawler->delete(); # DELETE request
```

The parameters for this functions are the same from `$crawler->request()`, except for `GET` method, who does not accept the `data` parameter.

### Getting the response
If the HTTP request is done successfully (with a 200 response code), Crawler will return the response body as a string, otherwise it returns `false`.