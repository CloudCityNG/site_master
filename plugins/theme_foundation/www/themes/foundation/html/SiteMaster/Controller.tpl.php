<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="<?php echo \SiteMaster\Config::get('URL') ?>plugins/theme_foundation/www/themes/foundation/html/css/foundation.css" />
    <script src="<?php echo \SiteMaster\Config::get('URL') ?>plugins/theme_foundation/www/themes/foundation/html/js/modernizr.js"></script>
</head>
<body>
<nav class="top-bar" data-topbar>
    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo \SiteMaster\Config::get('URL')?>">Site Master</a></h1>
        </li>
    </ul>
    <section class="top-bar-section">
        <!-- Left Nav Section -->
        <ul class="left">
            <?php
            $mainNav = \SiteMaster\Plugin\PluginManager::getManager()->dispatchEvent(
                \SiteMaster\Events\Navigation\MainCompile::EVENT_NAME,
                new \SiteMaster\Events\Navigation\MainCompile()
            );

            echo $savvy->render($mainNav);
            ?>
        </ul>
        <!-- Right Nav Section -->
        <ul class="right">
            <li class="has-dropdown">
                <?php
                if ($user = \SiteMaster\User\Session::getCurrentUser()) {
                    $logoutURL = \SiteMaster\Config::get('URL') . 'logout/';
                    if ($authPlugin = $user->getAuthenticationPlugin()) {
                        $logoutURL = $authPlugin->getLogoutURL();
                    }
                    ?>
                    <a href="#"><?php echo $user->first_name ?></a>
                    <ul class="dropdown">
                        <li>
                            <a href="<?php echo \SiteMaster\Config::get('URL') ?>user/settings/">Settings</a>
                            <a href="<?php echo $logoutURL ?>">Log Out</a>
                        </li>
                    </ul>
                     <?php
                } else {
                    ?>
                    <a href="#">Login</a>
                    <ul class="dropdown">
                        <li>
                            <?php
                            $authPlugins = \Sitemaster\Plugin\PluginManager::getManager()->getAuthPlugins();
                            
                            foreach ($authPlugins as $plugin) {
                                ?>
                                <a href="<?php echo $plugin->getLoginURL(); ?>"><?php echo $plugin->getProviderHumanName() ?></a>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </li>
        </ul>
    </section>
</nav>


<div class="row">
    <div class="large-12 columns">
        <h1><?php echo $context->output->getPageTitle() ?></h1>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <?php
        echo $savvy->render($context->output);
        ?>
    </div>
</div>


<script src="<?php echo \SiteMaster\Config::get('URL') ?>plugins/theme_foundation/www/themes/foundation/html/js/jquery.js"></script>
<script src="<?php echo \SiteMaster\Config::get('URL') ?>plugins/theme_foundation/www/themes/foundation/html/js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>