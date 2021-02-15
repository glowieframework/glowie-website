# Session
A session is a way to store user activity temporarily in the web browser and then retrieve it dynamically from your application.

_Example:_ A user logs in into your application using its email and password. Using sessions you can store this information and automatically validate the login in each page without prompting the user again for the login data.

Sessions in Glowie can be managed using `Session` class.

### Starting sessions
In order to work with session data, you must start a new session handler in your controller.

```php
$session = new Glowie\Session();
```

### Storing session data
To store session data, use `$session->set()`. The first parameter is the key for the data you are storing, and the second parameter its value. Values can be any type of variable.

_Example_
```php
$session->set('name', 'Glowie'); # Stores "Glowie" value into "name" key (w/o quotes)
```

You can also use magic setters to store session data as parameters from `Session` object.

_Example_
```php
$session->name = 'Glowie';
```

### Getting session data
To retrieve stored session data, use `$session->get()` passing the key for the data you are getting. If the key you provide does not exist, this function returns `null`.

_Example_
```php
$name = $session->get('name'); # Returns "Glowie" (w/o quotes)
```

If you leave the key empty, this function will return an object with all session data.

The same way as in `$session->set()`, you can also use magic getters to retrieve session data as parameters from `Session` object.

_Example_
```php
$name = $session->name;
```

### Checking for session data
If you want to check if some session data is stored, use `$session->has()` along with the key you want to check.

_Example_
```php
$check = $session->has('name'); # Returns true
```

You can also use `isset()` function and the magic getter for the key you want to check.

_Example_
```php
$check = isset($session->name);
```

### Removing session data
You can remove session data by using `$session->remove()` along with the key for the data you want to remove.

_Example_
```php
$session->remove('name'); # Removes "name" key and its data
```

You can also remove session data using `unset()` function and the magic getter for the key you want to remove.

_Example_
```php
unset($session->name);
```

### Destroying current session
You can destroy a whole session and delete all its data using `$session->destroy()`.

**Note:** after destroying a session, you must start a new one if you want to use session data again.