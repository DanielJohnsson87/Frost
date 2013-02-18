<?php 
/**
* Helpers for the template file
*/
// -------------------------------------------------------------------------------------------
//
// Common header
//
$ly->data['logo'] = theme_url('img/logo-small.png');
$ly->data['base_url'] = base_url();
$ly->data['header'] = <<<EOD
<div class="top-row"></div>
<header class="header-container clear">
<div class="logo"><a href="index.php"><img src="{$ly->data['logo']}"></a></div>

                <nav>
                    <ul>
                        <li><a id="Index-" href="{$ly->data['base_url']}index">Hem</a></li>
                        <li><a id="Report-" href="{$ly->data['base_url']}guestbook">Guestbook</a></li>
                        <li><a id="Presentation-" href="{$ly->data['base_url']}developer">Developer</a></li>
                        <li><a id="Source-" href="{$ly->data['base_url']}user">User</a></li>
                    </ul>
                </nav>
                        <div class="clear"></div>

        </header>
EOD;
// -------------------------------------------------------------------------------------------
//
// Common footer
//

$ly->data['footer'] = <<<EOD
  <div class="footer-container">
<section>
<h1> Vem är jag?</h1>
<p>Mitt namn är Daniel Johnsson. Jag är 25 år och kommer ifrån Båstad.
Jag studerar just webbprogrammering på BTH....</p>
<a href="#">Läs mer &rarr;</a>
</section>

<section>
<h1> Uppgifter</h1>
<p>På den här sidan sparar jag alla mina arbeten som jag gör i kursen PHP & MVC. Är
du nyfiken så är de bara att spana in... </p>
<a href="#">Läs mer &rarr;</a>
</section>

<section>
<h1> Kontakta mig</h1>
<p>Skulle du vilja komma i kontakt med mig så når du mig på irc.bsnet.se nick: DanielJ 
eller så kan du maila mig på Danne_j87@hotmail.com</p>
<a href="mailto:danne_j87@hotmail.com">Kontakta mig &rarr;</a>
</section>
<div class="clear"></div>
<p class="center-text"> En sida av Daniel Johnsson, Student på BTH 2012-2013.</p>
        </div>

<p class="center-text">Tools: 
<a href="http://validator.w3.org/check/referer">html5</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">css3</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css21">css21</a>
<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">unicorn</a>
<a href="http://validator.w3.org/checklink?uri={$ly->request->current_url}">links</a>
<a href="http://qa-dev.w3.org/i18n-checker/index?async=false&amp;docAddr={$ly->request->current_url}">i18n</a>
<!-- <a href="link?">http-header</a> -->
<a href="http://csslint.net/">css-lint</a>
<a href="http://jslint.com/">js-lint</a>
<a href="http://jsperf.com/">js-perf</a>
<a href="http://www.workwithcolor.com/hsl-color-schemer-01.htm">colors</a>
<a href="http://dbwebb.se/style">style</a>
</p>

<p class="center-text">Docs:
<a href="http://www.w3.org/2009/cheatsheet">cheatsheet</a>
<a href="http://dev.w3.org/html5/spec/spec.html">html5</a>
<a href="http://www.w3.org/TR/CSS2">css2</a>
<a href="http://www.w3.org/Style/CSS/current-work#CSS3">css3</a>
<a href="http://php.net/manual/en/index.php">php</a>
<a href="http://www.sqlite.org/lang.html">sqlite</a>
<a href="http://www.blueprintcss.org/">blueprint</a>
</p>
EOD;

