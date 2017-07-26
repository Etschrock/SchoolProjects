<?php

/*
  Author: Daniel Neri
  Date: 4/18/2017
  Name: data_type_excpetion.class.php
  Description: handles data type exceptions
 */

class DataTypeException extends Exception {

    public function __construct($in_type, $in_expected) {
        parent::__construct("Data type error:<br>"
                . "Expected: $in_expected<br>"
                . "Receive: $in_type");
    }

}
