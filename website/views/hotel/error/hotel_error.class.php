<?php
/*
 * Author: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: hotel_error.class.php
 * Date: April 9, 2017
 * Description: This is the error class
 */

class HotelError extends HotelIndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>

        <div id="main-header">Error</div>
        <hr>
        <table style="width: 100%; border: none">
            <tr>
                <td style="vertical-align: middle; text-align: center; width:100px">
                    <img src='<?= BASE_URL ?>/www/img/error.jpg' style="width: 80px; border: none"/>
                </td>
                <td style="text-align: left; vertical-align: top;">
                    <div style="background: #111; width: 650px;">
                        <h3> Sorry, but an error has occurred.</h3>
                        <div style="color: red; font-weight: bold;">
                            <?= urldecode($message) ?>
                        </div>
                        <br>
                        </td>
                        </tr>
                        </table>
                        <br><br><br><br><hr>
                        <a class="backnav" href="<?= BASE_URL ?>/hotel/index">Back to hotel list</a>
                        <?php
                        //display page footer
                        parent::displayFooter();
                    }

                }
                