# ***Class*** **Routes**

## Info

```php
namespace  LuckyPHP\Kit\Routes; # Name Space
public class Routes{}           # Class name
```

## Description
This class contains constants for default routes

## Constants

### 1. public ***const*** **DEFAULT**
- Default routes of the app
- Exemple of utilisation :
    - name : Title of the page
    - patterns : All the route patterns that redirect to the current page
    - methods : All methods allow for the current rout, methods allowed : GET, get, POST, post, PUT, put, DELETE, delete, OPTION, option, PATCH, patch, *
    - response : Type of response html / json ...
- Here the default routes
```php
'routes'    =>  [

    /**
     * App
     */

    /* Index */
    [
        'name'      =>  'Home',
        'patterns'  =>  [
            '/index/'
        ],
        'methods'   =>  [
            'get',
        ],
        'response'   =>  'html'
    ],

    /**
     * Api
     */

    /* Info */
    [
        'name'      =>  'Info',
        'patterns'  =>  [
            '/api/'
        ],
        'methods'   =>  [
            'get'
        ],
        'response'   =>  'json'
    ],

    /**
     * All the others pages
     */

    /* Page not found */
    [
        'name'      =>  'Page not found',
        'patterns'  =>  [
            '/*/'
        ],
        'methods'   =>  [
            '*'
        ],
        'response'   =>  'html',
    ],

],
```
- Parameters **methods** contains all the methods allowed in the app
```php
[
    'GET', 'POST', 'PUT', 'DELETE', 'OPTION', 'PATCH'
]
```