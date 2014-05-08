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

        <title><?php tpl_pagetitle() ?> | <?php echo strip_tags($conf['title']) ?></title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <?php tpl_metaheaders() ?>	
        <?php echo tpl_favicon(array('favicon')) ?>
    </head>

    <body>
        <div id="container"  class="<?php echo tpl_classes(); ?>">
            <div id="header">
                <h2><?php tpl_link(wl(), $conf['title']) ?></h2>
                <div id="volume-navigation">
                    <?php tpl_include_page(tpl_getConf('years'), 1, 1) ?>
                </div>

                <ul id="user-navigation">
                    <?php
                    _tpl_toolsevent('usertools', array(
                        'admin' => tpl_action('admin', 1, 'li', 1),
                        'profile' => tpl_action('profile', 1, 'li', 1),
                        'register' => tpl_action('register', 1, 'li', 1),
                        'login' => tpl_action('login', 1, 'li', 1),
                    ));
                    ?>
                </ul>
                <div class="clearer"></div>                
            </div>
            <?php if ($showSidebar) { ?>
                <div id="left-column">
                    <nav id="navigation">
                        <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                    </nav>
                </div>
            <?php } ?>
            <div id="content"<?php if (!$showSidebar) { ?>class="full"<?php } ?>>
                <a href="#navigation" id="toggle">Menu</a>
                <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
                <?php tpl_flush() /* flush the output buffer */ ?>
                <?php tpl_content() /* the main content */ ?>
                <?php tpl_flush() /* flush the output buffer */ ?>
            </div>
            <div id="right-column">
                <?php if ($showTools) { ?>
                    <ul id="pagetools">
                        <?php
                        _tpl_toolsevent('pagetools', array(
                            'edit' => tpl_action('edit', 1, 'li', 1, '', '', 'E'),
                            'revisions' => tpl_action('revisions', 1, 'li', 1, '', '', 'H'),
                            'backlink' => tpl_action('backlink', 1, 'li', 1, '', '', 'B'),
                        ));
                        ?>
                    </ul>
                <?php } ?>
            </div>
            <div id="footer">
                Kachnu pořádá tým <a href="http://bazinga.sifruje.cz/">Bazinga</a>.
            </div>
        </div>



        <?php if ($gaCode = $conf['gaCode']) { ?>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo $gaCode ?>']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();

            </script>
        <?php } ?>
    </body>
</html>
