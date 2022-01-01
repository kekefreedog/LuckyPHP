# ***Class*** **Arrays**

## Info

```php
namespace  LuckyPHP\Code\Arrays;    # Name Space
public class Arrays{}               # Class name
```

## Description
This class contains methods for process arrays

## Methods

### 1. public static ***function*** **in_array_strpos**
- Check if one key of the array contains needle in entry

### 2. public static ***function*** **filter_by_key_value**
- Filter item in array by custom key inside this

### 3. public static ***function*** **stretch**
- Convert one dimensionnal array to multi dimensional array with separator
- Exemple 
```php
# Before
stretch([
    "one_two_tree"  =>  true,
])
# After
[
    'one'   =>  [
        'two'   =>  [
            'three' =>  true,
        ]
    ]
]
```

### 4. public static ***function*** **to_string_attributes**
- Convert array with attributes to string
- Exemple :
```php
# Input
$input = ["class"=>["red", "big"],"id"=>"user"];
# Output
$output = 'class="ref big" id="user"';
```