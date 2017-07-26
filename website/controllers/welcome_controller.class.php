<?php

/*
 * Authors: Daniel Neri, Hannah Roper, Eric Schrock
 * Title: welcome_controller.class.php
 * Date: April 12, 2017
 * Description: this is the controller for the welcome page
 */

class WelcomeController {

    //put your code here
    public function index() {
        session_start();
        $view = new WelcomeIndex();
        $view->display();
    }

}
