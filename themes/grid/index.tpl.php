<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">
  <title><?=$title?></title>
 <link rel='stylesheet' href='<?=theme_url($stylesheet)?>'/>
     <?php if(isset($inline_style)): ?><style><?=$inline_style?></style><?php endif; ?>
</head>
<body>
<div id='outer-wrap-toprow'>
  <div id='inner-wrap-toprow'>
 <div class="top-row"></div>
  </div>
</div>


<header id='outer-wrap-header' class="link-color">
  <header id='inner-wrap-header'>
    <div id='header-logo'><img src="<?=theme_parent_url($logo)?>"> </div>

	 <div id='header-menu'><?=render_views('header-menu')?></div>

    <div id='header-login'><?=login_menu()?></div>

  </header>
</header>
<div class="index-wrapper">

<?php if(region_has_content('headline')): ?>
<div id='outer-wrap-headline'>
  <div id='inner-wrap-headline'>
    <div id='headline'><?=render_views('headline')?></div>
  </div>
</div>
<?php endif; ?>


<div id='outer-wrap-content'>
  <div id='inner-wrap-content'>
    <div id='content'><?=get_messages_from_session()?><?=render_views('content')?><?=@$main?><?=render_views()?></div>
    <div id='sidebar'><?=render_views('sidebar')?></div>
  </div>
</div>

<div id='outer-wrap-footer'>
	<?php if(region_has_content('footer-first', 'footer-second', 'footer-third')): ?>

  <div id='inner-wrap-footer'>

    <div id='footer-first'><?=render_views('footer-first')?></div>
    <div id='footer-second'><?=render_views('footer-second')?></div>
    <div id='footer-third'><?=render_views('footer-third')?></div>

  </div>
  <?php endif; ?>
</div>
</div>
</body>
</html>