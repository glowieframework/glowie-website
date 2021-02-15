# HTTP requests
An HTTP request is a way to "communicate" your application with external sources on the web. Using requests you can call APIs, retrieve data from another websites, among other functionalities.

You can make HTTP requests in a very simple and intuitive way using Glowie `Crawler` module.

From your controller, create a new instance of `Crawler` using:

```php
$crawler = new Glowie\Crawler();
```

### Making a request
To perform a request, use `$crawler->request()` function. This function accepts the following parameters:

**url**
The URL you want to request.

**method**
The HTTP method you want to use in the request. Default is `GET`.

**data**
Data to send in the request. Can be an associative array with the corresponding field names and values, JSON or plain text. **Content-Type** header must be needed depending on chosen data type.

**headers**
Custom headers to send in the request. Must be an associative array with the key being the **name** of the header and the value the header **value** (can be a string or an array of strings).

_Example_
```php
$headers = [
    'Content-Type' => 'text/plain',
    'X-Foo' => ['Bar', 'Baz']
];
```

**timeout**
Maximum number of seconds that this request can wait for a response. Default is 30 seconds. Use `0` for unlimited.

### Request shortcuts
You can use shortcuts to the most used request methods with any of the following functions:

```php
$crawler->get(); # GET request
$crawler->post(); # POST request
$crawler->put(); # PUT request
$crawler->patch(); # PATCH request
$crawler->delete(); # DELETE request
```

The parameters for this functions are the same from `$crawler->request()`, except for `GET` method, who does not accept `data` parameter.

### Getting a response
If the HTTP request is done successfully (with a 200 response code), Crawler will return the response body as a string, otherwise it returns `false`.