<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: city.class.php
 * description: this is the class for the hotels
 */
class Hotel {

    //private members for hotel
    private $id, $name, $city, $rating, $price, $num_of_beds, $bed_type, $image;

    public function __construct($name, $city, $rating, $price, $num_of_beds, $bed_type, $image) {
        $this->name = $name;
        $this->city = $city;
        $this->rating = $rating;
        $this->price = $price;
        $this->num_of_beds = $num_of_beds;
        $this->bed_type = $bed_type;
        $this->image = $image;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCity() {
        return $this->city;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getNum_of_beds() {
        return $this->num_of_beds;
    }

    public function getBed_type() {
        return $this->bed_type;
    }

    public function getImage() {
        return $this->image;
    }

    //set city id
    public function setId($id) {
        $this->id = $id;
    }

}
