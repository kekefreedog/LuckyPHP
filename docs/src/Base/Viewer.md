# ***Class*** **Viewer**

## Info

```php
namespace  LuckyPHP\Base\Viewer;    # Name Space
class Viewer{}                      # Class name
```

## Description
- Define the rooter workflow of the framework

## Methods

### 1. private ***function*** **argumentsIngest**
- Ingest all arguments :
    - Controller object
    - Request object
    - Data
    - Config
    - Cache
    - Callback (from the current context controller)

### 2. private ***function*** **getConstructor**
- A kind of router which analyse response type await and call the constructor of the needed response
- Type can be **html**, **json**...

### 3. private ***function*** **constructorHtml**
- Constructor for **html** request
- Use template engine

### 4. public ***function*** **rendererHtml**
- Render template of constructorHtml

### 5. private ***function*** **constructorJson**
- Constructor for **json** request

### 6. private ***function*** **responsePrepare**
- Prepare response object

### 7. public ***function*** **setResponseContent**
- Set content in response as content

### 8. public ***function*** **reponseExecute**
- Send response to client

### 9. public ***function*** **getData**
- Return object data

### 10. public ***function*** **getResponseType**
- Return type of the response
- Exemple json, html...

### 11. public ***function*** **getContentType**
- Return content type value of the response