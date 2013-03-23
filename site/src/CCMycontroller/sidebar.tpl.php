<?php if($content != null):?>
	<h5>Posts</h5>
	<ul>

  <?php foreach($content as $val):?>

  <li><a href="<?=esc($val['key'])?>"><?=esc($val['title'])?></a>
<p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p><hr></li>

<?php endforeach; ?>
</ul>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>