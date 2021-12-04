# Add new virtual hosts

## On Mac with Homebrew

### 1. httpd.conf
- Open ``/usr/local/etc/httpd/httpd.conf`` with any text editor.
- Check lines LoadModule ``vhost_alias_module lib/httpd/modules/mod_vhost_alias.so`` & ``Include /usr/local/etc/httpd/extra/httpd-vhosts.conf`` are not commented.

### 2. hosts
- Open ``/private/etc/hosts`` with any text editor.
- Add line bellow ``127.0.0.1	luckyphp.test``
    - **127.0.0.1** is localhost
    - **luckyphp.test** is the new host associate to localhost

### 3. httpd-vhosts.conf
- Open ``/usr/local/etc/httpd/extra/httpd-vhosts.conf`` with any text editor.
- Add line like bellow
```xml
<VirtualHost *:80>
    ServerAdmin admin@email.com
    DocumentRoot "/Users/Sites/test/www"
    ServerName luckyPHP.test
</VirtualHost> 
```
- **ServerAdmin** is email of the admin
- **DocumentRoot** is the root of your www folder
- **ServerName** is the same string from hosts in step 2.

### 4. Restart apache
- Open a terminal "cmd+maj+c"
- Execute this command ``sudo apachectl restart``
- Then enter your password and voilà
