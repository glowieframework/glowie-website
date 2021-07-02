# Controllers
A controller is the heart of your application. It is responsible for handling user requests and controlling the flow of your app, making the interconnection between all its modules. This means loading graphic interfaces, doing database requests, running business logics and every other awesome functionalities.

### Creating controllers
Creating a controller for your application is extremely easy. A controller is a simple PHP file with a controller class in `Glowie\Controllers` namespace stored in `app/controllers` folder.

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

**Note:** controller names SHOULD NOT include:
- accents
- dashes
- characters that are not letters, numbers or underscores

And for convention, every word in a controller name must be capitalized.

_Example:_ for creating a `Hello world` controller, the name must be `HelloWorld`.

Next step is create some actions for your controller, see [Actions](docs/##VERSION##/basic-application-modules/actions) for more info.

### BaseController
`BaseController` is a default controller class located in the controllers folder (`app/controllers/BaseController.php`) who is extended by every other controller of your application.

This means you can create any methods and properties in this controller and they can be reused from any other controller. This is useful when creating global functions or properties that need to be accessed from your whole application, removing the need of rewriting code.