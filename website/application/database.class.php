<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 11, 2017
 * Title: database.class.php
 * Description: This is the database
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'travelogic',
        'tblTicket' => 'planeticket',
        'tblCity' => 'citydetails',
        'tblHotel' => 'hotel',
        'tblUsers' => 'users',
        'tblGallery' => 'gallery'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        //try to establish a connection with the databse, with provided params
        try {
            $this->objDBConnection = @new mysqli(
                    $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
            );
            // if there is a problem connecting, throw a DatabaseException 
            if (mysqli_connect_errno() != 0) {

                throw new DatabaseException("There was a problem connecting to the database:");
            }

            //catch exception and display message
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display in the message in the error view from views folder
            $view = new UserError();
            $view->display($message);
            exit();
            echo $message;
        }
        //display message for any other error/exception
        catch (Exception $e) {
            $message = $e->getMessage();
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores plane tickeets
    public function getTicketTable() {
        return $this->param['tblTicket'];
    }

    //returns the name of the table that stores city details
    public function getCityTable() {
        return $this->param['tblCity'];
    }

//returns the name of the table that stores hotels
    public function getHotelTable() {
        return $this->param['tblHotel'];
    }

    //returns the name of the table that stores users
    public function getUsersTable() {
        return $this->param['tblUsers'];
    }

    //returns the name of the table that stores users
    public function getGalleryTable() {
        return $this->param['tblGallery'];
    }

}
