<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * title: hotel_controller.class.php
 * date: April 11, 2017
 * description: this is the controller for the hotel
 */

class HotelController {

    private $hotel_model;

    //default constructor
    public function __construct() {
        //create an instance of the HotelModel class
        $this->hotel_model = HotelModel::getHotelModel();
    }

    //index action that displays all hotels
    public function index() {
        try {
            //retrieves all hotels and store them in an array
            $hotels = $this->hotel_model->list_hotel();

            if (!$hotels) {
                throw new DatabaseException("There was a problem displaying hotels.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }

        //display all hotels
        $view = new HotelIndex();
        $view->display($hotels);
    }

    //show details of a hotel
    public function detail($id) {
        try {
            //retrieve the specific hotel
            $hotel = $this->hotel_model->view_hotel($id);

            if (!$hotel) {
                throw new DatabaseException("There was an problem displaying the hotel id='" . $id . "'. It does not Exist");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }

        //display hotel details
        $view = new HotelDetail();
        $view->display($hotel);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new HotelError();

        //display the error page
        $error->display($message);
    }

    //search hotels
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all hotels
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching hotels
        $hotels = $this->hotel_model->search_hotel($query_terms);

        if ($hotels === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched hotels
        $search = new HotelSearch();
        $search->display($query_terms, $hotels);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $hotels = $this->hotel_model->search_hotel($query_terms);

        //retrieve all hotel names and store them in an array
        $arrivalLocations = array();
        if ($hotels) {
            foreach ($hotels as $hotel) {
                $arrivalLocations[] = $hotel->getName();
            }
        }

        echo json_encode($arrivalLocations);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

    //display a hotel in a form for editing
    public function edit($id) {
        try {
            //retrieve the specific hotel
            $hotel = $this->hotel_model->view_hotel($id);

            if (!$hotel) {
                throw new DatabaseException("There was a problem displaying the hotel id='" . $id . "'. It does not Exist");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }
        $view = new HotelEdit();
        $view->display($hotel);
    }

// end of edit method
    //update a hotel in the database
    public function update($id) {
        try {
            //update the hotel
            $update = $this->hotel_model->update_hotel($id);
            if (!$update) {
                throw new DatabaseException("There was a problem updating the hotel id='" . $id . "'.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }

        //display the updateed hoteel details
        $confirm = "The hotel was successfully updated.";
        $hotel = $this->hotel_model->view_hotel($id);

        $view = new HotelDetail();
        $view->display($hotel, $confirm);
    }

}
