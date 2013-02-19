<h1>Frost Guestbook Example</h1>
    <?=get_messages_from_session()?>
<p>Showing off how to implement a guestbook in Lydia. Now saving to database.</p>

<form action="<?=$formAction?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea name='newEntry' rows='10' cols='50'></textarea></label>
  </p>
  <p>
    <input type='submit' name='doAdd' value='Add message' />
    <input type='submit' name='doClear' value='Clear all messages' />
    <input type='submit' name='doCreate' value='Create database table' />
  </p>
</form>

<h3>Current messages</h3>

<?php foreach($entries as $val):?>
<div style='background-color:#ccc;border:1px solid #ccc;margin-bottom:1em;padding:1em;'>
  <p>At: <?=$val['created']?></p>
  <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>