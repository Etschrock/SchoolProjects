<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: city_edit.class.php
 * description: this is the city_edit class
 */
class CityEdit extends CityIndexView {

    public function display($city) {
        //display page header
        parent::displayHeader("Edit City");

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
        ?>

        <div id="main-header">Edit City Details</div>

        <!-- display city details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/city/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>City Name</strong>:<br>
                <input name="cityName" type="text" size="100" value="<?= $cityName ?>"></p>
            <p><strong>City Description</strong>:<br>
                <textarea name="cityDescription" rows="8" cols="100" ><?= $cityDescription ?></textarea></p>
            <p><strong>City Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="cityImage" type="text" size="100"  value="<?= $cityImage ?>"></p>
            <p><strong>City Image Description</strong>:<br>
                <textarea name="cityImageDescription" rows="8" cols="100" value><?= $cityImageDescription ?></textarea></p>
            <p><strong>City Image 2</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="cityImage2" type="text" size="100" value="<?= $cityImage2 ?>"></p>
            <p><strong>City Image Description 2</strong>:<br>
                <textarea name="cityImageDescription2" rows="8" cols="100" value><?= $cityImageDescription2 ?></textarea></p>
            <p><strong>City Image 3</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="cityImage3" type="text" size="100" value="<?= $cityImage3 ?>"></p>
            <p><strong>City Image Description 3</strong>:<br>
                <textarea name="cityImageDescription3" rows="8" cols="100" value><?= $cityImageDescription3 ?></textarea></p>
            <input type="submit" name="action" value="Update City">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/city/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
