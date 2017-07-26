<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: city_search.class.php
 * description: this is the class for the cities
 */
class CitySearch extends CityIndexView {
    /*
     * the displays accepts an array of city objects and displays
     * them in a grid.
     */

    public function display($terms, $cities) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div class="searchTerms"> Search Results for: <i><?= $terms . " " ?></i>            <?php
            echo ((!is_array($cities)) ? "( 0 - 0 )" : "( 1 - " . count($cities) . " )");
            ?></div>
        <span class="rcd-numbers">
        </span>
        <br>
        <br>

        <!-- display all records in a grid -->
        <div class="grid-container">
            <?php
            if ($cities === 0) {
                echo "No city was found.<br><br><br><br><br>";
            } else {
                //display cities in a grid; six cities per row
                foreach ($cities as $i => $city) {
                    $id = $city->getcityID();
                    $cityName = $city->getCity();
                    $cityDescription = $city->getCity_description();
                    $cityImage = $city->getCity_image();
                    $cityImageDescription = $city->getCity_image_description();
                    $cityImage2 = $city->getCity_image2();
                    $cityImageDescription2 = $city->getCity_image_description2();
                    $cityImage3 = $city->getCity_image3();
                    $cityImageDescription3 = $city->getCity_image_description3();



                    if (strpos($cityImage, "http://") === false AND strpos($cityImage, "https://") === false) {
                        $cityImage = BASE_URL . "/" . CITY_IMG . $cityImage3;
                    }
                    if (strpos($cityImage2, "http://") === false AND strpos($cityImage2, "https://") === false) {
                        $cityImage2 = BASE_URL . "/" . CITY_IMG . $cityImage2;
                    }
                    if (strpos($cityImage3, "http://") === false AND strpos($cityImage3, "https://") === false) {
                        $cityImage3 = BASE_URL . "/" . CITY_IMG . $cityImage3;
                    }

                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/city/detail/$id'><img src='" . $cityImage .
                    "'></a><span>$cityName" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($cities) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a class="searchTerms" class="backnav" href="<?= BASE_URL ?>/city/index">Go to city list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
