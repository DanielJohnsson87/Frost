Frost MVC Readme.md 
====================
A MVC built by Daniel Johnsson as a part of the course PHPMVC at Blekinge Tekniska Högskola.
Credits to Mikael Roos who is the original founder of this MVC.

Mos @ github: https://github.com/mosbth


How to install Frost MVC
---------------------
### 1. Download

You can download Frost from github.

    > git clone git://github.com/Trobiz/Frost.git 

You can review its source directly on github: https://github.com/Trobiz/Frost

### 2. Installation

First you have to make the data-directory writable. This is the place where Frost needs to be able to write and create files.

    > cd frost; chmod 777 site/data 

### 3 .htaccess

Then you need to edit the .htaccess file. Look up the line Redirect all requests to index.php.

    > You need to change: RewriteBase /~dajj12/phpmvc/me7 to your root-foler for the MVC. 

### 4. Module/Install

And finaly Frost has some modules that need to be initialised. You can do this through a controller. Point your browser to the following link.

   > module/install 