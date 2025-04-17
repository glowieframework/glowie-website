# Basic MVC concepts

[toc]

### What is MVC?
**Model-View-Controller** (MVC) is an architectural pattern that separates an application into three main logical components: the model, the view, and the controller. Each of these components are built to handle specific development aspects of an application. MVC is one of the most frequently used industry-standard development pattern, and Glowie was built on top of it.

- **The model** corresponds to all the data-related logic that the user works with (see [Models](docs/%%version%%/forms-and-data/models)).

- **The view** is used for all the UI logic of the application. Basically, the display of your application data (see [Views](docs/%%version%%/basic-application-modules/views)).

- **The controller** acts as a "glue" between your application model and views, besides handling user requests and processing business logic (see [Controllers](docs/%%version%%/basic-application-modules/controllers)).

### The application flow
The following diagram illustrates the basics of a Glowie application flow.
<img src="assets/images/flow.png">
At its core, after the user types in an URL from your server, the **Request** is sent to Glowie **Router**. If a matching route is found and correctly validated, the request is sent to the next step. If there are no matching routes, a **404 Response** with a Not Found error is thrown.

Now, if the matching route is protected by any **Middlewares**, the request will be handled by each one of them. If the middlewares validation is successful, the request is sent to the **Controller**. Otherwise, a **403 Response** with a Forbidden error is thrown. If the route is not protected, this step is skipped.

In the **Controller**, the application business logic will be applied and a **Response** will be sent back to the user. In this step, your application can also interact with the **Model** or **View** layer.