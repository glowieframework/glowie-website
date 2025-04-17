# Retrieving data
**Note:** See [Request](docs/%%version%%/basic-application-modules/request) in order to learn how to properly retrieve data in a much better way.

In order to retrieve a request data from a controller or middleware, there are three main properties that can be used:

- `$this->get` - Parameters passed to the request through the `GET` method.
- `$this->post` - Parameters passed to the request through the `POST` method.
- `$this->params` - Parameters passed in dynamic URLs (see [Routes](docs/%%version%%/basic-application-modules/routes)).

All properties return an [Element](docs/%%version%%/forms-and-data/element) with the corresponding data.

_Example 1_
**view**
```html
<form method="post" action="send">
    <input type="text" name="user" value="glowie">
    <input type="password" name="password" value="123">
    <button type="submit">Login</button>
</form>
```

**controller**
```php
public function send(){
    $user = $this->post->user; # returns "glowie"
    $password = $this->post->password; # returns "123"
}
```

_Example 2_
```php
# user types in myappurl.com/search?query=products&page=1
$query = $this->get->query; # returns "products"
$page = $this->get->page; # returns "1"
```

You can combine any of the [Element](docs/%%version%%/forms-and-data/element) methods to check for data, get default values or more.

_Example_
```php
# user types in myappurl.com/search?query=products
$page = $this->get->get('page', 1); # returns "1" as the default value
$isSearching = $this->get->has('query'); # returns true
```