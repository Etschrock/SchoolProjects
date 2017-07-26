<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * title: ticket_controller.class.php
 * date: April 11, 2017
 * description: this is the controller for the ticket
 */

class TicketController {

    private $ticket_model;

    //default constructor
    public function __construct() {
        //create an instance of the TicketModel class
        $this->ticket_model = TicketModel::getTicketModel();
    }

    //index action that displays all tickets
    public function index() {
        try {
            //retrieves all tickets and store them in an array
            $tickets = $this->ticket_model->list_ticket();

            if (!$tickets) {
                throw new DatabaseException("There was a problem displaying tickets");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        }
        //display all tickets
        $view = new TicketIndex();
        $view->display($tickets);
    }

    //show details of a ticket
    public function detail($id) {
        try {
            //retrieve the specific ticket
            $ticket = $this->ticket_model->view_ticket($id);

            if (!$ticket) {
                throw new DatabaseException("There was an problem displaying the ticket id='" . $id . "'. It does not Exist.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        }
        //display ticket details
        $view = new TicketDetail();
        $view->display($ticket);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new TicketError();

        //display the error page
        $error->display($message);
    }

    //search tickets
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all tickets
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching tickets
        $tickets = $this->ticket_model->search_ticket($query_terms);

        if ($tickets === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched tickets
        $search = new TicketSearch();
        $search->display($query_terms, $tickets);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $tickets = $this->ticket_model->search_ticket($query_terms);

        //retrieve all ticket titles and store them in an array
        $arrivalLocations = array();
        if ($tickets) {
            foreach ($tickets as $ticket) {
                $arrivalLocations[] = $ticket->getArrival_location();
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

    //display a ticket in a form for editing
    public function edit($id) {
        try {
            //retrieve the specific ticket
            $ticket = $this->ticket_model->view_ticket($id);

            if (!$ticket) {
                throw new DatabaseException("There was a problem displaying the ticket id='" . $id . "'. It does not Exist.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        }
        $view = new TicketEdit();
        $view->display($ticket);
    }

// end of edit method
    //update a ticket in the database
    public function update($id) {
        try {
            //update the ticket
            $update = $this->ticket_model->update_ticket($id);
            if (!$update) {
                throw new DatabaseException("There was a problem updating the ticket id='" . $id . "'.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new TicketError();
            $view->display($message);
            exit();
        }

        //display the updateed ticket details
        $confirm = "The ticket was successfully updated.";
        $ticket = $this->ticket_model->view_ticket($id);

        $view = new TicketDetail();
        $view->display($ticket, $confirm);
    }

}
