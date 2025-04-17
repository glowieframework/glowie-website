# Session

[toc]

### Introduction
A session is a way to store data temporarily in the web browser and then retrieve it dynamically between all pages in your application.

_Example:_ A user logs in into your application using its email and password. Using sessions you can store this information and automatically validate the login in each page without prompting the user again for the login data.

Usually, the session data is stored until the user closes the web browser. For storing data locally for longer times, use [Cookies](docs/%%version%%/forms-and-data/cookies).

Session data in Glowie can be managed using `Glowie\Core\Http\Session` class. You don't need to instantiate this class in a controller or middleware to work with it, simply use `$this->session` property to directly access the `Session` object.

**Note:** Session data persists through all instances for the whole application.

### Storing session data
To store data in the session, use `$this->session->set()`. The first parameter is the key for the data you are storing, and the second parameter its value. Values can be any type of variable.

_Example_
```php
$this->session->set('name', 'Glowie'); # Stores "Glowie" value into "name" key
```

You can also use magic setters to store data as properties of the `Session` object.

_Example_
```php
$this->session->name = 'Glowie';
```

### Retrieving session data
To retrieve data from the session, use `$this->session->get()` passing the key for the data you are getting.

The second parameter is an optional default value. If the key you provide does not exist, this function returns the default value you've set.

_Example_
```php
$name = $this->session->get('name'); # Returns "Glowie"
$page = $this->session->get('page', 1); # Returns "1"
```

The same way as in `$this->session->set()`, you can also use magic getters to retrieve data as properties from the `Session` object.

_Example_
```php
$name = $this->session->name;
```

**Converting data**
To retrieve the whole session data as an associative array, use `$this->session->toArray()`.

You can also convert the session data to a JSON string with `$this->session->toJson()`.

### Checking for session data
If you want to check if some property is stored, use `$this->session->has()` along with the key you want to check. You can also use an array of keys to check for.

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
You can remove data from the session by using `$this->session->remove()` along with the key for the data you want to remove. You can also use an array of keys to remove.

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

If you want to delete all data from the session, but keep some specific properties, use `$this->session->only()` passing and array of the keys you want to keep.

### Session flash data
If you want to, you can store temporary data in the session in order to use it just a single time in the next request. This is called **flash data**.

In order to store session flash data, use `$this->session->setFlash()` along with the key for the data you are storing as the first paramenter, and its value as the second.

To retrieve session flash data, use `$this->session->getFlash()` along with the key for the data you are getting. The second parameter is an optional default value. If the key you provide does not exist, this function returns the default value you've set.

As soon as the data is retrieved once, it is deleted from the session.

_Example_
```php
$this->session->setFlash('name', 'Glowie'); # Stores "Glowie" value into "name" key
$name = $this->session->getFlash('name'); # Returns "Glowie"
$name = $this->session->getFlash('name'); # Returns null, flash data was already deleted
```

### Persisting session data
If you want to persist the current session data to a long-life cookie (see [Cookies](docs/%%version%%/forms-and-data/cookies)), use `$this->session->persist()` method, passing the expire time in seconds.

To delete the cookie with the persisted session data, use `$this->session->flushPersistent()`. This also deletes the whole session data.