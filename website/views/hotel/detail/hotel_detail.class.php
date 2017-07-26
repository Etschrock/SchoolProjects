<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: hotel_detail.class.php
 * Date: April 11, 2017
 * Description: This page displays the details of the hotel
 */

class HotelDetail extends HotelIndexView {

    public function display($hotel, $confirm = "") {
        //display page header
        parent::displayHeader("Display Hotel Details");

        //retrieve hotel details by calling get methods
        $id = $hotel->getId();
        $name = $hotel->getName();
        $city = $hotel->getCity();
        $rating = $hotel->getRating();
        $price = $hotel->getPrice();
        $numOfBeds = $hotel->getNum_of_beds();
        $bedType = $hotel->getBed_type();
        $image = $hotel->getImage();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . HOTEL_IMG . $image;
        }
        ?>

        <div id="main-header">Hotel Details</div>
        <br>
        <!-- display hotel details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 200px;">
                    <img id="btnBack" src="<?= $image ?>" alt="<?= $name ?>" />
                    <a class="backnav" href="<?= BASE_URL ?>/hotel/index">Back to hotel list</a>
                    <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1 && $_SESSION['role'] == 1) { ?>
                        <br><br><a class="backnav" href="<?= BASE_URL ?>/hotel/edit/<?= $id ?>">Edit</a>
                    <?php } ?>
                </td>
                <td style="width: 200px;">
                    <p><strong>Hotel Name:</strong></p>
                    <p><strong>City:</strong></p>
                    <p><strong>Price:</strong></p>
                    <p><strong>Rating:</strong></p>
                    <p><strong>Number of Beds:</strong></p>
                    <p><strong>Bed Type:</strong></p>
                </td>
            <div id="confirm-message"><?= $confirm ?></div>
            <td> 
                <p><?= $name ?></p>
                <p><?= $city ?></p>
                <p><?= "$" . $price ?></p>
                <p><?= $rating ?> out of 5</p>
                <p><?= $numOfBeds ?></p>
                <p><?= $bedType ?></p>

            </td>
        </tr>
        </table>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
