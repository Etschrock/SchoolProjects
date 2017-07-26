<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: gallery_index.class.php
 * Date: April 23, 2017
 * Description: This is the page that will display the images from the gallery table
 */

class GalleryIndex extends GalleryIndexView {
    /*
     * the display method accepts an array of gallery objects and displays
     * them in a grid.
     */

    public function display($galleries) {
        //display page header
        parent::displayHeader("List All Images");
        ?>
        <div id="main-header"> Images</div>

        <div class="grid-container">
            <?php
            if ($galleries === 0) {
                echo "No Gallery was found.<br><br><br><br><br>";
            } else {
                //display images on a grid; six images per row
                foreach ($galleries as $i => $gallery) {
                    $id = $gallery->getId();
                    $name = $gallery->getName();
                    $image = $gallery->getImage();


                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GALLERY_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/gallery/detail/$id'><img src='" . $image .
                    "'></a>Taken By: $name</p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($galleries) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
            <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1) { ?>
                <p id="button-group">
                    <input type="button" id="edit-button" value="   Add Image   "
                           onclick="window.location.href = '<?= BASE_URL ?>/gallery/display'">&nbsp;
                </p> 
            <?php } ?>
        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
