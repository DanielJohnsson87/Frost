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

Go to www.your-install-path.com/index/index or follow the instructions bellow.  

First you have to make the data-directory writable. This is the place where Frost needs to be able to write and create files.

    > cd Frost; chmod 777 site/data 

### 3. .htaccess

Then you need to edit the .htaccess file located in your root-folder. Look up the line Redirect all requests to index.php.

    > You need to change: RewriteBase /~dajj12/phpmvc/me7 to your root-foler for the MVC. 
    > pico .htaccess 

### 4. Module/Install

And finaly Frost has some modules that need to be initialised. You can do this through a controller. Point your browser to the following link and follow the instructions.

   > www.your-install-path.com/module/install 

### 5. Enjoy FrostMVC!



How to Modify FrostMVC!
Modify Logo, Title, Footer & Navigation Menu
---------------------

### Modify Logo

If you wish to modify the standard logo to your own personal logo follow these simple steps.

1. Select your logo img and upload it to your themes/grid/img

2. Replace the logo-small.png with your own logo. (You must use the name logo-small.png). If
you don´t wish to replace the file. Go on to step 3. Otherwise your logo should be displaying now.

3. Open your site/config.php and find the $ly->config['theme'] array. You will find the line 
'logo' => '/img/logo-small.png' a litle bit further down. Modify that line to match your image link.

4. Save the changes and upload to your server. 



### Modify Title

If you wish to modify the Title on a page follow these steps.

1. Open your site/config.php and find the $ly->config['theme'] array. You will find the line 
'title' => 'FrostMVC - A model view controller made by Daniel Johnsson' . Modify the message
to what you want it to say. 

2. Save the changes and upload to your server. The changes should now be displayed. 



### Modify Footer

1. Open your site/config.php and find the $ly->config['theme'] array. You will find the lines
'footer-first', 'footer-second' & 'footer-third'. 

2.You need to change the content of these arrays to edit your footer. Footer-first is displayed
to the left in your browser, Footer-second in the middle and Footer-third to the left.

3. Save the changes and upload to your server. The changes should now be displayed. 



### Modify Navigation Menu.

1. Open your site/config.php and find the $ly->config['menus'] array. 

2. Edit the content after the text 'small' = array( . The other menu is for theme-developing and shoulden't be tamperd with unless your an advances user. 

3. 	To create a new menu button just ad the following text. 'The name of the link' => array('text' => 'The name of the link', 'url' => 'The url to your link'), . Read more on how links work in FrostMVC further down.

4. Save the changes and upload to your server. The changes should now be displayed. 

### How links work in FrostMVC

If you create a blog-post or a page you can link to them like this: www.your-server.com/root-directory/my/index/The-key-of-the-post-or-page

You define the when you create a new post or page. A post with the key Spring-break would look something 
like this in my local enviroment. http://localhost/phpmvc/Frost/my/index/Spring-break


How to create a new page
---------------------

1. Login with the login menu in the upper right corner. Standard username & password is root root .

2. Go to the content page and choose create new content in the bottom of the page.

3. Now it´s time to create your content. This is what the fields represent.

Title = The title that will be displayed at your page.

Key = This will work as an internal url for FrostMVC. You can´t have spaces between words. Use 
the following structure: Firstword-Secondword-Thirdword or Firstword_Secondword_Thirdword 

Content = This is where you type the content you wish to display. 

Type = Define what type of content it is you´r creating. Page or Post

Filter = What filter do you wan´t to use to render the Content that you typed in the content area. I 
recommend htmlpurify . If you use htmlpurify you can use regular html. Your other options are bbcode,
plain(not recommended!) and phpmarkdown . Read more on bbcode, htmlpurify & phpmarkdown on their sites.

4. Save your settings

5. Your content will be visable at www.your-server.com/root-directory/my/index/the-key-you-defined