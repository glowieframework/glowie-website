# View Helpers
View Helpers are methods that can be called from within your application views or layouts. You can use helpers to create custom utility functions to use inside your views, like processing data before printing, filtering content, formatting strings, etc.

Helpers methods are stored in `app/views/helpers/Helpers.php` file inside the `Glowie\Helpers\Helpers` class.

In order to create a new helper, create a **public function** inside this class.

_Example_
```php
<?php
    namespace Glowie\Helpers;

    class Helpers{

        /**
         * Converts an array of items into HTML ul>li structure.
        */
        public function arrayToUl($array){
            $li = '';

            foreach($array as $item){
                $li .= "<li>{$item}</li>\n";
            }

            return "<ul>{$li}</ul>";
        }

    }
?>
```

To call a helper method, from a view or layout use `$this->helperName()`.

_Example_
```html
<div class="items">
    <?php echo $this->arrayToUl($this->items); ?>
</div>
```