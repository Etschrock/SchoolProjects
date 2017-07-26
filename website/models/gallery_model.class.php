<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 22 2017
 * Title: gallery_model.class.php
 * Description: This is the gallery_model class
 */
class GalleryModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblGallery;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGalleryModel method must be called.
    private function __construct() {
        session_start();
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblGallery = $this->db->getGalleryTable();


        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one GalleryModel instance
    public static function getGalleryModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new GalleryModel();
        }
        return self::$_instance;
    }

    /*
     * the list_gallery method retrieves all galleries from the database and
     * returns an array of Gallery objects if successful or false if failed.
     * Galleries should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_gallery() {
        //construct the sql SELECT statement in this format
        $sql = "SELECT * FROM " . $this->tblGallery;

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no gallery was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned galleries
        $galleries = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $gallery = new Gallery(stripslashes($obj->name), stripslashes($obj->image));

            //set the id for the gallery
            $gallery->setId($obj->id);

            //add the gallery into the array
            $galleries[] = $gallery;
        }
        return $galleries;
    }

    //function to get the details of an image when you click on it
    public function view_gallery($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblGallery . " WHERE id=" . $id;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a gallery object
            $gallery = new Gallery(stripslashes($obj->name), stripslashes($obj->image));

            //set the id for the image
            $gallery->setId($obj->id);

            return $gallery;
        }

        return false;
    }

    //function that creates users
    public function create_image() {
        try {
            $name = $_POST['name'];
            $image = $_POST['image'];

            if ($image == "") {
                throw new DataMissingException("Missing url for image. Please enter image URL address.");
            }
        }
//catch and display data missing exception
        catch (DataMissingException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }
        //handle any other exceptions
        catch (Exception $e) {
            $message = $e->getMessage();
            $view = new GalleryError();
            $view->display($message);
            exit();
        }
        $sql = "INSERT INTO " . $this->tblGallery . " VALUES (NULL, '$name', '$image')";

        return $this->dbConnection->query($sql);
    }

    public function update_gallery($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'name') ||
                !filter_has_var(INPUT_POST, 'image')) {
            return false;
        }

        //retrieve data for the new hotel; data are sanitized and escaped for security.
        $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));

        //query string for update
        $sql = "UPDATE " . $this->tblGallery .
                " SET name='$name', image='$image' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

}
