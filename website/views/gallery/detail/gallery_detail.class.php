<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: gallery_detail.class.php
 * Date: April 23, 2017
 * Description: This page displays the details of the images
 */

class GalleryDetail extends GalleryIndexView {

    public function display($gallery, $confirm = "") {
        //display page header
        parent::displayHeader("Display Image Details");

        //retrieve image details by calling get methods
        $id = $gallery->getId();
        $name = $gallery->getName();
        $image = $gallery->getImage();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GALLERY_IMG . $image;
        }
        ?>

        <div id="main-header">Image Details</div>
        <br>
        <!-- display image details in a table -->
        <table id="detail">
            <tr>

                <td style="width: 200px;">

                    <img id="btnBack" src="<?= $image ?>" alt="<?= $arrival_location ?>" />

                    <a class="backnav" href="<?= BASE_URL ?>/gallery/index">Back to the Gallery</a>
                    <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1 && $_SESSION['role'] == 1) { ?>
                        <br><br><a class="backnav" href="<?= BASE_URL ?>/gallery/edit/<?= $id ?>">Edit</a>
                    <?php } ?>
                </td>
                <td style="width: 200px;">
                    <p>Taken By:</p>
                    <p>Image:</p>
                </td>
                <td>
                    <p><?= $name ?></p>
                    <p><?= $image ?></p>
                </td>
            </tr>
            <tr>
            <div id="confirm-message"><?= $confirm ?></div>
        </tr>
        </table>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
