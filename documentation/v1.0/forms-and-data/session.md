# Session
A session is a way to store data temporarily in the web browser and then retrieve it dynamically between all pages in your application.

_Example:_ A user logs in into your application using its email and password. Using sessions you can store this information and automatically validate the login in each page without prompting the user again for the login data.

Usually, the session data is stored until the user closes the web browser. For storing data locally for longer times, use [Cookies](docs/##VERSION##/forms-and-data/cookies).

Session data in Glowie can be managed using `Glowie\Core\Session` class. You don't need to instantiate this class in a controller or middleware, simply use `$this->session` property.

**Note:** Session data persists through all instances for the whole application.

### Storing session data
To store data in the session, use `$this->session->set()`. The first parameter is the key for the data you are storing, and the second parameter its value. Values can be any type of variable.

_Example_
```php
$this->session->set('name', 'Glowie'); # Stores "Glowie" value into "name" key (w/o quotes)
```

You can also use magic setters to store data as properties of the `Session` object.

_Example_
```php
$this->session->name = 'Glowie';
```

### Retrieving session data
To retrieve data from the session, use `$this->session->get()` passing the key for the data you are getting. If the key you provide does not exist, this function returns `null`.

_Example_
```php
$name = $this->session->get('name'); # Returns "Glowie" (w/o quotes)
```

The same way as in `$this->session->set()`, you can also use magic getters to retrieve data as properties from the `Session` object.

_Example_
```php
$name = $this->session->name;
```

To retrieve the whole session data as an associative array, use `$this->session->toArray()`.

### Checking for session data
If you want to check if some property is stored, use `$this->session->has()` along with the key you want to check.

_Example_
```php
$check = $this->session->has('name'); # Returns true
```

You can also use `isset()` function and the magic getter for the key you want to check.

_Example_
```php
$check = isset($this->session->name);
```

### Removing session data
You can remove data from the session by using `$this->session->remove()` along with the key for the data you want to remove.

_Example_
```php
$this->session->remove('name'); # Removes "name" key and its data
```

You can also remove data using `unset()` function and the magic getter for the key you want to remove.

_Example_
```php
unset($this->session->name);
```

To delete all data from an session at once, use `$this->session->flush()`.