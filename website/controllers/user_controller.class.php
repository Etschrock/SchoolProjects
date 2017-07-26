<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * title: user_controller.class.php
 * date: April 11, 2017
 * description: this is the controller for the users
 */

class UserController {

    //put your code here
    private $user_model;

    public function __construct() {
        $this->user_model = UserModel::getUserModel();
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

    //this function gets the sign-in and login page to appear
    public function index() {
        $view = new SignUp();
        $view->display();
    }

    //function for signing in
    public function sign_in() {
        $view = new SignUp();
        $view->display();
    }

    //function to add new user
    public function add() {
        try {
            $user = $this->user_model->create_user();

            //error exception
            if (!$user) {
                throw new DatabaseException("Adding user Failed.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        }

        //success message
        $welcome = "User successfully added.";
        $view = new NewUser();
        $view->display($user);
    }

    //verifies the user is registered
    public function verify() {
        try {
            $user = $this->user_model->verify_user();

            //error exception
            if (!$user) {
                throw new VerifyDataException("We could not verify the user. Username or Password is Incorrect.");
            }
        } catch (VerifyDataException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        }

        $view = new LoginUser();
        $view->display($user);
    }

    //signs out the user
    public function sign_out() {
        try {
            $user = $this->user_model->sign_out();

            //error exception
            if (!$user) {
                throw new DatabaseException("An error has occured. We could not sign out the user.");
            }
        } catch (VerifyDataException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        }
        $view = new SignOut();
        $view->display();
    }

//    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new UserError();

        //display the error page
        $error->display($message);
    }

}
