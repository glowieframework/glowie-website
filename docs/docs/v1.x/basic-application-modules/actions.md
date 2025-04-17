# Actions

[toc]

### Introduction
Actions are methods from a controller that organizes the way every request is handled. An action is basically a method from a controller that does a specific job for a specific task.

_Example_: You have `ProductsController`, a controller that is responsible for organizing a product catalog from an ecommerce website. Within this controller you need to have specific actions for each functionality needed, like `listProducts()`, `addProduct()`, `editProduct()` and `deleteProduct()`.

### Creating actions
In order to create an action inside a controller, you must create a new **public function** in the desired controller class.

_Example_
```php
<?php
    namespace Glowie\Controllers;

    class MyController extends BaseController{

       public function index(){
           // index action methods goes here
       }

       public function other(){
           // other action methods goes here
       }

    }

?>
```

### The `init()` method
Every controller can have an optional `init()` method. If this method exists, it will be called before any other actions from the same controller are instantiated.

This way you create common functions that will be propagated to the whole controller before anything happens, instead of using the controller constructor for that.

**Note:** You should not use the `__construct()` method in a controller. Always use `init()` instead. The constructor method is restricted to the core controller setup.

_Example_
```php
<?php
    namespace Glowie\Controllers;

    class MyController extends BaseController{

       public function init(){
           // init methods goes here
       }

       public function index(){
           // init() will be called before this method is triggered
       }

    }

?>
```

**Important!** If you have a `init()` method in the `BaseController`, don't forget to call `parent::init()` inside all other controllers `init()` functions. This ensures that the function from `BaseController` will also be called.