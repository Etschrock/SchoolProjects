<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: ticket.class.php
 * description: this is the class for the tickets
 */
class Ticket {

    //private members for ticket
    private $id, $price, $gate, $seat, $class, $depart_time, $arrival_location, $arrival_time, $image;

    public function __construct($price, $gate, $seat, $class, $depart_time, $arrival_location, $arrival_time, $image) {
        $this->price = $price;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->class = $class;
        $this->depart_time = $depart_time;
        $this->arrival_location = $arrival_location;
        $this->arrival_time = $arrival_time;
        $this->image = $image;
    }

    public function getId() {
        return $this->id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getGate() {
        return $this->gate;
    }

    public function getSeat() {
        return $this->seat;
    }

    public function getClass() {
        return $this->class;
    }

    public function getDepart_time() {
        return $this->depart_time;
    }

    public function getArrival_location() {
        return $this->arrival_location;
    }

    public function getArrival_time() {
        return $this->arrival_time;
    }

    public function getImage() {
        return $this->image;
    }

    //set ticket id
    public function setId($id) {
        $this->id = $id;
    }

}
