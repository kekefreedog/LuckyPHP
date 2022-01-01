# ***Class*** **Model**

## Info

```php
namespace  LuckyPHP\Base\Model; # Name Space
class Model{}                   # Class name
```

## Description
- Define the model workflow of the framework

## Methods about **Data**

### 1. public ***function*** **execute**
- Execute model
- Return value

## Methods about **Errors**

### 1. public ***function*** **pushErrors**
- Push errors in data
- Can push one or multiple errors
- Second arguments allow to put or not ***_status_code*** info for ui

### 2. private ***function*** **pushError**
- Push one clean error in data

### 3. public ***function*** **getErrors**
- Get all errors in data

### 4. public ***function*** **resetErrors**
- Remove all errors from data

## Methods about **Config**

### 1. public ***function*** **pushConfig**
- Push custom config in data
- Key on first depth can't be integral values

### 2. private ***function*** **loadConfig**
- Load config from application in data
- Argument can be a string or array

### 3. public ***function*** **getConfig**
- Get all configs from data

## Methods about **_user_interface**
- Set framwork extra data

### 1. public ***function*** **setFrameworkExtra**
- Push custom data depending of the framework set on the config

### 2. public ***function*** **pushDataInUserInterface**
- Push custom array data in ***_user_interface***
- Option allow to push data recursively


