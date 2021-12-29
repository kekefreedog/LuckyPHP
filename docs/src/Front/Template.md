# ***Class*** **Template**

## Info

```php
namespace  LuckyPHP\Front\Template; # Name Space
class Template{}                    # Class name
```

## Description
This class contains lots of usefull methods for build a template

## Parameters

### 1. public static ***function*** **lightnCandyInit**
- Return setup for LightCandy with Handlebarsjs flag
- Differents helpers :
    - **ifEquals** : Equivalent of if
    - **cleanString** : For clean string of strange characters
    - **colorText** : convert material color class for text tags
    - **count** : return number of item in array

### 2. public ***function*** **addDoctype**
- Add doctype tag

### 3. public ***function*** **addHtmlStart**
- Add html tag

### 4. public ***function*** **addHeadStart**
- Open head tag

### 5. public ***function*** **addHeadMeta**
- Build head content depending of the branch given
- If no given branch, it will takes the default in page.yml
- Then it creates all the tags from page.yml

### 6. public ***function*** **addStylesheet**
- Add globale style find in ``www/css/``
- Add specific style of the current page

### 7. public ***function*** **setTitle**
- Set title depending of the title given
- It is possible to disply name of the app

### 8. public ***function*** **addHeadEnd**
- Close head tag

### 9. public ***function*** **addBodyStart**
- Close head tag

### 10. public ***function*** **loadLayouts**
- Load layouts from template root folder (define in config app)
- You can choose a custom folder root where search layouts

### 11. public function ***function*** **addIndexJs**
- Add js file in ``/www/js`` on page

### 12. public ***function*** **addBodyEnd**
- Close head tag

### 13. public ***function*** **addHtmlEnd**
- Close html tag

### 14. public ***function*** **build**
- Build the template
- Return result for compiling and then render