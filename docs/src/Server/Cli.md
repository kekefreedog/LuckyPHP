# ***Class*** **Cli**

## Info

```php
namespace  LuckyPHP\Server\Cli;   # Name Space
abstract class Cli{}                # Class name
```

## Description
This class contains methods for be create or u^date architecture of the projet.
The script is associated to Command Line Script (PHP_CLI).

## Parameters

### 1. public filename
- Filename of the current script executed

## Methods

### 1. public ***function*** **message_welcome**
- Welcome message display at the start
```
      __            __        ___  __ _____
     / /  __ ______/ /____ __/ _ \/ // / _ \
    / /__/ // / __/  '_/ // / ___/ _  / ___/
   /____/\_,_/\__/_/\_\_,  /_/  /_//_/_/
                      /___/

👋 Welcome to LuckyPHP, my own development toolkit for developed beautiful web applications.
```

### 2. private ***function*** **rooting**
- Function to search action associated to the current filename
- If no action is found, it will display this message :
```
(❌)------------------------------------------------ 
Sorry, no action is associated to the current file :
"{{filename}}"
-------------------------------------------------(❌)
```

### 3. private ***function*** **setup**
- Ask user differents informations for create a LuckyApp :
      - Name of the app (check if the name of the app is allowed)
      - The framework
      - The Auth system

## Constants

### 1. public ***const*** **NAME_PROHIBITED**
- List all application names not allowed : 
```php
['Server','src','luckyphp','kekefreedog','vendor','bin']
```
