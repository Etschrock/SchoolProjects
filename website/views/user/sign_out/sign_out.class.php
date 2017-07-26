<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: sign_out.class.php
 * description: this is the sign out class for users
 */
class SignOut extends UserIndexView {

    //function to be called when a user signs out
    public function display() {
        parent::displayHeader("Sign Out");
        ?>
        <h2>Sign Out</h2>
        <p>You have been successfully signed out. Come back soon!</p>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
