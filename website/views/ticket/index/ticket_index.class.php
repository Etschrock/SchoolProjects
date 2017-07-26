<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: ticket_index.class.php
 * Date: April 10, 2017
 * Description: This is the page that will display the tickets
 */

class TicketIndex extends TicketIndexView {
    /*
     * the display method accepts an array of ticket objects and displays
     * them in a grid.
     */

    public function display($tickets) {
        //display page header
        parent::displayHeader("List All Tickets");
        ?>
        <div id="main-header"> Tickets</div>

        <div class="grid-container">
            <?php
            if ($tickets === 0) {
                echo "No ticket was found.<br><br><br><br><br>";
            } else {
                //display tickets on a grid; six tickets per row
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

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
