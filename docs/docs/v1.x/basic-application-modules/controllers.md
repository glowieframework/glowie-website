# Controllers

[toc]

### Introduction
A controller is the heart of your application. It is responsible for handling user requests and controlling the flow of your app, making the interconnection between all its modules. This means loading graphic interfaces, doing database requests, running business logics and every other awesome functionalities.

### Creating controllers
Creating a controller for your application is extremely easy. A controller is a simple PHP file with a controller class in `Glowie\Controllers` namespace stored in `app/controllers` folder.

From [Firefly](docs/%%version%%/extra/cli) CLI you can use the following command to create a new controller:

```plaintext
php firefly create-controller --name=MyController
```

The controller file must have the **exact same name** as the controller class.

This is the default snippet for a controller file:

```php
<?php
    namespace Glowie\Controllers;

    class MyController extends BaseController{

       // Controller actions here

    }

?>
```

Next step is create some actions for your controller, see [Actions](docs/%%version%%/basic-application-modules/actions) for more info.

### The BaseController
`BaseController` is a default controller class located in the controllers folder (`app/controllers/BaseController.php`) who is extended by every other controller of your application.

This means you can create any methods and properties in this controller and they can be reused from any other controller. This is useful when creating global functions or properties that need to be accessed from your whole application, removing the need of rewriting code.

`BaseController` also extends `Glowie\Core\Http\Controller` class, which is the core class for Glowie controllers.

_Example_
```php
<?php
    namespace Glowie\Controllers;

    use Glowie\Core\Http\Controller;

    class BaseController extends Controller{

       // Methods in this controller can be reused in any other controllers

    }

?>
```