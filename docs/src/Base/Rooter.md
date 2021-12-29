# ***Class*** **Rooter**

## Info

```php
namespace  LuckyPHP\Base\Router;    # Name Space
class Router{}                      # Class name
```

## Description
- Define the rooter workflow of the framework

## Methods

### 1. private ***function*** **instanceCreate**
- Create new instance using the Mezon router

### 2. private ***function*** **configRoutesSet**
- Read the configg file of routees
- Check if methods parameters is uppercase every words

### 3. private ***function*** **requestSet**
- Set request value in current class

### 4. private ***function*** **routerFill**
- Check routers and methods not empty
- Check each route
- Check each methods of the routes
- Prepar ecallback of each routers
- Push them in the router instance

### 5. public ***function*** **routeCallbackCheck**
- Check if conntroller of the current route exist
- Return the path corresponding to the name given

### 6. private ***function*** **routerExecute**
- Get the Uri from server info
- Remove query string on it
- Call the route of the current page

### 7. public ***function*** **getResponse**
- Return the response of the controller of the current page

### 8. public ***function*** **getCallback**
- Return the controller of the current page

