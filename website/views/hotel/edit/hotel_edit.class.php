<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: hotel_edit.class.php
 * description: this is the edit page for hotels
 */
class HotelEdit extends HotelIndexView {

    public function display($hotel) {
        //display page header
        parent::displayHeader("Edit Hotel");

        //retrieve hotel details by calling get methods
        $id = $hotel->getId();
        $name = $hotel->getName();
        $city = $hotel->getCity();
        $rating = $hotel->getRating();
        $price = $hotel->getPrice();
        $numOfBeds = $hotel->getNum_of_beds();
        $bedType = $hotel->getBed_type();
        $image = $hotel->getImage();
        ?>

        <div id="main-header">Edit Hotel Details</div>

        <!-- display hotel details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/hotel/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Hotel Name</strong>:
                <input name="name" type="text" size="100" value="<?= $name ?>" ></p>
            <p><strong>City</strong>: <input name="city" type="text" value="<?= $city
        ?>"></p>
            <p><strong>Price</strong>:<br>
                <input name="price" type="text" size="40" value="<?= $price ?>" ></p>
            <p><strong>Rating</strong>:<br>
                <input name="rating" type="number" size="5" value="<?= $rating ?>" ></p>
            <p><strong>Number of Beds</strong>:<br>
                <input name="numOfBeds" type="number" size="5" value="<?= $numOfBeds ?>" ></p>
            <p><strong>Bed Type</strong>:<br>
                <input name="bedType" type="text" size="40" value="<?= $bedType ?>" ></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" value="<?= $image ?>"></p>
            <input type="submit" name="action" value="Update Hotel">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/hotel/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
