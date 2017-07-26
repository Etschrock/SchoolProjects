<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 12, 2017
 * Title: ticket_index_view.class.php
 * Description: this page has our search bar
 */
class TicketIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "ticket";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/ticket/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search Flights" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input id="searchInput" type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}
