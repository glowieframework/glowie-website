# Actions
Actions are methods from a controller that organizes the way every request is handled. An action is basically a function from a controller that does a specific job for a specific task.

_Example_: You have `ProductsController`, a controller that is responsible for organizing a product catalog from an ecommerce website. Within this controller you need to have specific actions for each functionality needed, like `listProductsAction()`, `addProductAction()`, `editProductAction()` and `deleteProductAction()`.

### Creating actions
In order to create an action inside a controller, you must create a new **public function** in the desired controller file stored into `app/controllers`. Function name must end with "Action".

_Example_
```php
<?php

    class NameController extends BaseController{

       public function indexAction(){
           // index action methods goes here
       }

       public function otherAction(){
           // other action methods goes here
       }

    }

?>
```

**Note:** action names SHOULD NOT include:
- accents
- dashes
- characters that are not letters, numbers or underscores

And for convention, every word in an action name must be capitalized, except for the first word.

### init()
Every controller (except `BaseController`) can have an optional `init()` method. If this method exists, it will be called before any other actions from the same controller are instantiated. 

This way you create common functions that will be propagated to the whole controller before anything happens.

_Example_
```php
<?php

    class NameController extends BaseController{

       public function init(){
           // init methods goes here
       }

       public function indexAction(){
           // init() will be called before this method is triggered
       }

    }

?>
```