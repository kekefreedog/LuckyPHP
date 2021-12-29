# ***Class*** **Template**

## Info

```php
namespace  LuckyPHP\Front\Template; # Name Space
class Template{}                    # Class name
```

## Description
This class contains lots of usefull methods for build a template

## Parameters

### 1. public ***function*** **addDoctype**
- Add doctype tag

### 1. public ***function*** **addHtmlStart**
- Add html tag

### 3. public ***function*** **addHeadStart**
- Open head tag

### 4. public ***function*** **addHeadMeta**
- Build head content depending of the branch given
- If no given branch, it will takes the default in page.yml
- Then it creates all the tags from page.yml

### 5. public ***function*** **addStylesheet**
- Add globale style find in ``www/css/``
- Add specific style of the current page

### 6. public ***function*** **setTitle**
- Set title depending of the title given
- It is possible to disply name of the app

### 7. public ***function*** **addHeadEnd**
- Close head tag

### 8. public ***function*** **addBodyStart**
- Close head tag

### 9. public ***function*** **addBodyEnd**
- Close head tag

### 10. public ***function*** **build**
- Build the template
- Return the result