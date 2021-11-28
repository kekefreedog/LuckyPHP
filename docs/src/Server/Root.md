# ***Class*** **Root**

## Info

```php
namespace  LuckyPHP\Server\Root;  # Name Space
abstract class Root{}               # Class name
```

## Description
This class contains lots of usefull methods for determine root of the current page


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

### 1. protected ***function*** **rootSet**
- Set parameters server root