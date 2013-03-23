<?php if($content['key']):?>
  <h1><?=esc($content['title'])?></h1>
<p><?=$content->GetFilteredData()?></p>
<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>
