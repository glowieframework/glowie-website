# Autoloading

[toc]

### Introduction
When you have a PHP application with a large number of classes, dependencies and files, can be very painful to create several `require()` or `include()` methods in order to load all classes upon every request. This practice can lead to several errors, besides making your application have a poor performance, since every single file will be loaded even if the current request is not using it. That's where autoloaders come in.

An autoloader will load automatically in runtime only those files that are being currently used. It will also increase your application performance by having predefined paths in where to look for files, and have a nice way to organize your application dependencies.

Glowie uses the [Composer autoloader](https://getcomposer.org/doc/01-basic-usage.md#autoloading) following the [PSR-4 standards](https://www.php-fig.org/psr/psr-4). If you need to set up a custom file for autoloading, use the `composer.json` file in the root directory.

### Namespace reference
Glowie has several predefined namespaces that will be processed by the autoloader. Namespaces are, by default, routed to the following folders:

- `Glowie\Commands` namespace is stored into `app/commands` folder.

- `Glowie\Controllers` namespace is stored into `app/controllers` folder.

- `Glowie\Middlewares` namespace is stored into `app/middlewares` folder.

- `Glowie\Migrations` namespace is stored into `app/migrations` folder.

- `Glowie\Models` namespace is stored into `app/models` folder.

- `Glowie\Helpers` namespace is stored into `app/views/helpers` folder.

When autoloading classes, remember that class names and their namespaces must match the exact directory and filenames.