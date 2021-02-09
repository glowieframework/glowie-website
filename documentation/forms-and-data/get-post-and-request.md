You can handle parameters from any kind of request directly from a controller, with zero complications, using the following properties:

- `$this->get` - GET parameters.
- `$this->post` - POST parameters.
- `$this->request` - REQUEST parameters (both GET and POST).

Every property returns an object with each property being a request key.

_Example_
**form view**
```html
<form method="post" action="form/send">
    <input type="text" name="user" value="glowie">
    <input type="password" name="password" value="123">
    <button type="submit">Login</button>
</form>
```

**FormController**
```php
public function sendAction(){
    $user = $this->post->user; # returns 'glowie'
    $password = $this->post->password; # returns '123'
}
```