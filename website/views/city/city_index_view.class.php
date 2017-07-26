<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 12, 2017
 * Title: city_index_view.class.php
 * Description: this page has our search bar
 */
class CityIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "city";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/city/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search Cities" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}
