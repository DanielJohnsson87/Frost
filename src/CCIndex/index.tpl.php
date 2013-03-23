<h1>FrostMVC Installation Guide</h1>
<P>
<div class="<?=$phptest['class']?>"><?=$phptest['info'];?></div>
<?php if( in_array('mod_rewrite', apache_get_modules())) :?> 
	<div class="success"> Mod_Rewrite is Enabled. </div>
<?php else:?>
	<div class="alert"> Mod_Rewrite is disabled. Enable it before using FrostMVC</div>
<?php endif;?>
</p>
<p>You'r just a few simple steps away from using experiencing the power of FrostMVC.</p>


<?php if($phptest['class'] == 'success'): ?>
<u><h2>Step I - Download</h2></u>
<p>You can download Frost from github. If you never used Git & Github before, don't worry.
This interactive tutorial will get you started in notime! <a href="http://try.github.com/levels/1/challenges/1">Code School - Try Git</a> </p>
<blockquote>
<code>git clone git://github.com/Trobiz/Frost.git</code>
</blockquote>
<p>You can review its source directly on github: <a href='https://github.com/Trobiz/Frost'>https://github.com/Trobiz/Frost</a></p>

<u><h2>Step III - .htaccess</h2></u>
<p>Second, you need to edit the .htaccess file. Look up the line Redirect all requests to index.php.
	<blockquote>
	<code> You need to change: RewriteBase /~dajj12/phpmvc/me2 to your root-foler for the MVC. </code>
</blockquote>
</p>

<u><h2>Step II - Installation</h2></u>
<p>First you have to make the data-directory writable. This is the place where Frost needs
to be able to write and create files.</p>
<blockquote>
<code>cd Frost; chmod 777 site/data</code>
</blockquote>


<h2>Step IV - Module/Install</h2>
<p>Finaly, Frost has some modules that need to be initialised. You can do this through a
controller. Point your browser to the following link.</p>
<blockquote>
<a href='<?=create_url('module/install')?>'>module/install</a>
</blockquote>

<?php else: ?>

<h2>Step I - Update your server to PHP 5.0.0 or later </h2>
<p>In order to use FrostMVC you need to install PHP 5.0.0 or later. Talk to your Administrator if your
not the owner of the server.</p>
<?php endif; ?>