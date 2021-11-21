# ***Class*** **Page**

## Info

```php
namespace  Kutilities\Server\Page;  # Name Space
abstract class Page{}               # Class name
```

## Description
This class contains lots of usefull methods for process the page data


## Parameters

### 1. protected ***array*** **serverPage**
- Contains all datas about current page
- Array will be defined like this :
```php
[
    "id"        => 
    "name"      => 'accueil',
    "type"      => 'page' or 'index' or 'template' or 'script',
    "ext"       => 'prod', 
    "php_self"  => "/doublescreenproduction_dev/app/page/accueil.prod" 
]
```

## Methods

### 1. protected ***function*** **nameSet**
- Set parameters server Page