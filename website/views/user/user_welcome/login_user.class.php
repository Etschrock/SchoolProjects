<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: login_user.class.php
 * description: this is the class for the hotels
 */
class LoginUser extends UserIndexView {

    //function to be called when a user logs in
    public function display($user) {
        parent::displayHeader("Welcome Back to our website");
        ?>
        <div class="centerText">
            <h2>Welcome Back!</h2>
            <p><?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1) echo "Hello, " . $_SESSION['fullname'] . "!"; ?></p>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
