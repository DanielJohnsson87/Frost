<h1>Content Controller Index</h1>
<p>One controller to manage the actions for content, mainly list, create, edit, delete, view.</p>

<h3>All content</h3>
<?php if($contents != null):?>
  <ul>
  <?php foreach($contents as $val):?>
    <li><?=$val['id']?>, <?=$val['title']?> by <?=$val['owner']?> <a href='<?=create_url("content/edit/{$val['key']}")?>'>edit</a> <a href='<?=create_url("page/view/{$val['key']}")?>'>view</a>
  <?php endforeach; ?>
  </ul>
<?php else:?>
  <p>No content exists.</p>
<?php endif;?>
<?php if($is_authenticated): ?>
  <p>User is authenticated.</p>
<?php else: ?>
  <p>User is anonymous and not authenticated.</p>
<?php endif; ?>
<h3>Actions</h3>
<ul>
  <li><a href='<?=create_url('content/init')?>'>Init database, create tables and sample content</a>
  <li><a href='<?=create_url('content/create')?>'>Create new content</a>
  	 <li><a href='<?=create_url('blog')?>'>View as blog</a>
</ul>