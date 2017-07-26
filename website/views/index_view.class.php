<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: index_view.class.php
 * Date: April 11, 2017
 * Description: this is the index_view.class.php
 */

class IndexView {

    //this method displays the page header
    static public function displayHeader($page_title) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $page_title ?></title>
                <meta name="keywords" content="" />
                <meta name="description" content="" />
                <link href="<?= BASE_URL ?>/www/css/style.css" rel="stylesheet" type="text/css" media="all"/>
                <script>
                    //create the JavaScript variable for the base url
                    var base_url = "<?= BASE_URL ?>";
                </script>
            </head>
            <body>
                <div id="header-wrapper">
                    <div id="header" class="container">
                        <div id="logo" >

                            <!--will fix later
                            <img src="../www/img/logo.jpg" alt="">
                            -->

                            <h1><a href="<?= BASE_URL ?>/index.php">TraveLogic</a></h1>
                        </div>
                        <div id="menu">
                            <ul>
                                <li><a href="<?= BASE_URL ?>/index.php" accesskey="1" title="">Homepage</a></li>
                                <li><a href="<?= BASE_URL ?>/hotel/index" accesskey="3" title="">Hotels</a></li>
                                <li><a href="<?= BASE_URL ?>/city/index" accesskey="3" title="">Cities</a></li>
                                <li><a href="<?= BASE_URL ?>/ticket/index" accesskey="4" title="">Tickets</a></li>
                                <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1) { ?>
                                    <li><a href="<?= BASE_URL ?>/user/sign_out">Sign Out</a> &nbsp; Welcome, <?= $_SESSION['fullname'] ?>!</li> 
                                <?php } else { ?>
                                    <li><a href="<?= BASE_URL ?>/user/index">Login/Sign-up</a></li> 
                                <?php } ?> 
                            </ul>
                        </div>
                    </div>

                    <?php
                }

//end of displayHeader function
                //this method displays the page footer
                public static function displayFooter() {
                    ?>

                    <div id="copyright" class="container">
                        <p>&copy; TraveLogic 2017 | <a href="#">Contact Us</a> | <a href="#">Join Our Team</a>.</p>
                    </div>
                    <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
            </body>
        </html>
        <?php
    }

//end of displayFooter function
}
