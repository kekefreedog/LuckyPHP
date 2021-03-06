# ***Class*** **Controller**

## Info

```php
namespace  LuckyPHP\BAse\Controller;    # Name Space
public class Controller{}               # Class name
```

## Description
This class contains methods that extend controller of routes

## Methods

### 1. private static ***function*** **argumentsIngest**
- Ingest arguments given

### 2. private static ***function*** **routePrepare**
- Prepare route parameters
- Set bellow values :
```php
[
    'current'   =>  [
        'pattern'   =>  '...',
        'method'    =>  '...',
        'name'      =>  '...',
    ],
    'config'    =>  [
        'methods'   =>  '...',
        'patterns'  =>  '...',
        'response'  =>  [
            'default'       =>  '...',
            'Content-Type'  =>  '...',
        ]
    ]
]
```

## Methods for Model

### 1. public ***function*** **newModel**
- Create new model

### 2. public ***function*** **getModelResult**
- Execute model
- Return his value as array