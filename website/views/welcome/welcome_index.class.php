<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: welcome_index.class.php
 * Date: April 10th, 2017
 * Description: The welcome_index.class.php
 */

class WelcomeIndex extends IndexView {

    public function display() {
        //display page header
        parent::displayHeader("Welcome to TraveLogic");
        ?>   
        <div id="banner" class="container">
            <div class="title">
                <h2>Come Travel the World with Us</h2>
                <span class="byline">There are thousands of places waiting for to be discovered</span>
            </div>
        </div>
        </div>
        <div id="wrapper">
            <div id="three-column" class="container">
                <div class="title">
                    <h2>Your ticket to all the best cities awaits...</h2>
                    <span class="byline">This site offers plane tickets and travel packages</span>
                </div>
                <div class="boxA">
                    <p></p>
                    <a href="<?= BASE_URL ?>/ticket/index" class="button button-alt">Plane Tickets</a>
                </div>
                <div class="boxB">
                    <p></p>
                    <a href="<?= BASE_URL ?>/hotel/index" class="button button-alt">Hotels</a>
                </div>
                <div class="boxC">
                    <p></p>
                    <a href="<?= BASE_URL ?>/city/index" class="button button-alt">City Information</a>
                </div>
            </div>
        </div>
        <div id="welcome">
            <div class="container">
                <div class="title">
                    <h2>Would you like to share your travel experiences?</h2>
                    <span class="byline">We want to see all your amazing travels! Click below to submit your pictures!</span>
                </div>
                <ul class="actions">
                    <li><a href="<?= BASE_URL ?>/gallery/index" class="button">Upload a new photo</a></li>
                </ul>
            </div>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

}
