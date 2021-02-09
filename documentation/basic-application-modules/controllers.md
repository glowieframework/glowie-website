# Controllers
A controller is the heart of your application. It is responsible for handling user requests and control the flow of your app, making the interconnection between all its modules. This means loading graphic interfaces, doing database requests, doing logics and every other awesome functionalities.

### Creating controllers
Creating a controller for your application is extremely easy. A controller is a simple PHP file with a controller class stored in `app/controllers` folder.

This is the default snippet for a controller file:

```php
<?php

    class NameController extends BaseController{

       // Controller actions here

    }

?>
```

You must set the name of your controller followed by "**Controller**" at the end. In the snippet above, simply replace "Name" for your controller name.

**Note:** controller names SHOULD NOT include:
- accents
- dashes
- characters that are not letters, numbers or underscores

And for convention, every word in a controller name must be capitalized.

_Example:_ for creating a `Hello world` controller, the name must be `HelloWorldController`.

Next step is create some actions for your controller, see [Actions](docs/basic-application-modules/actions) for more info.

### BaseController
`BaseController` is a default controller class located in the controllers folder (`app/controllers/Base.php`) who is extended by every other controller of your application.

This means you can create any methods and properties in this controller and they can be reused from any other controller or view. This is useful when creating global functions or properties that need to be accessed from your whole application, removing the need of rewriting code.