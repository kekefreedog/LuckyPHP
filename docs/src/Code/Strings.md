# ***Class*** **Arrays**

## Info

```php
namespace  LuckyPHP\Code\Strings;   # Name Space
public class Strings{}              # Class name
```

## Description
This class contains methods for process strings

## Methods

### 1. public static ***function*** **camelToSnake**
- Convert camel to snake
- Exemple : CamelCaseName -> camel_case_name

### 2. public static ***function*** **snakeToCamel**
- Convert snake to camel
- Exemple : camel_case_name -> camelCaseName
- If capitalizeFirstCharacter is enable : camel_case_name -> CamelCaseName

### 3. public static ***function*** **clean**
- Clean all specials characters in string

### 4. public static ***function*** **process_https**
- Check url given start by https://

### 5. public static ***function*** **process_https**
- Check email given is value
- If true return email else return empty string

### 6. public static ***function*** **process_bool**
- Check if value given is boolean
- If boolean type true return true else return false

### 7. public static ***function*** **decomposeRoute**
- Decompose router in array
- Exemple :
```php
# Input
$input = "/toto/titi/tata/tonton/";
# Output
$output = [
    "/toto/titi/tata/",
    "/toto/titi/",
    "/toto/",
];
```