<?php
/*
 * Author: Eric Schrock
 * Title: image_added.class.php
 * Date: April 23, 2017
 * Description: This is the confirmation page that your image was added
 */

class ImageAdded extends UserIndexView {

    public function display() {
        parent::displayHeader("Image Successfully Added");
        ?>
        <div class="centerText">
            <h2>Image Added</h2>
            <p>Your image has been added! Thanks for sharing!.</p>
            <a class="backnav" href="<?= BASE_URL ?>/gallery/index">Back to the Gallery</a>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
