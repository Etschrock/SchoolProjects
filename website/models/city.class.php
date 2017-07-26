<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: city.class.php
 * description: this is the class for the cities
 */
class City {

    //private members for city
    private $cityID, $city, $city_description, $city_image, $city_image_description, $city_image2, $city_image_description2, $city_image3, $city_image_description3;

    public function __construct($city, $city_description, $city_image, $city_image_description, $city_image2, $city_image_description2, $city_image3, $city_image_description3) {
        $this->city = $city;
        $this->city_description = $city_description;
        $this->city_image = $city_image;
        $this->city_image_description = $city_image_description;
        $this->city_image2 = $city_image2;
        $this->city_image_description2 = $city_image_description2;
        $this->city_image3 = $city_image3;
        $this->city_image_description3 = $city_image_description3;
    }

    public function getCityID() {
        return $this->cityID;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCity_description() {
        return $this->city_description;
    }

    public function getCity_image() {
        return $this->city_image;
    }

    public function getCity_image_description() {
        return $this->city_image_description;
    }

    public function getCity_image2() {
        return $this->city_image2;
    }

    public function getCity_image_description2() {
        return $this->city_image_description2;
    }

    public function getCity_image3() {
        return $this->city_image3;
    }

    public function getCity_image_description3() {
        return $this->city_image_description3;
    }

    //set city id
    public function setId($id) {
        $this->cityID = $id;
    }

}
