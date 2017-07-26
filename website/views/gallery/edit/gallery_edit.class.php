<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: gallery_edit.class.php
 * Date: April 23, 2017
 * Description: This file will allow admin to update images in the gallery
 */

class GalleryEdit extends GalleryIndexView {

    public function display($gallery) {
        //display page header
        parent::displayHeader("Edit Image");

        //retrieve gallery details by calling get methods
        $id = $gallery->getId();
        $name = $gallery->getName();
        $image = $gallery->getImage();
        ?>

        <div id="main-header">Edit Image Details</div>

        <!-- display image details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/gallery/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Name</strong></p>
            <input name="name" type="text" size="40" value="<?= $name ?>" required="" readonly=""></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="url" size="100" required value="<?= $image ?>"></p>
            <input type="submit" name="action" value="Update Image">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/gallery/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
