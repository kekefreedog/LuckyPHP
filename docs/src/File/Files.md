# ***Class*** **Files**

## Info

```php
namespace  LuckyPHP\File\Files; # Name Space
public class Files{}            # Class name
```

## Description
This class contains methods for write or update specific files

## Methods

### 1. public ***function*** **htaccessWrite**
- Write .htacces in www folder wich redirect all subfolder to root and convert path to get value (root)

### 2. public ***function*** **configWrite**
- Write the config file "app.yml" in config folder

### 3. public ***function*** **composerUpdate**
- Update "composer.json" on the root of the project by adding the below code :
    ```json
    {
        "autoload": {
            "psr-4": {
                "App\\": [
                    "src/"
                ]
            }
        }
    }
    ```
