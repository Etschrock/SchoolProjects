<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: hotel_search.class.php
 * description: this is the search class for hotels
 */
class HotelSearch extends HotelIndexView {
    /*
     * the displays accepts an array of hotel objects and displays
     * them in a grid.
     */

    public function display($terms, $hotels) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div class="searchTerms"> Search Results for: <i><?= $terms . " " ?><?php
                echo ((!is_array($hotels)) ? "( 0 - 0 )" : "( 1 - " . count($hotels) . " )");
                ?></i></div>
        <br>
        <br>

        <!-- display all records in a grid -->
        <div class="grid-container">
            <?php
            if ($hotels === 0) {
                echo "No hotel was found.<br><br><br><br><br>";
            } else {
                //display hotels in a grid; six hotels per row
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
                    "'></a><span>$name<br> $city <br> Rating:$rating /5" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($hotels) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a class="searchTerms" class="backnav" href="<?= BASE_URL ?>/hotel/index">Go to hotel list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
