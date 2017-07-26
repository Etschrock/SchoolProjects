<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: ticket_detail.class.php
 * Date: April 11, 2017
 * Description: This page displays the details of the ticket
 */

class TicketDetail extends TicketIndexView {

    public function display($ticket, $confirm = "") {
        //display page header
        parent::displayHeader("Display Ticket Details");

        //retrieve ticket details by calling get methods
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
            $image = BASE_URL . '/' . TICKET_IMG . $image;
        }
        ?>

        <div id="main-header">Ticket Details</div>
        <br>
        <!-- display ticket details in a table -->
        <table id="detail">
            <tr>

                <td style="width: 200px;">

                    <img id="btnBack" src="<?= $image ?>" alt="<?= $arrival_location ?>" />

                    <a class="backnav" href="<?= BASE_URL ?>/ticket/index">Back to ticket list</a>
                    <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1 && $_SESSION['role'] == 1) { ?>
                        <br><br><a class="backnav" href="<?= BASE_URL ?>/ticket/edit/<?= $id ?>">Edit</a>
                        </p> 
                    <?php } ?>
                </td>
                <td style="width: 200px;">
                    <p><strong>Depart Location:</strong></p>
                    <p><strong>Depart Time:</strong></p>
                    <p><strong>Arrival Location:</strong></p>
                    <p><strong>Arrival Time:</strong></p>
                    <p><strong>Gate:</strong></p>
                    <p><strong>Seat:</strong></p>
                    <p><strong>Class:</strong></p>
                    <p><strong>Price:</strong></p>

                </td>
                <td>
                    <p>Indianapolis</p>
                    <p><?= $depart_time ?></p>
                    <p><?= $arrival_location ?></p>
                    <p><?= $arrival_time ?></p>
                    <p><?= $gate ?></p>
                    <p><?= $seat ?></p>
                    <p><?= $class ?></p>
                    <p>$<?= $price ?></p>

                </td>
            </tr>
            <br>
            <div id="confirm-message"><?= $confirm ?></div>
        </table>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
