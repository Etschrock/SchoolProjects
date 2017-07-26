<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 23, 2017
 * Title: gallery_index_view.class.php
 * Description: this page has our search bar
 */
class GalleryIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "gallery";
        </script>
        <?php

    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}
