# Mastering Kraken
Kraken is Glowie's powerful query builder and database toolkit. It's time to you to master this incredible component and start working with databases in a way you've never done before.

### Connecting to a database
To start working with Kraken, you must create an instance of `Glowie\Core\Kraken` class. Withing Kraken constructor, you can pass the table name you want to use as default for your queries (see [Models](docs/##VERSION##/forms-and-data/models)).

_Example_
```php
use Glowie\Core\Kraken;

$db = new Kraken('glowie'); // Sets "glowie" table as default
```

The second parameter passed in this constructor is the database connection you want to use. If you leave this empty, Glowie will connect to your application globally defined database (the one you've set in `app/config/Config.php`). If you want to connect to a different database, pass an array with the connection settings as the second parameter. The array must follow the same structure as in `Config.php` database setting (see [App configuration](docs/##VERSION##/getting-started/app-configuration)).

_Example_
```php
use Glowie\Core\Kraken;

$db = new Kraken('users', [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'glowie',
    'port' => 3306
]);
```

### Changing the default table and database connection
If you want to change the default table or database connection without creating a new Kraken instance, use `$db->setTable()` and `$db->setDatabase()` functions. The parameters within this functions are exactly the same for the constructor.

### Selecting data
In order to prepare a SELECT query, use `$db->select()` function. In this function you can pass a single field name or an array of fields to use in your query. You can also use a raw SELECT statement.

Use `$db->from()` to set a table name if you are not using the default table.

_Example_
```php
$db->select(); // Produces SELECT * FROM glowie
$db->select(['id', 'name'])->from('users'); // Produces SELECT id, name FROM users
$db->select('COUNT(ID)'); // Produces SELECT COUNT(ID) FROM glowie
```

### Fetching SELECT data
In order to fetch data from a SELECT query, use `$db->fetchAll()`. This function returns an array with each row from the query result as an [Element](docs/##VERSION##/forms-and-data/element). You can also use `$db->fetchRow()` to get only the first resulting row from the query.

_Example_
```php
$result = $db->select()->fetchAll();
```

<hr>
Documentation under development...
<hr>