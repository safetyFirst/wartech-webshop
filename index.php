<?php
session_start();
require_once 'template.php';
require_once 'artikelanzeige.php';
require_once 'auth.php';
require_once 'cart.php';
require_once 'account.php';

$template = new Template();
$auth = new Auth();
$art = new ArtikelAnzeige();
$cart = new Cart();
$account = new Account();

?>
<!DOCTYPE html>
<html>
    <head>
        <?php $template->showHead(); $template->showWarenkorbHead(); $template->showAccountHead(); ?>
    </head>
    <body>
        <div id="container">
            <header>
                <?php $template->showHeader(); ?>
            </header>
            <menu>
                <?php $template->showMenu(); ?>
            </menu>
            <div id="content">                
                <?php
                if(isset($_GET["page"])){
                    if($_GET["page"] == ""){
                        $art->showArticles();
                    }else if(strcasecmp($_GET["page"], "cart") == 0){
                        $cart->showMaxiCart();
                    }else if(strcasecmp($_GET["page"], "account") == 0){
                        $account->showAccountSettings();
                    }
                }else {
                    $art->showArticles();
                    //echo "<span style='font-size: 10px; font-family: Arial;'> " . password_hash("tubebakito", PASSWORD_BCRYPT) . "</span>";
                }
                ?>
            </div>
            <footer>
                <?php $template->showFooter(); ?>
            </footer>
            <div id="notice"><?php echo Template::getNotice(); ?></div>
        </div>
    </body>
</html>