# ***Class*** **Template**

## Info

```php
namespace  LuckyPHP\Front\Template; # Name Space
class Template{}                    # Class name
```

## Description
This class contains lots of usefull methods for build a template

## Parameters

### 1. public ***function*** **addHead**
- Build head content depending of the branch given
- If no given branch, it will takes the default in page.yml
- Then it creates all the tags from page.yml

### 2. public ***function*** **build**
- Build the template
- Return the result