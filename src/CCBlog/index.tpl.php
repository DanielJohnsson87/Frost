<h1>Blog</h1>
<p>All blog-like list of all content with the type "post", <a href='<?=create_url("content")?>'>view all content</a>.</p>

<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
  <div class="blog-post">
    <h3><?=$val['title']?></h3>
    <p><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
    <p class='smaller-text silent'><a href='<?=create_url("content/edit/{$val['id']}")?>'>edit</a></p>
</div>
  <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
  <?php endif;?>