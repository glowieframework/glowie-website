# Basic MVC concepts

### The application flow
The following diagram illustrates the basics of a Glowie application flow.
<img src="assets/images/flow.png">
At its core, after the user types in an URL from your server, the **Request** is sent to Glowie **Router**. If a matching route is found and correctly validated, the request is sent to the next step. If there are no matching routes, a **404 Response** with a Not Found error is thrown.

Now, if the matching route is protected by a **Middleware**, the request will be handled by it. If the middleware validation is successful, the request is sent to the **Controller**. Otherwise, a **403 Response** with a Forbidden error is thrown. If the route is not protected, this step is skipped.

In the **Controller**, the application business logic will be applied and a **Response** will be sent back to the user. In this step, your application can also interact with a **Model** or **View**.