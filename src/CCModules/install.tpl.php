<div class="<?=$phptest['class']?>"><?=$phptest['info'];?></div>
<?php if( in_array('mod_rewrite', apache_get_modules())) :?> 
	<div class="success"> Mod_Rewrite is Enabled. </div>
<?php else:?>
	<div class="alert"> Mod_Rewrite is disabled. Enable it before using FrostMVC</div>
<?php endif;?>

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
