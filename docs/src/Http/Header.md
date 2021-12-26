# ***Class*** **Header**

## Info

```php
namespace  LuckyPHP\Http\Header;  # Name Space
abstract class Header{}             # Class name
```

## Description
This class contains lots of usefull methods for defines header in current request processing

## Parameters

### 1. public ***function*** **set**
- Set header of current page, dependig of the type of header given

## Methods

### 2. public ***function*** **getContentType**
- Return the Content-Type value dependig of the type of header needed

## Constant

### 1. ***const*** **CONTENT_TYPE**
- Storing all content type
- Here current content type stored :
```php
[
        # Html
        'html'  =>  'text/html',
        # Js
        'js'    =>  'application/javascript',
        # Json
        'json'  =>  'application/json',
        # Yaml
        'yml'   =>  'application/x-yaml'
]
```