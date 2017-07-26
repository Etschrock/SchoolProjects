<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 23, 2017
 * Title: gallery_add.class.php
 * Description: this is the page where users can add images
 */

class GalleryAdd extends GalleryIndexView {

    //put your code here
    public function display() {
        parent::displayHeader("Add a New Image");
        ?>
        <div id="addImage">
            <form id="galleryAdd" action='<?= BASE_URL ?>/gallery/add' method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?= $_SESSION['fullname'] ?>" readonly=""/>
                <br>
                <label for="image">Image:</label>
                <input name="image"/>
                <br>
                <button id="addButton" href="<?= BASE_URL ?>/gallery/confirmation">Add Image</button>
                <a class="backnav" href='<?= BASE_URL ?>/gallery/index'>Back to the Gallery</a>
            </form>
        </div>
        <?php
    }

}
