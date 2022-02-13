# ***Command-line interface*** **delete.php**

## Description
- Script for deleting all file and folder except vendors.

## Delete you quickly app
The bellow command will delete all files / folders expects some of them.
```shell
php -f vendor/kekefreedog/luckyphp/bin/delete.php
```
Here an example of the command executed :
```
       __            __        ___  __ _____       
      / /  __ ______/ /____ __/ _ \/ // / _ \      
     / /__/ // / __/  '_/ // / ___/ _  / ___/      
    /____/\_,_/\__/_/\_\_,  /_/  /_//_/_/         
                       /___/                       

Are you sure to delete your application ? [y/N] y
🟢 Your application has been deleted with success.
```
Here the list of files / folders which don't be deleted after the operation :
```php
[ "vendor", "composer.json", "composer.lock" ];
```