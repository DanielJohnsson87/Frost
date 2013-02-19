<h1>User Profile</h1>
<?= get_messages_from_session()?>
  <li><a href='<?=create_url(null, 'init')?>'>Init database, create tables and create default admin user & Doe user</a>
  <li><a href='<?=create_url(null, 'login')?>'>Login</a>
</ul>
<p>This is what is known on the current user.</p>

<?php if($is_authenticated): ?>
  <p>User is authenticated.</p>
<?php else: ?>
  <p>User is anonymous and not authenticated.</p>
<?php endif; ?>