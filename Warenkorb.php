<?php
session_start();
require_once 'template.php';
require_once 'artikelanzeige.php';
require_once 'auth.php';
require_once 'cart.php';

$template = new Template();
$art = new ArtikelAnzeige();
$cart = new Cart();
$auth = new Auth();
$auth->loginLogout();
$auth->register();
$cart->cartFunctions();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $template->getHead(); $template->getWarenkorbHead(); ?>
    </head>
    <body>
        <div id="container">
            <header>
                <?php $template->getHeader(); ?>
            </header>
            <menu>
                <?php $template->getMenu(); ?>
            </menu>
            <div id="content">                
                <?php $cart->showMaxiCart(); ?>
            </div>
            <footer>
                <?php $template->getFooter(); ?>
            </footer>
            <div id="notice"><?php echo $template->getNotice(); ?></div>
        </div>
    </body>
</html>