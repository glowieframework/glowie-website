# Query Builder

[toc]

### Introduction
Kraken is Glowie's powerful query builder and database ORM toolkit. It's time to you to master this incredible component and start working with databases in a way you've never done before.

### Connecting to a database
To start working with Kraken, you must create an instance of `Glowie\Core\Database\Kraken` class. Within Kraken constructor, you can optionally pass the table name you want to use as default for your queries (see also: [Models](docs/%%version%%/forms-and-data/models)).

_Example_
```php
use Glowie\Core\Database\Kraken;

$db = new Kraken('glowie'); // Sets "glowie" table as default
```

The second parameter passed in this constructor is the identifier of the database connection you want to use (from your database settings in `app/config/Config.php`).

### Changing the default table and database connection
If you want to change the default table or database connection without creating a new Kraken instance, use `$db->table()` and `$db->database()` functions.

### Escaping data
When working with any kind of user-input data, it's highly recommended to escape the data to avoid SQL injection attacks. Every Kraken default method will already escape the data for you, **excepts for raw methods**. In this case, you must use `$db->escape()` method, passing the desired data as the first parameter. This method will return the escaped data as a string.

_Example_
```php
$db->escape($this->post->email); // returns the "email" input properly escaped
```

In order to ignore the default data escaping, use the static `Kraken::raw()` method.

_Example_
```php
Kraken::raw($this->post->email); // Returns the "email" input unescaped
```

### Selecting data
In order to prepare a SELECT query, use `$db->select()` function. In this function you can pass a single field name or an array of fields to use in your query. You can also use a raw SELECT statement.

Use `$db->from()` to set a table name if you are not using the default table.

_Example_
```php
$db->select(); // Produces SELECT * FROM glowie
$db->select(['id', 'name'])->from('users'); // Produces SELECT id, name FROM users
$db->select('COUNT(ID) AS total'); // Produces SELECT COUNT(ID) AS total FROM glowie
```

If you want to append columns to an existing SELECT query, use `$db->addSelect()` method. Parameters are the same.

_Example_
```php
$db->addSelect('status'); // Adds the column "status" to the SELECT statement
```

To perform a SELECT DISTINCT query, use `$db->distinct()`.

_Example_
```php
$db->select('id')->distinct(); // Produces SELECT DISTINCT id FROM glowie
```

### Fetching SELECT data
In order to fetch data from a SELECT query, use `$db->fetchAll()`. This function returns an array with each row from the query result as an [Element](docs/%%version%%/forms-and-data/element). You can also use `$db->fetchRow()` to get only the first resulting row from the query.

_Example_
```php
$result = $db->select()->fetchAll();
```

If you pass a `true` option as the first parameter of these methods, the results will be returned as associative arrays instead of objects.

### WHERE conditions
In order to add a WHERE condition to your query, you can use the `$db->where()` method and its variations.

**Basic chaining**
Passing the column name as the first parameter and the value as the second will produce a basic equal comparison. If you want to use another operator, pass it as the second parameter and the value as the third parameter.

_Example_
```php
$db->where('id', 1); // Produces WHERE id = "1"
$db->where('status', '!=', 0); // Produces WHERE status != "0"
$db->where('name', 'LIKE', '%gabriel%'); // Produces WHERE name LIKE "%gabriel%"
```

Subsequent WHERE calls will chain the conditions with AND parameters.

_Example_
```php
$db->where('id', 1)
    ->where('status', '!=', 0);
// Produces WHERE id = "1" AND status != "0"
```

You can also pass an array of multiple WHERE conditions as the first parameter only. Each condition must be another array with at least two parameters (the same used in `$db->where()` method).

_Example_
```php
$db->where([
    ['id', 1],
    ['status', '!=', 0],
    ['name', 'LIKE', '%gabriel%']
]);
// Produces WHERE id = "1" AND status != "0" AND name LIKE "%gabriel%"
```

**OR comparisons**
In order to create an OR chaining to your WHERE conditions, use the `$db->orWhere()` method. Parameters are the same from `$db->where()`.

_Example_
```php
$db->where('id', 1)
   ->orWhere('id', 2);
// Produces WHERE id = "1" OR id = "2"
```

-----
_Documentation session under development..._ [Contribute!](https://github.com/glowieframework/glowie-website/tree/main/documentation)