# ***Class*** **Config**

## Info

```php
namespace  LuckyPHP\Server\Config;  # Name Space
abstract class Config{}             # Class name
```

## Dependance
- Yaml

## Description
This class contains lots of usefull methods for determine root of the current page

## Methods

### 1. public static ***function*** **read**
- Read settings file with path or name

### 2. public static ***function*** **exists**
- Check if a config file exists in ``/config``

### 2. public static ***function*** **defineRoots**
- Define root as global variable
- Bellow an exemple of input :
```php
[
    'app'       =>  $directory,
    'www'       =>  $directory.'www/',
    'luckyphp'  =>  $directory.'vendor/kekefreedog/luckyphp/',
]
```
- At final we will be able to access to those variable, just using :
```php
__ROOT_APP__
__ROOT_WWW__
__ROOT_LUCKYPHP__
```

## Constants

### 1. public ***const*** **CONFIG_PATH**
- List of all settings path with name
```php
[
    'app'   =>  'config/app.yml',
    'routes'=>  'config/routes.yml',
    'page'  =>  'config/page.yml'
]
```