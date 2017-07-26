<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: city_model.class.php
 * Date: April 11, 2017
 * Description: this is the city model
 */
class CityModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblCity;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getCityModel method must be called.
    private function __construct() {
        session_start();
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblCity = $this->db->getCityTable();


        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one CityModel instance
    public static function getCityModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new CityModel();
        }
        return self::$_instance;
    }

    /*
     * the list_city method retrieves all cites from the database and
     * returns an array of City objects if successful or false if failed.
     * Cities should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_city() {
        try {
            //construct the sql SELECT statement in this format
            $sql = "SELECT * FROM " . $this->tblCity;

            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false. 
            //if (!$query)
            //return false;
            //if the query succeeded, but no cities was found.
            if ($query && $query->num_rows > 0) {
                //return 0;
                //handle the result
                //create an array to store all returned citiess
                $cities = array();

                //loop through all rows in the returned recordsets
                while ($obj = $query->fetch_object()) {
                    $city = new City(stripslashes($obj->city), stripslashes($obj->city_description), stripslashes($obj->city_image), stripslashes($obj->city_image_description), stripslashes($obj->city_image2), stripslashes($obj->city_image_description2), stripslashes($obj->city_image3), stripslashes($obj->city_image_description3));

                    //set the id for the city
                    $city->setId($obj->cityID);

                    //add the city into the array
                    $cities[] = $city;
                }
                return $cities;

                //if query fails, throw a DatabaseException
            }if (!$query) {
                throw new DatabaseException("query failed to execute, cannot retrieve cities");
            }
        }
        //catch exception and display message
        catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error message in error view from views folder
            $view = new CityError();
            $view->display($message);
            exit();
        }
        //display message for any other error/exception
        catch (Exception $e) {
            $message = $e->getMessage();
            //display error message in error view from views folder
            $view = new CityError();
            $view->display($message);
            exit();
        }
    }

    /*
     * the viewCity method retrieves the details of the city specified by its id
     * and returns a city object. Return false if failed.
     */

    public function view_city($id) {
//the select ssql statement
        $sql = "SELECT * FROM " . $this->tblCity . " WHERE cityID=" . $id;

//execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

//create a city object
            $city = new City(stripslashes($obj->city), stripslashes($obj->city_description), stripslashes($obj->city_image), stripslashes($obj->city_image_description), stripslashes($obj->city_image2), stripslashes($obj->city_image_description2), stripslashes($obj->city_image3), stripslashes($obj->city_image_description3));

//set the id for the city
            $city->setId($obj->cityID);

            return $city;
        }

        return false;
    }

//search the database for cities that match words in city. Return an array of cities if succeed; false otherwise.
    public function search_city($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
//select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblCity . " WHERE " . $this->tblCity . ".cityID AND (0";

        foreach ($terms as $term) {
            $sql .= " OR city LIKE '%" . $term . "%'";
        }

        $sql .= ")";

//execute the query
        $query = $this->dbConnection->query($sql);

// the search failed, return false. 
        if (!$query)
            return false;

//search succeeded, but no city was found.
        if ($query->num_rows == 0)
            return 0;

//search succeeded, and found at least 1 city found.
//create an array to store all the returned cities
        $cities = array();

//loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $city = new City(stripslashes($obj->city), stripslashes($obj->city_description), stripslashes($obj->city_image), stripslashes($obj->city_image_description), stripslashes($obj->city_image2), stripslashes($obj->city_image_description2), stripslashes($obj->city_image3), stripslashes($obj->city_image_description3));

//set the id for the city
            $city->setId($obj->cityID);

//add the city into the array
            $cities[] = $city;
        }
        return $cities;
    }

    public function update_city($id) {
//if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'cityName') ||
                !filter_has_var(INPUT_POST, 'cityDescription') ||
                !filter_has_var(INPUT_POST, 'cityImage') ||
                !filter_has_var(INPUT_POST, 'cityImageDescription') ||
                !filter_has_var(INPUT_POST, 'cityImage2') ||
                !filter_has_var(INPUT_POST, 'cityImageDescription2') ||
                !filter_has_var(INPUT_POST, 'cityImage3') ||
                !filter_has_var(INPUT_POST, 'cityImageDescription3')) {

            return false;
        }
        try {
//retrieve data for the new city; data are sanitized and escaped for security.
            $cityName = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityName', FILTER_SANITIZE_STRING)));
            $cityDescription = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityDescription', FILTER_SANITIZE_STRING)));
            $cityImage = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImage', FILTER_SANITIZE_STRING)));
            $cityImageDescription = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImageDescription', FILTER_SANITIZE_STRING)));
            $cityImage2 = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImage2', FILTER_SANITIZE_STRING)));
            $cityImageDescription2 = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImageDescription2', FILTER_SANITIZE_STRING)));
            $cityImage3 = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImage3', FILTER_SANITIZE_STRING)));
            $cityImageDescription3 = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'cityImageDescription3', FILTER_SANITIZE_STRING)));
            if ($cityName == "" && $cityDescription == "" && $cityImage == "" && $cityImageDescription == "" && $cityImage2 == "" && $cityImageDescription2 == "" && $cityImage3 == "" && $cityImageDescription3) {
                throw new DataMissingException("Please fill out all the form. All fields are required.");
            }
            if ($cityName == "") {
                throw new DataMissingException("Missing City Name.");
            }
            if ($cityDescription == "") {
                throw new DataMissingException("Missing City Description.");
            }
            if ($cityImage == "") {
                throw new DataMissingException("Missing City Image.");
            }
            if ($cityImageDescription == "") {
                throw new DataMissingException("Missign City Image Description.");
            }
            if ($cityImage2 == "") {
                throw new DataMissingException("Missing City Image 2.");
            }
            if ($cityImageDescription2 == "") {
                throw new DataMissingException("Missing City Image Descripition 2.");
            }
            if ($cityImage3 == "") {
                throw new DataMissingException("Missing City Image 3.");
            }if ($cityImageDescription3 == "") {
                throw new DataMissingException("Missing City Image Description 3.");
            }
        } catch (DataMissingException $e) {
            $message = $e->getMessage();
            $view = new CityError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            $view = new CityError();
            $view->display($message);
            exit();
        }
//query string for update
        $sql = "UPDATE " . $this->tblCity .
                " SET city='$cityName', city_description='$cityDescription', city_image='$cityImage', city_image_description='$cityImageDescription', "
                . "city_image2='$cityImage2', city_image_description2='$cityImageDescription2',"
                . "city_image3='$cityImage3', city_image_description3='$cityImageDescription3'  WHERE cityID='$id'";

//execute the query
        return $this->dbConnection->query($sql);
    }

}
