# Models
A model is a way to interact with your database tables in an object-oriented way. Each model corresponds to a table from your database. Within the model you can find some methods to retrieve, update and delete data from the table very easily, surpassing the needs of relying on [Kraken](docs/%%version%%/forms-and-data/mastering-kraken) query builder all the time.

### Creating models
Creating a model for your application is extremely easy. A model is a simple PHP file with a model class in `Glowie\Models` namespace stored in `app/models` folder.

From [Firefly](docs/%%version%%/extra/firefly) CLI you can use the following command to create a new model:

```plaintext
php firefly create-model --name=MyModel
```

The model file must have the **exact same name** as the model class.

This is the default snippet for a model file:

```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

       // Model methods and properties here

    }

?>
```

**Note:** model names SHOULD NOT include:
- accents
- dashes
- characters that are not letters, numbers or underscores

And for convention, every word in a model name must be capitalized.

_Example:_ for creating a `Hello world` model, the name must be `HelloWorld`.

### Model properties
Each model can have its own properties that defines how your model will handle data.

**Model table**
The table property specifies which database table corresponds to your model. By default, a snake-case version of your model class name will be used.

_Example:_ `HelloWorld` model table by default will be `hello_world`.

If you want to manually set the model table, use the protected `$_table` property.

_Example_
```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

        /**
         * Model table name.
         * @var string
         */
        protected $_table = 'table_name';

    }

?>
```

**Model primary key**
By default, Glowie assumes that your model table has a primary key named `id`. If you want to set a different column name for the primary key, use the protected `$_primary` property.

_Example_
```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

        /**
         * Table primary key name.
         * @var string
         */
        protected $_primary = 'email';

    }

?>
```

**Model fields**
The fields property specifies which columns from your table can be retrieved, inserted or updated through the model. By default, all fields from the table will be accepted. If you want to manually set this fields, use the protected `$_fields` property as an array of field names.

_Example_
```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

        /**
         * Table manageable fields.
         * @var array
         */
        protected $_fields = ['name', 'email', 'password'];

    }

?>
```

**Model timestamps**
If your model table has timestamp fields, Glowie will autofill this fields with your row creation and update data whenever the model is updated. This setting comes disabled by default, but if you want to enable it, pass a `true` value to the protected `$_timestamps` property.

_Example_
```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

        /**
         * Handle timestamp fields.
         * @var bool
         */
        protected $_timestamps = true;

    }

?>
```

By default, the columns named `created_at` and `updated_at` will be used. If you want to change this column names, use both protected `$_createdField` and `$_updatedField` properties.

**Important!** Fields must be of type `DATETIME`.

_Example_
```php
<?php
    namespace Glowie\Models;

    use Glowie\Core\Database\Model;

    class MyModel extends Model{

        /**
         * Handle timestamp fields.
         * @var bool
         */
        protected $_timestamps = true;

        /**
         * **Created at** field name (if timestamps enabled).
         * @var string
         */
        protected $_createdField = 'date_created';

        /**
         * **Updated at** field name (if timestamps enabled).
         * @var string
         */
        protected $_updatedField = 'date_updated';

    }

?>
```

### Retrieving model data
In order to retrieve a single row from the model table, use the `$model->find()` method passing the value for the model primary key you want to find. This method will return the first row that matches the primary key value as an [Element](docs/%%version%%/forms-and-data/element) or `null` if no matching row is found.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$user = $model->find(1); // Returns first row with primary key = "1"
```

If you want to find a row by other column value instead of the primary key, use the `$model->findBy()` method. The first parameter is the field name, and the second the value to match.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$user = $model->findBy('email', 'test@glowie.tk'); // Returns first row with email field = "test@glowie.tk"
```

In both methods, if you pass a `true` option as the last parameter the result will be returned as an associative array instead of an Element.

**Retrieving all rows**
If you want to retrieve all rows from the model table at once, use the `$model->all()` method. This will return an array with each row as an [Element](docs/%%version%%/forms-and-data/element).

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$users = $model->all(); // Returns all rows
```

If your model is handling timestamp fields (see above), you can retrieve all rows ordering by the latest created ones with `$model->latest()` or the oldest with `$model->oldest()`. These methods use the **created at** field value to order rows.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$users = $model->latest(); // Returns all rows ordering by the created at field, descending
$users = $model->oldest(); // Returns all rows ordering by the created at field, ascending
```

If you pass a `true` option as the first parameter of any of these methods, each row will be returned as an associative array instead of an Element.

### Creating model data
In order to insert a new row in the model table, use the `$model->create()` method. This method receives an associative array with the key being the column name and the value the field value to insert.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$users->create([
    'name' => 'Glowie'
    'email' => 'test@glowie.tk'
]);
```

If the model creation is done successfully, this method returns `true`.

**Update or create**
There is also the `$model->updateOrCreate()` method, which checks if a row matches the primary key value in the data. If so, the row is updated with the data provided, otherwise a new row is created. This method also receives an associative array with the key being the column name and the value the field value to insert.

**Note:** When using this method, ensure that the primary key field is included in the data array. Otherwise, the model cannot check if the row already exists, so the row will only be created.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$users->updateOrCreate([
    'id' => 1,
    'name' => 'Glowie'
    'email' => 'test@glowie.tk'
]);
```

### Deleting model data
Use the `$model->drop()` method to delete a row from the model table. The first parameter is the primary key value of the row you want to drop. The first row that matches the primary key value will be deleted from the table.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$users->drop(1); // Deletes first row with primary key = "1"
```

### Using the model entity data
Besides using the model to interact with your database table, you can use the model instance as an entity that persists data to the database.

This means you can use the model as an object representing a row, and use its properties as values from this row.

**Filling the model entity**
After retrieving a row from the table, you can use the `$model->fill()` method to fill the model object itself with the values fetched from the database. This method receives an [Element](docs/%%version%%/forms-and-data/element) or an associative array relating the row fields and values.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$userRow = $model->find(1); // Returns first row with primary key = "1"
$user->fill($userRow); // Fills the model entity with the row data
```

**Interacting with the model entity**
After filling the model entity, you are now able to interact with the row data as properties from the model object.

_Example_
```php
$name = $user->name; // Returns the row "name" field value
$email = $user->email; // Returns the row "email" field value
```

You can also use the methods `get()`, `set()`, `has()` or any other methods as described in [Element](docs/%%version%%/forms-and-data/element), directly from the model instance.

If you make any changes to the model entity properties and want to save them into the table, use the `$model->save()` method. This method will use the `updateOrCreate()` logic (see above), but the data will be retrieved from the model entity.

_Example_
```php
$user->name = 'Gabriel'; // Stores "Gabriel" into field "name" in the model entity
$user->save(); // Updates the row in the table with the new name
```

You can also save entities that were not previously filled from the database. In this case, the row will be created with the new entity data.

_Example_
```php
use Glowie\Models\Users;
$model = new Users();
$model->name = 'Test'; // Stores "Test" into field "name" in the model entity
$model->email = 'test@lorem.com'; // Stores "test@lorem.com" into field "email" in the model entity
$model->save(); // Creates the new row with the entity data
```

-----
_Documentation session under development..._ [Contribute!](https://github.com/glowieframework/glowie-website/tree/main/documentation)