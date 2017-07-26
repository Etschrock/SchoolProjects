<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: search.class.php
 * Description: this script defines the SearchTicket class. The class contains a method named display, which
 *     accepts an array of Ticket objects and displays them in a grid.
 */

class TicketSearch extends TicketIndexView {
    /*
     * the displays accepts an array of ticket objects and displays
     * them in a grid.
     */

    public function display($terms, $tickets) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div class="searchTerms"> Search Results for: <i><?= $terms . " " ?><?php
                echo ((!is_array($tickets)) ? "( 0 - 0 )" : "( 1 - " . count($tickets) . " )");
                ?></i>
        </div>
        <br>
        <br>
        <!-- display all records in a grid -->
        <div class="grid-container">
            <?php
            if ($tickets === 0) {
                echo "No ticket was found.<br><br><br><br><br>";
            } else {
                //display tickets in a grid; six tickets per row
                foreach ($tickets as $i => $ticket) {
                    $id = $ticket->getId();
                    $price = $ticket->getPrice();
                    $gate = $ticket->getGate();
                    $seat = $ticket->getSeat();
                    $class = $ticket->getClass();
                    $depart_time = $ticket->getDepart_time();
                    $arrival_location = $ticket->getArrival_location();
                    $arrival_time = $ticket->getArrival_time();
                    $image = $ticket->getImage();


                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . TICKET_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/ticket/detail/$id'><img src='" . $image .
                    "'></a><span>TO: $arrival_location<br> $depart_time" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($tickets) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a class="searchTerms" class="backnav"  href="<?= BASE_URL ?>/ticket/index">Go to ticket list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
