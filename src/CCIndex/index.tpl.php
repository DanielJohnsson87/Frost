<h1>FrostMVC Installation Guide</h1>
<p>You'r just a few simple steps away from using experiencing the power of FrostMVC.</p>

<h2>Step I - Download</h2>
<p>You can download Frost from github.</p>
<blockquote>
<code>git clone git://github.com/Trobiz/Frost.git</code>
</blockquote>
<p>You can review its source directly on github: <a href='https://github.com/Trobiz/Frost'>https://github.com/Trobiz/Frost</a></p>

<h2>Step II - Installation</h2>
<p>First you have to make the data-directory writable. This is the place where Frost needs
to be able to write and create files.</p>
<blockquote>
<code>cd frost; chmod 777 site/data</code>
</blockquote>

<h2>Step III - .htaccess</h2>
<p>Second, you need to edit the .htaccess file. Look up the line Redirect all requests to index.php.
	<blockquote>
	<code> You need to change: RewriteBase /~dajj12/phpmvc/me7 to your root-foler for the MVC. </code>
</blockquote>
</p>

<h2>Step IV - Module/Install</h2>
<p>Third, Frost has some modules that need to be initialised. You can do this through a
controller. Point your browser to the following link.</p>
<blockquote>
<a href='<?=create_url('module/install')?>'>module/install</a>
</blockquote>