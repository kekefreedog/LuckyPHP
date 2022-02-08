# Update Folder Structure

## Description
Folder Structure contains all the structure of your app.

## 1. Where find it ?
The class structure is located inside ``/src/Kit/Structure.php`` and is accessible with bellow namespace ``LuckyPHP\Kit\Structure.``

## 2. How does it works ?

**Structure** is a vlass with constant **APP**. And **APP** contains all the structure in a array.

- The first parameter of the structure is the root ``"/"``
- Inside the root you have ``"folders"`` and / or ``"files"``.

## 3. Folders 
Folders' name are defined by all the key inside ``"folders"``.
- A folder contains ``"folders"`` and / or ``"files"``
- If you want generate empty folder, just lets the array empty ``[]``

## 4. Files
Files's name ans extension are defines by all the key inside ``"files"``.
File can contains differents type of data :
- A ``'function'`` parameters wich containes :
- ``'name'`` of the function called
- ``'arguments'`` of the function called
- A ``'source'`` path of the file that you want duplicate
- Nothing ``'[]'`` if you want just have an ampty file
        

