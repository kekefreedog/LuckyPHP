# Update PHP

## On Mac with Homebrew

> Source : https://stitcher.io/blog/php-81-upgrade-mac

### 1. Check Homebrew is up to date
```shell
brew update
```

### 2. Check PHP is up to date
```shell
brew upgrade php
```

### 3. Upgrade *shivammathur*
```shell
brew tap shivammathur/php
brew install shivammathur/php/php@8.1
```

### 4. Switch to new version
```shell
brew link --overwrite --force php@8.1
```

### 5. Check **httpd.conf**
- Please check in httpd.conf the load module php_module 
```shell
LoadModule php_module /usr/local/Cellar/php/8.1.2/lib/httpd/modules/libphp.so
```

### 6. Restart *Apache*
```shell
sudo apachectl restart
```