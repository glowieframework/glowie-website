# Element

[toc]

### Introduction
Element is a Glowie generic object instance used to store and handle data. Basically everything data-related in Glowie will use an object of type `Element`. Here you'll find more about this class and how to work with it.

### Creating an Element
To start an Element object, create a new instance of the `Glowie\Core\Element` class.

_Example_
```php
use Glowie\Core\Element;
$element = new Element();
```

Optionally, you can pass as the first argument of the constructor an associative array of data. By doing so, the `Element` object will fill its properties using the keys and values from this array.

### Storing data
To store data in the Element, use `$element->set()`. The first parameter is the key for the data you are storing, and the second parameter its value. Values can be any type of variable.

_Example_
```php
$element->set('name', 'Glowie'); # Stores "Glowie" value into "name" key
```

You can also use magic setters to store data as properties of the `Element` object.

_Example_
```php
$element->name = 'Glowie';
```

### Retrieving data
To retrieve data from the Element, use `$element->get()` passing the key for the data you are getting.

The second parameter is an optional default value. If the key you provide does not exist, this function returns the default value you've set.

_Example_
```php
$name = $element->get('name'); # Returns "Glowie"
$page = $element->get('page', 1); # Returns "1"
```

The same way as in `$element->set()`, you can also use magic getters to retrieve data as properties from the `Element` object.

_Example_
```php
$name = $element->name;
```

**Converting data**
To retrieve the whole Element data as an associative array, use `$element->toArray()`.

You can also convert the Element data to a JSON string with `$element->toJson()`.

### Checking for data
If you want to check if some property is stored, use `$element->has()` along with the key you want to check. You can also use an array of keys to check for.

_Example_
```php
$check = $element->has('name'); # Returns true
```

You can also use `isset()` function and the magic getter for the key you want to check.

_Example_
```php
$check = isset($element->name);
```

### Removing data
You can remove data from the Element by using `$element->remove()` along with the key for the data you want to remove. You can also use an array of keys to remove.

_Example_
```php
$element->remove('name'); # Removes "name" key and its data
```

You can also remove data using `unset()` function and the magic getter for the key you want to remove.

_Example_
```php
unset($element->name);
```

To delete all data from an Element at once, use `$element->flush()`.

If you want to delete all data from the Element, but keep some specific properties, use `$element->only()` passing and array of the keys you want to keep.