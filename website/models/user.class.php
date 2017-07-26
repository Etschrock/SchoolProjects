<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 16, 2017
 * title: user.class.php
 * description: this is the class for the users
 */
class User {

    //private members
    private $user_id, $user_name, $user_fullname, $user_email, $role, $password;

    //function to define variables
    public function __construct($user_name, $user_fullname, $user_email, $role, $password) {
        $this->user_name = $user_name;
        $this->user_fullname = $user_fullname;
        $this->user_email = $user_email;
        $this->role = $role;
        $this->password = $password;
    }

    //public get methods
    public function getUser_id() {
        return $this->user_id;
    }

    public function getUser_name() {
        return $this->user_name;
    }

    public function getUser_fullname() {
        return $this->user_fullname;
    }

    public function getUser_email() {
        return $this->user_email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getPassword() {
        return $this->password;
    }

    //public set id method
    public function setId($id) {
        $this->user_id = $id;
    }

}
