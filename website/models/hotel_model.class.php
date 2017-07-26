<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: hotel_model.class.php
 * Date: April 11, 2017
 * Description: this is the hotel model
 */
class HotelModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblHotel;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getHotelModel method must be called.
    private function __construct() {
        session_start();
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblHotel = $this->db->getHotelTable();


        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one HotelModel instance
    public static function getHotelModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new HotelModel();
        }
        return self::$_instance;
    }

    /*
     * the list_hotel method retrieves all hotels from the database and
     * returns an array of Hotel objects if successful or false if failed.
     * 
     */

    public function list_hotel() {
        try {
            //construct the sql SELECT statement in this format
            $sql = "SELECT * FROM " . $this->tblHotel;

            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false. 
            //if (!$query)
            //return false;
            //if the query succeeded, but no hotel was found.
            if ($query && $query->num_rows > 0) {
                // return 0;
                //handle the result
                //create an array to store all returned hotels
                $hotels = array();

                //loop through all rows in the returned recordsets
                while ($obj = $query->fetch_object()) {
                    $hotel = new Hotel(stripslashes($obj->name), stripslashes($obj->city), stripslashes($obj->rating), stripslashes($obj->price), stripslashes($obj->num_of_beds), stripslashes($obj->bed_type), stripslashes($obj->image));

                    //set the id for the hotel
                    $hotel->setId($obj->id);

                    //add the hotel into the array
                    $hotels[] = $hotel;
                }
                return $hotels;
            } else if (!$query) {
                throw new DatabaseException("query failed to execute, cannot retrieve hotels");
            }
        }
        //catch exception and display message
        catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error message in error view from views folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }
        //display message for any other error/exception
        catch (Exception $e) {
            $message = $e->getMessage();
            //display error message in error view from views folder
            $view = new HotelError();
            $view->display($message);
            exit();
        }
    }

    /*
     * the viewHotel method retrieves the details of the hotel specified by its id
     * and returns a hotel object. Return false if failed.
     */

    public function view_hotel($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblHotel . " WHERE id=" . $id;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a hotel object
            $hotel = new Hotel(stripslashes($obj->name), stripslashes($obj->city), stripslashes($obj->rating), stripslashes($obj->price), stripslashes($obj->num_of_beds), stripslashes($obj->bed_type), stripslashes($obj->image));

            //set the id for the hotel
            $hotel->setId($obj->id);

            return $hotel;
        }

        return false;
    }

    //search the database for hotels that match words in arrival_location. Return an array of hotels if succeed; false otherwise.
    public function search_hotel($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblHotel . " WHERE " . $this->tblHotel . ".id AND (0";

        foreach ($terms as $term) {
            $sql .= " OR name LIKE '%" . $term . "%' OR city LIKE'%" . $term . "%' OR price LIKE'%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no hotel was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 hotel found.
        //create an array to store all the returned hotels
        $hotels = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $hotel = new Hotel(stripslashes($obj->name), stripslashes($obj->city), stripslashes($obj->rating), stripslashes($obj->price), stripslashes($obj->num_of_beds), stripslashes($obj->bed_type), stripslashes($obj->image));

            //set the id for the hotel
            $hotel->setId($obj->id);

            //add the hotel into the array
            $hotels[] = $hotel;
        }
        return $hotels;
    }

    public function update_hotel($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'name') ||
                !filter_has_var(INPUT_POST, 'city') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'rating') ||
                !filter_has_var(INPUT_POST, 'numOfBeds') ||
                !filter_has_var(INPUT_POST, 'bedType') ||
                !filter_has_var(INPUT_POST, 'image')) {
            return false;
        }
        try {
            //retrieve data for the new hotel; data are sanitized and escaped for security.
            $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
            $city = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING)));
            $price = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'price', FILTER_DEFAULT));
            $rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT)));
            $numOfBeds = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'numOfBeds', FILTER_SANITIZE_NUMBER_INT)));
            $bedType = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'bedType', FILTER_SANITIZE_STRING)));
            $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));

            if ($name == "" && $city == "" && $price == "" && $rating == "" && $numOfBeds == "" && $bedType == "" && $image == "") {
                throw new DataMissingException("Please fill out all the form. All fields are required.");
            }
            if ($name == "") {
                throw new DataMissingException("Missing Name.");
            }
            if ($city == "") {
                throw new DataMissingException("Missing City.");
            }
            if ($price == "") {
                throw new DataMissingException("Missing Price.");
            }
            if ($rating == "") {
                throw new DataMissingException("Missign Rating");
            }
            if ($numOfBeds == "") {
                throw new DataMissingException("Missing Number of Beds.");
            }
            if ($bedType == "") {
                throw new DataMissingException("Missing Bed Type.");
            }
            if ($image == "") {
                throw new DataMissingException("Missing Image.");
            }
            if (!is_numeric($rating)) {
                throw new DataTypeException(gettype($rating), "number");
            } if (!is_numeric($numOfBeds)) {
                throw new DataTypeException(gettype($numOfBeds), "number");
            }
        } catch (DataMissingException $e) {
            $message = $e->getMessage();
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (DataTypeException $e) {
            $message = $e->getMessage();
            $view = new HotelError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            $view = new HotelError();
            $view->display($message);
            exit();
        }
        //query string for update
        $sql = "UPDATE " . $this->tblHotel .
                " SET name='$name', city='$city', rating='$rating', price='$price', "
                . "num_of_beds='$numOfBeds', bed_type='$bedType', image='$image' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

}
