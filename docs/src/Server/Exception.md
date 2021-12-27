# ***Class*** **Exception**

## Info

```php
namespace       LuckyPHP\Server\Exception;  # Name Space
interface       InterfaceException{}        # Interface name
public class    Exception{}                 # Class name
```

## Description
- This class is extend from \Exception and contains all methods for manage Exception

## Methods

### 1. private ***function*** **setSource**
- Depending of the file, check of the error come from the LuckuPHP, from Vendor or from the App.
- Then fill the parameter **source**
- Values allowd : 
    - ***null***
    - luckyphp
    - vendor
    - app

### 2. public ***function*** **getSource**
- Return the source value

### 3. public ***function*** **consoleError**
- Display the error as error message in the Javascript Console
- Exemple :
```js
⚠️ [Error 500 : Internal Server Error] Your content must be a Json if you want return a Json (on the file ../Base/Viewer line 119)
```

### 4. private ***function*** **logWrite**
- Write the error in the log file (depending of the source).
- Logs are in folder : ``/logs/{source}.log``
- Exemple a message in the log :
```log
2021-12-27 14:16:30 : ⚠️ [Error 500 : Internal Server Error] Your content must be a Json if you want return a Json (on the file ../Base/Viewer line 119)
```