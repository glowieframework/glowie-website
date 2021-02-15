# Data validation
Forms and data validation can be achieved easily using Glowie `Validator` module.

From your controller, create a new instance of `Validator` using:

```php
$validator = new Glowie\Validator();
```

### Validation rules
To validate data you must specify which validation rules will be applied to that element or array of elements. The current available rules are:

**required**
Validates if an element is not null. In case of arrays, this will check if it's not an empty array. In strings, it will check if the string is not empty.

**min**`:value`
Validates if an element is equal or bigger than a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of elements.

**max**`:value`
Validates if an element is equal or less than a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of elements.

**size**`:value`
Validates if an element size equals a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of elements.

**email**
Validates if a string corresponds to a valid email address.

**url**
Validates if a string corresponds to a valid URL address.

**alpha**
Validates if a string only has alphabetic characters. Valid ranges are `[a-zA-Z]`.

**numeric**
Validates if an element is a number or a numeric string. Valid ranges are `[0-9]`.

**alphanumeric**
Validates if a string only has alphanumeric characters. Valid ranges are `[a-zA-Z0-9]`.

**alphadash**
Validates if a string only has alphanumeric, dashes or underscore characters. Valid ranges are `[a-zA-Z0-9-_]`.

**regex**`:pattern`
Validates if a string matches a regex pattern.

**array**
Validates if an element is an array.

**date**
Validates if a string is a valid date format.

**string**
Validates if an element is a string.

**integer**
Validates if an element is integer.

**object**
Validates if an element is an object.

**boolean**
Validates if an element is a boolean.

**value**`:value`
Validates if an element has the exact specified value.

**not**`:value`
Validates if an element does not have the exact specified value.

**empty**
Validates if an element is null. In case of arrays, this will check if it's an empty array. In strings, it will check if the string is empty.

**endswith**`:value`
Validates if a string ends with a specified string.

**startswith**`:value`
Validates if a string starts with a specified string.

### Valiation rules parameters
While using rules that accepts parameters (like `min`, `max`, `value`, `startswith`, etc.) you should set the validation rule along with `:` followed by the value you want.

_Example_
```php
$rules = ['min:8', 'max:16'] # validate element with minimum of 8 and maximum of 16
```

### Validating a single element
In order to validate a single element, use `$validator->validate()`. You must specify the element as the first parameter, and an array of rules as the second parameter.

Optionally you can also set a `bail` option as the third parameter. If this option is set to `true`, the validation will stop after the first failure found. If `false`, all validation rules will be tested and all failures will be returned.

`validate()` will return true if the element is validated properly or false if not.

_Example_
```php
$data = 'myemail@hotmail.com';
$rules = ['required', 'string', 'email'];
$isValid = $validator->validate($data, $rules); # returns true
```

### Validating multiple elements
In order to validate multiple elements with the same rules for all of them, use `$validator->validateMultiple()`. You must specify an array of elements as the first parameter and an array of rules as the second parameter.

Optionally you can also set a `bail` option as the third parameter. This works exactly as described in `validate()`, but applies to a single element validation.

Besides that, you can also optionally set a `bailAll` option as the fouth parameter. If this option is set to `true`, the validation of all elements will stop after the first failure found in an element. If `false`, the validation of other elements will continue normally after any failures found.

`validateMultiple()` will return true if all elements were validated properly or false if any failures.

_Example_
```php
$data = ['myemail@hotmail.com', 'test'];
$rules = ['required', 'string', 'email'];
$isValid = $validator->validateMultiple($data, $rules); # returns false
```

### Validating form fields
In order to validate multiple elements with specific rules for each element, use `$validator->validateFields()`. You must specify an associative array with all fields keys and values as the first parameter and an associative array of arrays with rules for each field as the second parameter.

You can optionally set a `bail` and `bailAll` option as the third and fourth parameters. Those options works the same as described in `validateMultiple()`.

`validateFields()` will return true if all fields were validated properly or false if any failures.

_Example_
```php
$data = [
    'name' => 'Glowie',
    'address' => ''
];
$rules = [
    'name' => ['required', 'string'],
    'address' => ['required']
];
$isValid = $validator->validateFields($data, $rules); # returns false
```

### Retrieving validation errors
After running a validation, all validation failures can be retrieved through `$validator->getErrors()`. This method will return an associative array of fields or elements (with each field/element being a key) and an array of invalid fields.

You can use this method to handle specific errors or show messages to the user based in a specific invalid field or element.

_Example_
```php
$data = [
    'name' => 'Glowie',
    'email' => ''
];
$rules = [
    'name' => ['required'],
    'email' => ['required', 'email']
];
$isValid = $validator->validateFields($data, $rules); # returns false
$errors = $validator->getErrors();

/*
    returns:
    [
        'email' => [
            'required' => 'INVALID',
            'email' => 'INVALID'
        ]
    ]
*/
```