# CSRF Protection

[toc]

### Introduction
**Cross-Site Request Forgery** (CSRF) is a type of malicious attack when an untrusted source can make a request to your application and take actions when the user is authenticated, exploiting the current active session in your application.

_Example:_ Your application has a route that changes a user's password. This route is protected through an authentication middleware, that validates if the user is logged in by comparing the [Session](docs/%%version%%/forms-and-data/session) data related to that user. If your user has already logged in into your application, a malicious website can make a request to this route from another source and change its password by exploiting this vulnerability. Since the session has already been started, the malicious script will bypass the authentication middleware and gain access to your application.

Glowie has a built-in way to protect your application from untrusted sources and grant that all incoming requests are really comming from your own application.

### Protecting forms
Whenever a user makes the first request to your application, Glowie will generate a unique token for the current session. So, anytime you define a `POST` form in your application, you must include this token as a hidden field named `_token` and the corresponding token as its value. To retrieve the current token, use the static `Util::csrfToken()` method.

_Example_
**view**
```html
<form action="user/save" method="post">
    <input type="hidden" name="_token" value="<?php echo Util::csrfToken(); ?>">

    <!--- your form fields ... -->
    <input type="password" name="password">
</form>
```

Now, in the route that processes this form, add the `ValidateCsrfToken` [Middleware](docs/%%version%%/basic-application-modules/middlewares). This middleware comes by default with every Glowie installation in the `app/middlewares` folder.

_Example_
**Routes.php**
```php
use Glowie\Controllers\User;
use Glowie\Middlewares\ValidateCsrfToken;
Rails::addProtectedRoute('user/save', ValidateCsrfToken::class, User::class, 'save');
```

Whenever a request to this route is received, the middleware will compare the previously generated token with the received token from the form. If both token matches, the request is sent to your application. If not, it will respond with a 403 Forbidden error and the request is blocked.

If your route needs to have other middlewares, be sure to use the `ValidateCsrfToken` middleware first.

_Example_
```php
use Glowie\Controllers\User;
use Glowie\Middlewares\Authenticate;
use Glowie\Middlewares\ValidateCsrfToken;

Rails::addProtectedRoute('user/save', [ValidateCsrfToken::class, Authenticate::class], User::class, 'save');
```

### Protecting other requests
If you need to protect other kind of requests besides `POST` forms, you can also pass the CSRF token as a header named `X-CSRF-TOKEN`.

When working with AJAX, you can store the token in a `<meta>` tag:

```html
<meta name="csrf_token" content="<?php echo Util::csrfToken(); ?>">
```

Then retrieve it through Javascript with:

```js
var token = document.querySelector('meta[name="csrf_token"]').getAttribute('content');
```

If you are using jQuery, you can setup the header automatically to all requests using:

```js
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
});
```