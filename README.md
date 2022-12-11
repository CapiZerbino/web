# web-programming-assignment
# Setting up

### 1. Install xampp if you haven't

If xampp asks for anything, make sure to always say yes

### 2. On MacOS, go to /Applications/XAMPP/xamppfiles/htdocs, clone this repo

It should look like this
```
xampp
  |-----htdocs
         |-------core
                |-------controller
                |-------model
                |-------view
         |-------public
                |-------.htaccess
                |-------index.php
```
### 3. On MacOS, go to /Applications/XAMPP/xamppfiles/apache2/conf/httpd.conf, edit this file as below:
```
Alias /bitnami/ "/Applications/XAMPP/xamppfiles/apache2/htdocs/public/"
Alias /bitnami "/Applications/XAMPP/xamppfiles/apache2/htdocs/public/"

<Directory "/Applications/XAMPP/xamppfiles/apache2/htdocs/public/">
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>

```
### 4. Start xamp, go to phpmyadmin and import file jobseeker.sql

### 5. In xampp control panel, stop apache (if it's already running), close the control panel, restart (your pc preferably, and) the apache service

### 6. Open any web browser, go to [http://localhost/public/home](http://localhost/public/home)