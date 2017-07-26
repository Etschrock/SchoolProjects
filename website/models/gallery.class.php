<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 22 2017
 * Title: gallery.class.php
 * Description: This is the gallery class
 */
class Gallery {

    //private attributes
    private $id, $name, $image;

    //construct
    public function __construct($name, $image) {
        $this->name = $name;
        $this->image = $image;
    }

    //public get methods
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    //setter for the id
    public function setId($id) {
        $this->id = $id;
    }

}
