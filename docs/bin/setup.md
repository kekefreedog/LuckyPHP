# ***Command-line interface*** **setup.php**

## Description
- First script to execute for create the architecture of the site web.

## Installation guide
### 1. Composer
- On the root of your project, open a terminal and execute the bellow command :
```sh
composer require kekefreedog/luckyphp:"dev-main" 
```

### 2. Execute
- Since the root of your project, open a terminal and execute this command :
```shell
php -f vendor/kekefreedog/luckyphp/bin/setup.php
```
```shell
       __            __        ___  __ _____       
      / /  __ ______/ /____ __/ _ \/ // / _ \
     / /__/ // / __/  '_/ // / ___/ _  / ___/
    /____/\_,_/\__/_/\_\_,  /_/  /_//_/_/
                       /___/

👋 Welcome to LuckyPHP, my own development toolkit for
developed beautiful web applications.

(🚀)-[ SETUP ]--------------------------------------
```
1. First, application will ask you the name of your application. By default it takes the name of the root folder. By default it will propose the name of the current folder.

```shell
1. Name of your application : (K_utilities)
```

2. 1 After it asks you if you want use Kmaterialize.
```shell
2. Do you want use Kmaterialize ? [Yes] or [No] :
```
2. 2 If you choose Kmaterialize, it propose to choose between the basic branch or the advance branch.
```
2-2. Load Kmaterialize Basic [0] or Advanced [1] ? 
```

3. Then it asks you if want use the internal Auth script or anther Auth (like Google...).
```shell
3. Use internal auth script ? [Yes] or [No] :
```

4. Then application is ready, user just have to press **Enter/Return** key.
```shell
We are ready to create "K_utilities"
Press [enter] key and let's go ! 🔥🔥🔥
```