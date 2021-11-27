# ***Class*** **Header**

## Info

```php
namespace  Kutilities\Http\Header;  # Name Space
abstract class Header{}             # Class name
```

## Description
This class contains lots of usefull methods for defines header in current request processing


## Parameters

### 1. protected ***array*** **serverPage**
- Contains all roots/path about current page
- Array will be defined like this :
```php
[
    "url"       =>  "localhost/doublescreenproduction_dev/api/upload/"
    "directory" =>  "L:/My_Sites/doublescreenproduction_dev/",
    "path_alt"  =>  "/doublescreenproduction_dev", // Warning if depth page
    "path"      =>  "/doublescreenproduction_dev", 
]
```

## Methods

### 1. public ***function*** **set**
- Set header depending of the type in entry
- Return true if success or false is type is not defined in CONTENT_TYPE

## Constant

### 1. ***const*** **CONTENT_TYPE**
- Storing all content type
- Here current content type stored :
```php
[
    'js'    =>  'application/javascript; charset=utf-8',  # Js
    'json'  =>  'application/json; charset=utf-8',        # Json
    'yml'   =>  'application/x-yaml; charset=utf-8'       # Yaml
]
```