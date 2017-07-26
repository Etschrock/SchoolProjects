<?php

/*
 * Author: Daniel Neri
 * Date: 4/18/2017
 * Name: email_exception.class.php
 * Description: this class handles the email exception.
 */

// makes sure the email is in the correct format
Class EmailException extends Exception {

    public function getDetails() {
        return "Error: Please enter email.";
    }

}
