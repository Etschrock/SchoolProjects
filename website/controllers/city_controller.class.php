<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * title: city_controller.class.php
 * date: April 11, 2017
 * description: this is the controller for the cities
 */

class CityController {

    private $city_model;

    //default constructor
    public function __construct() {
        //create an instance of the CityModel class
        $this->city_model = CityModel::getCityModel();
    }

    //index action that displays all cities
    public function index() {
        try {
            //retrieves all cities and store them in an array
            $cities = $this->city_model->list_city();

            if (!$cities) {

                throw new DatabaseException("There was a problem displaying cities.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        }

        //display all cities
        $view = new CityIndex();
        $view->display($cities);
    }

    //show details of a city
    public function detail($id) {
        try {
            //retrieve the specific city
            $city = $this->city_model->view_city($id);

            if (!$city) {

                throw new DatabaseException("There was a problem displaying the city id='" . $id . "'.It does not Exist");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        }

        //display city details
        $view = new CityDetail();
        $view->display($city);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new CityError();

        //display the error page
        $error->display($message);
    }

    //search cities
    public function search() {
        try {
            //retrieve query terms from search form
            $query_terms = trim($_GET['query-terms']);

            //if search term is empty, list all cities
            if ($query_terms == "") {
                $this->index();
            }

            //search the database for matching cities
            $cities = $this->city_model->search_city($query_terms);

            if ($cities === false) {
                throw new DatabaseException("An error has occurred. No matching cities were found.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        }
        //display matched cities
        $search = new CitySearch();
        $search->display($query_terms, $cities);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $cities = $this->city_model->search_city($query_terms);

        //retrieve all movie titles and store them in an array
        $arrivalLocations = array();
        if ($cities) {
            foreach ($cities as $city) {
                $arrivalLocations[] = $city->getCity();
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

    //display a city in a form for editing
    public function edit($id) {
        try {
            //retrieve the specific city
            $city = $this->city_model->view_city($id);

            if (!$city) {
                throw new DatabaseException("There was a problem displaying the city id='" . $id . "'. It does not Exist");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        }

        $view = new CityEdit();
        $view->display($city);
    }

// end of edit method
    //update a city in the database
    public function update($id) {
        try {
            //update the city
            $update = $this->city_model->update_city($id);
            if (!$update) {
                throw new DatabaseException("There was a problem updating the city id='" . $id . "'.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new CityError();
            $view->display($message);
            exit();
        }

        //display the updateed city details
        $confirm = "The city was successfully updated.";
        $city = $this->city_model->view_city($id);

        $view = new CityDetail();
        $view->display($city, $confirm);
    }

}
