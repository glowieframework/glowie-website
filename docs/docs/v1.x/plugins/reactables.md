# Reactables

_This documentation is currently a work in progress!_

## Table of contents
[toc]

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

## Quick example
Here is a quick example to understand better what Reactables does:

Let's assume you have a `Posts` model which represents a list of blog posts from your database table. You want to show this post list in a page, but also want to create a "search" bar where the user can filter for the post title.

You'd probably have to create a form and submit it to your controller through a route, then apply the filter in an application controller using the request query string, then reloading the page with the fetched results. That sucks.

With Reactables you can make this filter without creating forms or even reloading the page. Check out:

_Component controller `(app/controllers/Components/SearchPosts.php)`_
```php
<?php
    namespace Glowie\Controllers\Components;

    use Glowie\Plugins\Reactables\Controllers\BaseComponent;

    class SearchPosts extends BaseComponent{

        public function create(){
            $this->component->search = '';
        }

        public function make(){
            $postsModel = new \Glowie\Models\Posts();
            $postsModel->where('title', 'like', '%' . $this->component->search . '%');

            $this->render('search-posts', [
                'posts' => $postsModel->fetchAll()
            ]);
        }

    }

?>
```

_Component view `(app/views/components/search-posts.phtml)`_
```html
<div>
    <input type="text" r-model="search" placeholder="Type your search...">

    { foreach($this->posts as $post) }
        <h3>{{ $post->title }}</h3>
    { /foreach }
</div>
```

Now, after adding the component to one of your application views, when the user types in the input element, the post list is updated in real-time with the new filter applied. This is a reactive component!

## Creating components
To start creating your first Reactables component, open the terminal and run:

```
php firefly create-component --name=MyComponent
```

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

Now, wherever you want to render your component, just use the directive:

```php
{ component('mycomponent') }
```

If you want to share your view parameters with the component, pass an associative array as the second parameter of this directive.

```php
{ component('mycomponent', ['name' => $this->name]) }
```

## Understanding the lifecycle
When a component is rendered inside one of your application views, it's content will be initially compiled (as any regular Glowie view file), but a Javascript watcher will be bound to each interactable DOM elements inside the component. Whenever an input value changes or an action is triggered (like clicking a button), an AJAX request is sent to your component controller with the new data, the component view is recompiled and returned through the AJAX response. Then, the current view is intelligently morphed with the new data in the page.

## The component controller
The component controller file is designed to handle how your component works in its lifecycle. It will be responsible for handling interactions and properties of the component, besides rendering the component view itself.

Component controllers must be stored inside `app/controllers/Components` folder, and extend `Glowie\Plugins\Reactables\Controllers\BaseComponent` class.

### The `make()` method
The heart of the component controller is the `make()` method. This is where you will set what your component does whenever its created or updated. This is also where you will render your component view.

```php
public function make(){
    // ...
    $this->render('mycomponent');
}
```

You can also pass parameters to the component view by passing an associative array as the second parameter of the `render()` method.

```php
public function make(){
    // ...
    $this->render('mycomponent', [
        'name' => 'John'
    ]);
}
```

### The `create()` method
The `create()` method is called when your component is initially rendered in the page. It will not be called on subsequent request, this means, when the component is refreshed or its data changes. This is useful to initialize properties of the component.

```php
public function create(){
    // ...
    $this->component->name = '';
}
```

### The `update()` method
The `update()` method, unlike `create()`, is called whenever your component is updated. This is useful to manipulate data or sanitize something before the final render.

```php
public function update(){
    // ...
    $this->component->name = strolower(trim($this->component->name));
}
```

### Manipulating the component data
From the component controller, you can manipulate its data through the `$this->component` object. It is a Glowie <a href="https://glowie.gabrielsilva.dev.br/docs/latest/forms-and-data/element" target="_blank">Element</a> instance with your component data.

```php
// Setting a property
$this->component->name = 'John'; # or
$this->component->set('name', 'John');

// Retrieving a property
$name = $this->component->name; # or
$name = $this->component->get('name');

// Checking if a property exists
$hasName = $this->component->has('name'); # or
$hasName = isset($this->component->name);

// Removing a property
$this->component->remove('name'); # or
unset($this->component->name);
```

## The component view
The component view works as any regular Glowie view, and you can also use any Skeltch directives here. Component views must be a **.phtml** file stored inside `app/views/components`.

The only requirements is that the component view MUST have a **single root element**. It can be any HTML element, but everything must be wrapped inside of it. This is required by our DOM parser.

```html
<div>
    <!-- My component view goes inside a single root element -->
</div>
```

## Basic two-way data binding
Any input element inside your component can be two-way data binded to a model, which represents a property of the component. This way, whenever the input value changes, the property in the controller will be also changed, and the component view will react to it acordingly. On the other hand, when the property value in the controller changes, the input value also changes.

To bind an input to a model, use the `r-model` attribute, passing the property name you want to bind.

```html
<input type="text" r-model="name">

Hello, {{ $this->name }}!
```

From the component controller, you can retrieve the property through `$this->component` object (as seen above).

```php
$name = $this->component->name;
```

### Debouncing input updates
If you want a model to update only after the user stops typing, instead of real-time, you can add a `r-debounce` attribute to the element. The value of this attribute is the time, in **miliseconds** to wait before the component update is triggered.

This prevents the application of sending too many requests and end up loading your server.

```html
<input type="text" r-model="name" r-debounce="500">
```

### Deferring input updates
If you don't want a model to instantly update the component, but rather wait until another element is updated or an action (see below) is triggered, you can add a `r-lazy` attribute to the element.

```html
<input type="text" r-model="name" r-lazy>
```

### Checkboxes
Checkboxes can have a custom value (rather than true/false) to set to their models when checked. To do that, use a `value` attribute.

```html
<input type="checkbox" r-model="accept" value="Yes">
```

If you want to accept multiple options in the same checkbox, bind the element to an **array** model.

```html
<input type="checkbox" r-model="services[]" value="Service 1">
<input type="checkbox" r-model="services[]" value="Service 2">
<input type="checkbox" r-model="services[]" value="Service 3">
```

In the controller, the component property will be an array filled with the selected checkboxes custom values.

```php
$services = $this->component->services; // ['Service 1', 'Service 2']
```

### Radio buttons
Groups of radio buttons should be bound to the same model, with a `value` attribute for each one of them.

```html
<input type="radio" r-model="rating" value="1">
<input type="radio" r-model="rating" value="2">
<input type="radio" r-model="rating" value="3">
```

### Selects
Select options can also have a custom `value` attribute. If no value is specified, the option text will be used as the value.

```html
<select r-model="age">
    <option value="18">18 years old</option>
    <option value="30">30 years old</option>
    <option value="60">60 years old</option>
</select>
```

### Multiple selects
Selects with a `multiple` attribute should be bind to an **array** model. The `value` attribute to each option is optional.

```html
<select r-model="vehicles[]" multiple>
    <option value="B">Bike</option>
    <option value="C">Car</option>
    <option value="A">Airplane</option>
</select>
```

In the controller, the component property will be an array filled with the selected options values.

```php
$vehicles = $this->component->vehicles; // ['B', 'C']
```