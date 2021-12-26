# ***Class*** **Files**

## Info

```php
namespace  LuckyPHP\File\Files; # Name Space
public class Files{}            # Class name
```

## Description
This class contains methods for write or update specific files

## Methods

### 1. public static ***function*** **header**
- Return the header of the page
```php
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 *
 * This file is part of LuckyPHP.
 *
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/
```

### 2. public static ***function*** **header**
- Return the header alternative of the page (for htaccess page for exemple)
```sh
# ******************************************************
#  Copyright (C) 2019-2021 Kévin Zarshenas
#  kevin.zarshenas@gmail.com
#  
#  This file is part of LuckyPHP.
#  
#  This code can not be copied and/or distributed without the express
#  permission of Kévin Zarshenas @kekefreedog
# ******************************************************
```

### 3. public ***function*** **htaccessWrite**
- Write .htaccess in www folder wich redirect all subfolder to root and convert path to get value (root)

### 3. public ***function*** **configWrite**
- Write the config file "app.yml" in config folder

### 4. public ***function*** **indexWrite**
- Write the index.php file 

### 5. public ***function*** **composerUpdate**
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
### 6. public ***function*** **packageUpdate**
- Get package.js and update it
- Set devDependencies
- Set NPM scripts for manage assets (css, js...)

### 7. public ***function*** **jsImportWrite**
- Juste write content of js file with an import action.

### 8. public ***function*** **controllerWrite**
- Write the controller of default route and new route