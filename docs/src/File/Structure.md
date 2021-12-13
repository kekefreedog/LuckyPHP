# ***Class*** **Structure**

## Info

```php
namespace  LuckyPHP\Code\Structure;     # Name Space
public class Structure{}                # Class name
```

## Description
This class contains methods for process files and folder and create complex folder schema.

## Methods

### 1. public ***function*** **tree_folder_file_create**
- Create folder with sub-folders
- Copy file and rename them in folder concerned

### 2. public ***function*** **htaccessWrite**
- Write .htacces in www folder

### 3. public ***function*** **configWrite**
- Write empty config file "app.yml" in config folder

### 4. public ***function*** **composerUpdate**
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