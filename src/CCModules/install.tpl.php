<h1>Install modules</h1>
<p>The following modules were affected by this action.</p>

<table>
<caption>Results from installing modules.</caption>
<thead>
  <tr><th>Module</th><th>Result</th></tr>
</thead>
<tbody>
<?php foreach($modules as $module): ?>
<tr><td><?=$module['name']?></td><td><div class='<?=$module['result'][0]?>'><?=$module['result'][1]?></div></td></tr>
<?php endforeach; ?>
</tbody>
</table>

<h6>Password Hashing</h6>
<p>What hashing algorithm do you want to use to encrypt your passwords? Choose from plain, md5salt, md5, sha1salt, sha1.</p>
<?=$form['hashing_algorithm']->GetHTML()?>
<h6>Language</h6>
<p>What language are you using. English is default. Use html correct abbriviations. Engligh = en </p>
<?=$form['language']->GetHTML()?>
<h6>Url type</h6>
<p> What url type do you wish to use? Method nr 1 is default.
	<ul>
		<li>0	=> index.php/controller/method/arg1/arg2/arg3</li>
		<li>1 	=> controller/method/arg1/arg2/arg3</li>
		<li>2 	=> index.php?q=controller/method/arg1/arg2/arg3</li>
	</ul>
<?=$form['url_type']->GetHTML()?>
<?=$form['create']->GetHTML()?>
