# Retrieving data
In order to retrieve a request data from a controller or middleware, there are two main properties that can be used:

- `$this->get` - Parameters passed to the request through the `GET` method.
- `$this->post` - Parameters passed to the request through the `POST` method.

Both properties return an [Element](docs/%%version%%/forms-and-data/element) with the corresponding data.

_Example 1_
**form view**
```html
<form method="post" action="send">
    <input type="text" name="user" value="glowie">
    <input type="password" name="password" value="123">
    <button type="submit">Login</button>
</form>
```

**FormController**
```php
public function send(){
    $user = $this->post->user; # returns "glowie"
    $password = $this->post->password; # returns "123"
}
```

_Example 2_
**controller**
```php
# user types in myappurl.com/search?query=products&page=1
$query = $this->get->query; # returns "products"
$page = $this->get->page; # returns "1"
```

You can also use the methods from [Request](docs/%%version%%/basic-application-modules/request) instance to retrieve request data.