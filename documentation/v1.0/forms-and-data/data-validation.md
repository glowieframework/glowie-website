# Data validation
Forms and data validation can be achieved easily using Glowie `Validator` class.

From your controller, create a new instance of `Glowie\Core\Validator` using:

```php
use Glowie\Core\Validator;

$validator = new Validator();
```

### Validation rules
To validate data you must specify which validation rules will be applied to that item or array of items. The current available rules are:

**required**
Validates if an item is not null. If the item is an array, this will check if it's not empty. In case of strings, it will check if the trimmed string is not empty.

**min**`:value`
Validates if an item is equal or bigger than a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of items.

**max**`:value`
Validates if an item is equal or less than a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of items.

**size**`:value`
Validates if an item size equals a specified value. In case of numeric values it will check it's value. In strings it will check the string length. In arrays, it will check the amount of items.

**email**
Validates if a string corresponds to a valid email address.

**url**
Validates if a string corresponds to a valid URL address.

**alpha**
Validates if a string only has alphabetic characters. Valid ranges are `[a-zA-Z]`.

**numeric**
Validates if an item is a number or a numeric string. Valid ranges are `[0-9]`.

**alphanumeric**
Validates if a string only has alphanumeric characters. Valid ranges are `[a-zA-Z0-9]`.

**alphadash**
Validates if a string only has alphanumeric, dashes or underscore characters. Valid ranges are `[a-zA-Z0-9-_]`.

**regex**`:pattern`
Validates if a string matches a regex pattern.

**array**
Validates if an item is an array.

**date**
Validates if a string is a valid date format.

**string**
Validates if an item is a string.

**integer**
Validates if an item is integer.

**float**
Validates if an item is a float.

**file**
Validates if a path is an existing file.

**upload**
Validates if an item is a valid uploaded file through HTTP POST (see [File uploads](docs/##VERSION##/extra/file-uploads)).

**directory**
Validates if a path is an existing directory.

**writable**
Validates if a path is a writable directory or file.

**object**
Validates if an item is an object.

**boolean**
Validates if an item is a boolean.

**value**`:value`
Validates if an item has the exact specified value.

**not**`:value`
Validates if an item does not have the exact specified value.

**empty**
Validates if an item is empty. In case of arrays, this will check if it's an empty array. In strings, it will check if the string is empty.

**endswith**`:value`
Validates if a string ends with a specified string.

**startswith**`:value`
Validates if a string starts with a specified string.

### Valiation rules parameters
While using rules that accepts parameters (like `min`, `max`, `value`, `startswith`, etc.) you should set the validation rule along with `:` followed by the value you want.

_Example_
```php
$rules = ['min:8', 'max:16'] # validate item with minimum of 8 and maximum of 16
```

### Validating a single item
In order to validate a single item, use `$validator->validate()`. You must specify the item as the first parameter, and an array of rules as the second parameter.

Optionally you can also set a `bail` option as the third parameter. If this option is set to `true`, the validation will stop after the first failure found. If `false`, all validation rules will be tested and all failures will be returned.

This method will return `true` if the item is validated properly or `false` if not.

_Example_
```php
$data = 'myemail@hotmail.com';
$rules = ['required', 'string', 'email'];
$isValid = $validator->validate($data, $rules); # returns true
```

### Validating multiple items
In order to validate multiple items with the same rules for all of them, use `$validator->validateMultiple()`. You must specify an array of items as the first parameter and an array of rules as the second parameter.

Optionally you can also set a `bail` option as the third parameter. This works exactly as described in `validate()`, but applies to a single item validation.

Besides that, you can also optionally set a `bailAll` option as the fouth parameter. If this option is set to `true`, the validation of all items will stop after the first failure found in an item. If `false`, the validation of other items will continue normally after any failures found.

This method will return `true` if all items were validated properly or `false` if any failures.

_Example_
```php
$data = ['myemail@hotmail.com', 'test'];
$rules = ['required', 'string', 'email'];
$isValid = $validator->validateMultiple($data, $rules); # returns false
```

### Validating form fields
In order to validate multiple items with specific rules for each item, use `$validator->validateFields()`. You must specify an associative array with all fields keys and values as the first parameter and an associative array of arrays with rules for each field as the second parameter. Both parameters must have the same keys for all fields.

You can optionally set a `bail` and `bailAll` option as the third and fourth parameters. Those options works the same as described in `validateMultiple()`.

This method will return `true` if all fields were validated properly or `false` if any failures.

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
After running a validation, all validation failures can be retrieved through `$validator->getErrors()`. This method will return an associative array of fields or items (with each field/item being a key) and an array of invalid fields.

You can use this method to handle specific errors or show messages to the user based in a specific invalid field or item.

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
            'required' => true,
            'email' => true
        ]
    ]
*/
```

You can also pass an item or field key as the first parameter of this function to retrieve the validation errors for the unique item.

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
$errors = $validator->getErrors('name'); # returns []
```