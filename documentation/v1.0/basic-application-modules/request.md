# Request
Whenever one of your application URLs are called, a request is received. This request carries the information that will be delivered to your application in order to get a proper response, this means, tell your application what to do and how to do.

In order to manage and work with this requests, Glowie has the `Glowie\Core\Http\Request` class. This class has useful methods to help you handle every kind of request your application receives.

From a controller or middleware, you don't need to instantiate this class to work with it, simply use `$this->request` property to directly access the `Request` object.

### Retrieving request details
In order to retrieve details about a request your application received, you can use the following functions:

- `$this->request->getURL()` - Returns the full requested URL. This means, the entire URL (including query string parameters) the user typed to access your application.
- `$this->request->getURI()` - Returns the clean requested URI. This means, only the URI (see [Routes](docs/##VERSION##/basic-application-modules/routes)) the user typed. This does not includes the hostname or query string parameters.

### Retrieving request data
In order to retrieve data that was passed through the request, there are three methods that you can use from the `Request` instance:

**getVar()**