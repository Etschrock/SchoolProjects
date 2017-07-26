<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: new_user.class.php
 * description: this is the new user class
 */
class NewUser extends UserIndexView {

    //function to be called when a user finishes registering with the site
    public function display($user) {
        parent::displayHeader("User Successfully Added");
        ?>
        <div class="centerText">
            <h2>User Successfully Added</h2>
            <p>The user has been successfully registered to the website. Thank you for joining us.</p>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
