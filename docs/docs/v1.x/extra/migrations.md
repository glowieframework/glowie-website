# Migrations

[toc]

### Introduction
A migration is a way to version control your application database. When working with migrations you can ensure that every developer that will work with your app has the same database structure, avoiding errors and tracking database changes.

### Creating migrations
A migration is a simple PHP file with a migration class in `Glowie\Migrations` namespace stored in `app/migrations` folder.

From [Firefly](docs/%%version%%/extra/cli) CLI you can use the following command to create a new migration:

```plaintext
php firefly create-migration --name=MyMigration
```

**Migration name conventions**
Migrations run in numeric order, so it's important that your migration classes have the following class name structure: **mYYYY_MM_DD_HHIISS_MigrationName**, with the timestamp that the migration was created prepended to the migration name. This ensures that migrations will run in correct order from the oldest one to the latest one.

_Example:_ `m2021_07_05_210000_MyMigration`

When creating migrations from [Firefly](docs/%%version%%/extra/cli) CLI, the timestamp is prepended automatically, so you don't need to write it.

The migration file must also have the **exact same name** as the migration class.

This is the default snippet for a migration file:

```php
<?php
    namespace Glowie\Migrations;

    use Glowie\Core\Database\Migration;

    class m2021_07_05_210000_MyMigration extends Migration{

       /**
        * Runs the migration.
        * @return bool Returns true on success or false on errors.
        */
       public function run(){
           // This method is required
       }

       /**
        * Rolls back the migration.
        * @return bool Returns true on success or false on errors.
        */
       public function rollback(){
           // This method is required
       }

    }

?>
```

### Migration script
Every migration class **must have** a public `run()` method. This is the method where your migration logics run when the migration is applied.

Returning `true` or `false` from this method is optional, but we recommend to use it to tell if the migration was run successfully or not.

**Rollback**
Opposite to that, the migration class **must also have** a public `rollback()` method. This is the method that undoes what the `run()` method does, this means, it rolls back the modifications that your migration did.

Returning `true` or `false` from this method is also optional, but we recommend to use it to tell if the migration was rolled back successfully or not.

**Database instance**
From your migration, you can use the property `$this->db` to directly access an instance of [Kraken](docs/%%version%%/forms-and-data/query-builder) query builder and interact with your application database.

_Example_
```php
<?php
    namespace Glowie\Migrations;

    use Glowie\Core\Database\Migration;

    class m2021_07_05_210000_MyMigration extends Migration{

       /**
        * Runs the migration.
        * @return bool Returns true on success or false on errors.
        */
       public function run(){
           // Create a database table named "users" if it does not exists yet
           return $this->db->query(
               'CREATE TABLE IF NOT EXISTS users(
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL
               )');
       }

       /**
        * Rolls back the migration.
        * @return bool Returns true on success or false on errors.
        */
       public function rollback(){
           // Delete the database table named "users" if exists
           return $this->db->query('DROP TABLE IF EXISTS users');
       }

    }

?>
```

### Running migrations
In order to run pending migrations from your application, from [Firefly](docs/%%version%%/extra/cli) CLI use the following command:

```plaintext
php firefly migrate
```

This will apply all migrations that were not applied yet, following the order from the oldest one to the latest one.

If you want to specify how many migrations you want to apply, you can use the optional `--steps` argument.

_Example_
```plaintext
php firefly migrate --steps=1
```

**The migrations table**
To track which migrations were applied in your current database version, Glowie will create a table named `migrations` in your database. This table stores the name and date of every migration run. We do not recommend editing this table since it may cause errors while working with migrations.

### Rolling back migrations
If you want to rollback what a migration did, from [Firefly](docs/%%version%%/extra/cli) CLI use the following command:

```plaintext
php firefly rollback
```

This will rollback the latest migration applied to its previous state.

If you want to rollback another number of migrations, you can use the optional `--steps` argument.

```plaintext
php firefly rollback --steps=2
```

To rollback all migrations, use `all` in the `--steps` argument.

```plaintext
php firefly rollback --steps=all
```