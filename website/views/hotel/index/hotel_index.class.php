<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: hotel_index.class.php
 * Date: April 10, 2017
 * Description: This is the page that will display the hotels
 */

class HotelIndex extends HotelIndexView {
    /*
     * the display method accepts an array of hotel objects and displays
     * them in a grid.
     */

    public function display($hotels) {
        //display page header
        parent::displayHeader("List All Hotels");
        ?>
        <div id="main-header"> Hotels</div>

        <div class="grid-container">
            <?php
            if ($hotels === 0) {
                echo "No hotel was found.<br><br><br><br><br>";
            } else {
                //display hotels on a grid; six hotels per row
                foreach ($hotels as $i => $hotel) {
                    $id = $hotel->getId();
                    $name = $hotel->getName();
                    $city = $hotel->getCity();
                    $rating = $hotel->getRating();
                    $price = $hotel->getPrice();
                    $numOfBeds = $hotel->getNum_of_beds();
                    $bedType = $hotel->getBed_type();
                    $image = $hotel->getImage();


                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . HOTEL_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/hotel/detail/$id'><img src='" . $image .
                    "'></a><span>$name<br> $city <br> Rating:" . " " . "$rating /5" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($hotels) - 1) {
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
