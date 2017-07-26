<?php
/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: city_detail.class.php
 * Date: April 11, 2017
 * Description: This page displays the details of the city
 */

class CityDetail extends CityIndexView {

    public function display($city, $confirm = "") {
        //display page header
        parent::displayHeader("Display City Details");

        //retrieve city details by calling get methods
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
        ?>

        <div id="main-header">City Details</div>
        <br>
        <!-- display city details in a table -->
        <table id="detail">

            <tr>
                <td style="width: 700px;">
                    <?php if (isset($_SESSION['fullname']) && $_SESSION['login_status'] == 1 && $_SESSION['role'] == 1) { ?>
                        <span id="button-group">
                            <input type="button" id="edit-button" value="   Edit   "
                                   onclick="window.location.href = '<?= BASE_URL ?>/city/edit/<?= $id ?>'">&nbsp;
                        </span> 
                    <?php } ?>
                    <h1 id="cityName"><?= $cityName ?></h1>

                    <img class="cityImg" src="<?= $cityImage ?>" alt="<?= $cityName ?>" style="width: 450px; height: 450px;" />
                    <p><strong><?= $cityDescription ?></strong></p><br>

                </td>
            </tr>
            <tr>
                <td style="width: 700px;">
                    <img class="cityImg" src="<?= $cityImage2 ?>" alt="<?= $cityImage2 ?>" style="width: 450px; height: 450px;" />
                    <p><?= $cityImageDescription2 ?></p><br>

                </td>
            </tr>
            <tr>
                <td style="width: 700px;">
                    <img class="cityImg" src="<?= $cityImage3 ?>" alt="<?= $cityImage3 ?>" style="width: 450px; height: 450px;"/>
                    <p><?= $cityImageDescription3 ?></p>
                </td>
            </tr>
            <tr>
                <td><a class="backnav" href="<?= BASE_URL ?>/city/index">Back to city list</a></td>
            </tr>
            <div id="confirm-message"><?= $confirm ?></div>
        </table>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
