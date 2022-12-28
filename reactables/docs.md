## Introduction
Reactables is a plugin for Glowie Framework intended to create and work with dynamic and reactive view components.

Alongside with Skeltch, Reactables allows you to create amazing single-page applications and interactions, but with all the logic being handled with PHP. Think about it like some sort of Vue.js in the backend. Amazing, right?

## Installation
In your Glowie application folder, open a terminal and run:

```
composer require glowieframework/glowie-reactables
```

Now, in your `app/config/Config.php`, search for the `plugins` setting, and add the following line to the array:

```php
'plugins' => [
    // ...
    \Glowie\Plugins\Reactables\Reactables::class
]
```

## Creating components
To start creating your first Reactables component, open the terminal and run:

```
php firefly create-component --name=MyComponent
```

Replace `MyComponent` with your component name, of course.

This will create two files: the component **controller** inside `app/controllers/Components` and the component **view** inside `app/views/components`.

## Rendering components
To render a component in your application view, you must first include the Javascript assets that Reactables uses. To do that, in the end of your app view, before the closing `</body>` tag, include the Skeltch directive:

```html
<body>
    <!-- ... -->
    { reactablesAssets }
</body>
```

Even if your view has more than one component, you only need to include this directive **once per page**.

Now, wherever you want to render your component, just use:

```php
{ component('mycomponent') }
```

## The component controller
The component controller file is designed to handle how your component works in its lifecycle. It will be responsible for handling interactions and properties of the component, besides rendering the component view itself.

## Basic two-way data binding
Any input elements inside your component can be two-way data binded to a model, which represents a property of the component. This way, whenever the input value changes, the property in the controller will be also changed, and the component view will react to it acordingly. On the other hand, when the property value in the controller changes, the input value also changes.

To bind an input to a model, use the `r-model` attribute, passing the property name you want to bind.

_Example_
```html
<input type="text" r-model="name">

Hello, {{ $this->name }}!
```

In the example above, try typing something in the input. The message will update in real time!