# ***Class*** **Structure**

## Info

```php
namespace  Kutilities\Code\Structure;   # Name Space
public class Structure{}                # Class name
```

## Description
This class contains methods for process files and folder and create complex folder schema.

## Methods

### 1. public ***function*** **tree_folder_file_create**
- Create folder with sub-folders
- Copy file and rename them in folder concerned

## Constants

### 1. private ***const*** **STRUCTURE_APP**
- Correspond to the folder/file structure generate by LuckyPHP
- "@root" correspond of the root of the application
- Exemple of use :
```yml
--- # Structure exemple
#Name of the folder
- folderName:
    # Children folders
    - folders :
        # Same structure the foldername
        - foldername :  
            - folders : 
                ...
            - files : 
                ...
    # Children files
    - files :
        # Name of file
        - filename :
            # Source of the file
            - src : ...
            # Function for get the content of the file
            - function :
                # Name of the function 
                - name : function
                # parameters for this function in order
                - parameters : 
                    - ...
                    - ...
```