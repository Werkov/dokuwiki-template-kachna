<?php
if (!defined('DOKU_INC'))
    die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__) . '/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT == 'show');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="robots" content="{$robots}" n:ifset="$robots">

        <title><?php tpl_pagetitle() ?> | <?php echo strip_tags($conf['title']) ?></title>

        <?php tpl_metaheaders() ?>	
        <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    </head>

    <body>
        <script> document.body.className += ' js'</script>

        <div class="wrapper <?php echo tpl_classes(); ?>">
            <div id="header">                
                <h2><a n:href="Homepage:, volumeId => null" title="Kachna &ndash; letní šifrovací tah">Kachna</a></h2>

                <ul class="volume-navigation">
                    <li><a href="Homepage:">TODO</a></li>                    
                </ul>

                <ul class="user-navigation">
                    <?php
                    if (!empty($_SERVER['REMOTE_USER'])) {
                        echo '<li class="user">';
                        tpl_userinfo(); /* 'Logged in as ...' */
                        echo '</li>';
                    }
                    ?>
                    <?php
                    _tpl_toolsevent('usertools', array(
                        'admin' => tpl_action('admin', 1, 'li', 1),
                        'userpage' => _tpl_action('userpage', 1, 'li', 1),
                        'profile' => tpl_action('profile', 1, 'li', 1),
                        'register' => tpl_action('register', 1, 'li', 1),
                        'login' => tpl_action('login', 1, 'li', 1),
                    ));
                    ?>
                </ul>
            </div>
        </div>

        <div class="wrapper">
            <!-- MENU -->
            <div id="menu">
                <ul id="general-navigation">
                    <li><a n:href="Content:rules">Pravidla</a></li>
                    <li><a n:href="Content:program">Program</a></li>
                    <li><a n:href="Content:information">Informace</a></li>
                    <li><a n:href="Forum:">Fórum</a></li>
                    <li><a n:href="Team:list">Týmy</a></li>
                    <li n:if="$presenter->currentVolume->isAfterGame()"><a n:href="Content:results">Výsledky</a></li>
                    <li n:if="$presenter->currentVolume->isAfterGame()"><a n:href="Content:problems">Šifry</a></li>
                    <li n:if="$presenter->currentVolume->isAfterGame()"><a n:href="Team:after">Fotky a reportáže</a></li>

                    <?php
                    _tpl_toolsevent('pagetools', array(
                        'edit' => tpl_action('edit', 1, 'li', 1),
                        'discussion' => _tpl_action('discussion', 1, 'li', 1),
                        'revisions' => tpl_action('revisions', 1, 'li', 1),
                        'backlink' => tpl_action('backlink', 1, 'li', 1),
                        'subscribe' => tpl_action('subscribe', 1, 'li', 1),
                        'revert' => tpl_action('revert', 1, 'li', 1),
                        'top' => tpl_action('top', 1, 'li', 1),
                    ));
                    ?>
                </ul>
            </div>
            <!-- CONTENT -->
            <div id="content">                
                <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
                <?php tpl_flush() /* flush the output buffer */ ?>
                <?php tpl_content() /* the main content */ ?>
                <?php tpl_flush() /* flush the output buffer */ ?>
            </div>
        </div>
        <div id="footer">
            Kachnu pořádá tým <a href="http://bazinga.sifruje.cz/">Bazinga</a>.
        </div>


        <!--<script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-31652186-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>-->
    </body>
</html>
