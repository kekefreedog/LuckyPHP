# ***Class*** **Config**

## Info

```php
namespace  Kutilities\Server;   # Name Space
abstract class Config{}         # Class name
```

## Dependance
- Yaml

## Description
This class contains lots of usefull methods for determine root of the current page

## Methods

### 1. private ***function*** **read**
- Read settings file with path or name
- If {{root}} is include in path name, it will be replace by root

## Constants

### 1. public ***const*** **CONFIG_PATH**
- List of all settings path with name
```php
[
    'settings'  =>  '{{root}}/../config/settings.yml'
]
```