<h1>Index Controller</h1>
<p>Welcome to Frost index controller.</p>

<h2>Download</h2>
<p>You can download Frost from github.</p>
<blockquote>
<code>git clone git://github.com/Trobiz/Frost.git</code>
</blockquote>
<p>You can review its source directly on github: <a href='https://github.com/Trobiz/Frost'>https://github.com/Trobiz/Frost</a></p>

<h2>Installation</h2>
<p>First you have to make the data-directory writable. This is the place where Frost needs
to be able to write and create files.</p>
<blockquote>
<code>cd frost; chmod 777 site/data</code>
</blockquote>

<p>Second, Frost has some modules that need to be initialised. You can do this through a
controller. Point your browser to the following link.</p>
<blockquote>
<a href='<?=create_url('module/install')?>'>modules/install</a>
</blockquote>