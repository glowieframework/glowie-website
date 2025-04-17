# Skeleton

[toc]

### Introduction
Skeleton is a database schema builder, designed to manipulate your database structure and tables.

### Creating tables
In order to create a new table, you must first set the table name you want to create with the `$db->table()` method.

_Example_
```php
$db->table('new_table');
```

Now, you must create columns for your table. The first method we are going to use is the `$db->createColumn()`. The parameters for this method are:

**name**
The name of the column you want to create.

**type**
The SQL data type for the column you are creating. Must be a valid type supported by your current MySQL version.

**size**
An optional maximum data length for the column you are creating.

**default**
An optional default value for this column in new rows.

_Example_
```php
$db->table('new_table')
    ->createColumn('username', 'VARCHAR', 255)
    ->createColumn('password', 'VARCHAR', 255);
```

The second method to use while creating columns is the `$db->createNullableColumn()`. Unlike the previous one, this method creates a column that accepts `NULL` values. Parameters are the same.

_Example_
```php
$db->table('new_table')
    ->createColumn('username', 'VARCHAR', 255)
    ->createColumn('password', 'VARCHAR', 255)
    ->createNullableColumn('email', 'VARCHAR', 255);
```
-----
_Documentation session under development..._ [Contribute!](https://github.com/glowieframework/glowie-website/tree/main/documentation)