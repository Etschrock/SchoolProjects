<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: ticket_edit.class.php
 * description: this is the edit page for tickets
 */
class TicketEdit extends TicketIndexView {

    public function display($ticket) {
        //display page header
        parent::displayHeader("Edit Ticket");

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
        ?>

        <div id="main-header">Edit Ticket Details</div>

        <!-- display ticket details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/ticket/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Depart Location</strong>:<br>
                <input name="depart_location" type="text" size="100" value="Indianapolis" required autofocus readonly=""></p>
            <p><strong>Depart Time</strong>:
                <input name="depart_time" type="text" size="100" value="<?= $depart_time ?>" ></p>
            <p><strong>Arrival Location</strong>: <input name="arrival_location" type="text" value="<?= $arrival_location
        ?>" required=""></p>
            <p><strong>Arrival Time</strong>:<br>
                <input name="arrival_time" type="text" size="40" value="<?= $arrival_time ?>" ></p>
            <p><strong>Gate</strong>:<br>
                <input name="gate" type="text" size="40" value="<?= $gate ?>" ></p>
            <p><strong>Seat</strong>:<br>
                <input name="seat" type="text" size="40" value="<?= $seat ?>" ></p>
            <p><strong>Class</strong>:<br>
                <input name="class" type="text" size="40" value="<?= $class ?>" ></p>
            <p><strong>Price</strong>:<br>
                <input name="price" type="text" size="40" value="<?= $price ?>"></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" value="<?= $image ?>"></p>
            <input type="submit" name="action" value="Update Ticket">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/ticket/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
