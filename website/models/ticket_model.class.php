<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Title: ticket_model.class.php
 * Date: April 11, 2017
 * Description: this is the ticket model
 */
class TicketModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblTicket;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getTicketModel method must be called.
    private function __construct() {
        session_start();
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblTicket = $this->db->getTicketTable();


        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one TicketModel instance
    public static function getTicketModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new TicketModel();
        }
        return self::$_instance;
    }

    /*
     * the list_ticket method retrieves all ticketss from the database and
     * returns an array of Ticket objects if successful or false if failed.
     * Tickets should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_ticket() {
        try {
            //construct the sql SELECT statement in this format
            $sql = "SELECT * FROM " . $this->tblTicket;

            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false. 
            //if (!$query)
            //return false;
            //if the query succeeded, but no ticket was found.
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned tickets
                $tickets = array();

                //loop through all rows in the returned recordsets
                while ($obj = $query->fetch_object()) {
                    $ticket = new Ticket(stripslashes($obj->price), stripslashes($obj->gate), stripslashes($obj->seat), stripslashes($obj->class), stripslashes($obj->depart_time), stripslashes($obj->arrival_location), stripslashes($obj->arrival_time), stripslashes($obj->image));

                    //set the id for the ticket
                    $ticket->setId($obj->id);

                    //add the ticket into the array
                    $tickets[] = $ticket;
                }
                return $tickets;
            }if (!$query) {
                throw new DatabaseException("query failed to execute, cannot retrieve tickets");
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
     * the viewTicket method retrieves the details of the ticket specified by its id
     * and returns a ticket object. Return false if failed.
     */

    public function view_ticket($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblTicket . " WHERE id=" . $id;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a ticket object
            $ticket = new Ticket(stripslashes($obj->price), stripslashes($obj->gate), stripslashes($obj->seat), stripslashes($obj->class), stripslashes($obj->depart_time), stripslashes($obj->arrival_location), stripslashes($obj->arrival_time), stripslashes($obj->image));

            //set the id for the ticket
            $ticket->setId($obj->id);

            return $ticket;
        }

        return false;
    }

    //search the database for tickets that match words in arrival_location. Return an array of tickets if succeed; false otherwise.
    public function search_ticket($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblTicket . " WHERE " . $this->tblTicket . ".id AND (0";

        foreach ($terms as $term) {
            $sql .= " OR arrival_location LIKE '%" . $term . "%' OR arrival_time LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no ticket was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 ticket found.
        //create an array to store all the returned tickets
        $tickets = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $ticket = new Ticket($obj->price, $obj->gate, $obj->seat, $obj->class, $obj->depart_time, $obj->arrival_location, $obj->arrival_time, $obj->image);

            //set the id for the ticket
            $ticket->setId($obj->id);

            //add the ticket into the array
            $tickets[] = $ticket;
        }
        return $tickets;
    }

    public function update_ticket($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'depart_location') ||
                !filter_has_var(INPUT_POST, 'depart_time') ||
                !filter_has_var(INPUT_POST, 'arrival_location') ||
                !filter_has_var(INPUT_POST, 'arrival_time') ||
                !filter_has_var(INPUT_POST, 'gate') ||
                !filter_has_var(INPUT_POST, 'seat') ||
                !filter_has_var(INPUT_POST, 'class') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'image')) {

            return false;
        }
        try {
            //retrieve data for the new ticket; data are sanitized and escaped for security.
            $depart_location = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'depart_location', FILTER_SANITIZE_STRING)));
            $depart_time = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'depart_time', FILTER_SANITIZE_STRING)));
            $arrival_location = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'arrival_location', FILTER_SANITIZE_STRING)));
            $arrival_time = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'arrival_time', FILTER_SANITIZE_STRING)));
            $gate = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'gate', FILTER_SANITIZE_STRING)));
            $seat = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'seat', FILTER_SANITIZE_STRING)));
            $class = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING)));
            $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
            $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));

            if ($depart_location == "" && $depart_time == "" && $arrival_location == "" && $arrival_time == "" && $gate == "" && $seat == "" && $class == "" && $price == "" && $image == "") {
                throw new DataMissingException("Please fill out all the form. All fields are required.");
            }
            if ($depart_location == "") {
                throw new DataMissingException("Missing Depart Location.");
            }
            if ($depart_location == "") {
                throw new DataMissingException("Missing Depart Time.");
            }
            if ($arrival_location == "") {
                throw new DataMissingException("Missing Arrival Location.");
            }
            if ($arrival_time == "") {
                throw new DataMissingException("Missing Arrival Time");
            }
            if ($gate == "") {
                throw new DataMissingException("Missing Gate.");
            }
            if ($seat == "") {
                throw new DataMissingException("Missing Seat.");
            }
            if ($class == "") {
                throw new DataMissingException("Missing Class.");
            }
            if ($price == "") {
                throw new DataMissingException("Missing Price.");
            }
            if ($image == "") {
                throw new DataMissingException("Missing Image.");
            }
        } catch (DataMissingException $e) {
            $message = $e->getMessage();
            $view = new TicketError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            $view = new TicketError();
            $view->display($message);
            exit();
        }
        //query string for update
        $sql = "UPDATE " . $this->tblTicket .
                " SET price='$price', gate='$gate', seat='$seat', class='$class', "
                . "depart_time='$depart_time', arrival_location='$arrival_location',"
                . "arrival_time='$arrival_time', image='$image'  WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

}
