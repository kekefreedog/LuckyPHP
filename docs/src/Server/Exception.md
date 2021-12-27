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

### 1. public ***unction*** **consoleError**
- Display the error as error message in the Javascript Console
- Exemple :
```js
⚠️ [Error 500 : Internal Server Error] Your content must be a Json if you want return a Json (on the file ../Base/Viewer line 119)
```