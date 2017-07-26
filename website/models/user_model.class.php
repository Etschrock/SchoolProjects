<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: user_model.class.php
 * description: this is the model for the users
 */
class UserModel {

    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUsers;

    // constructor for the user model.
    public function __construct() {
        session_start();
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getUsersTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one UserModel instance
    public static function getUserModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }

    //function that creates users
    //filter data, make sure those fields exist
    public function create_user() {
        if (!filter_has_var(INPUT_POST, 'fullname') ||
                !filter_has_var(INPUT_POST, 'email') ||
                !filter_has_var(INPUT_POST, 'new_username') ||
                !filter_has_var(INPUT_POST, 'new_password') ||
                !filter_has_var(INPUT_POST, 'confirm')) {
            return false;
        }
        try {

            //retrieves data from form    
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['new_username'];
            $password = $_POST['new_password'];
            $confirm = $_POST['confirm'];
            $role = 2;

            //if nothing get's entered...throw a datamissing exception
            if ($fullname == "" && $email == "" && $username == "" && $password == "" && $confirm == "") {
                throw new DataMissingException("You have not entered anything. All fields are required, Please fill the form completely");
            }
            //if full name is missing throw a datamissing exception    
            if ($fullname == "") {
                throw new DataMissingException("Missing Full Name. Please enter Full Name.");
                //if email is missing throw a datamissing exception
            }if ($email == "") {
                throw new DataMissingException("Missing Email. Please enter Email.");
                //if username is missing throw a datamissing exception
            }if ($username == "") {
                throw new DataMissingException("Missing Username. Please enter Username.");
                //if password is missing throw a datamissing exception
            }if ($password == "") {
                throw new DataMissingException("Missig Password. Please enter Password.");
                //if confirm password is missing throw a datamissing exception
            }if ($confirm == "") {
                throw new DataMissingException("Missing Confirm Password. Please Confirm Password");
                //if password and confirm password does not match, throw a datamissing exception
            }if ($password != $confirm) {
                throw new DataMissingException("Password does not match. Please make sure Confirm Password matches Password.");
            }
            // make sure email is in correct format, call checkemail method
            //from utilities class
            //if email data is in wrong format, such as missing @ simbol, throw EmailException
            if (Utilities::checkemail($email) == FALSE) {
                throw new EmailException("Invalid Email. Make sure email is in 'someone@email.com' format.");
            }
        }  //catch and display email exception
        catch (EmailException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        }
        //catch and display data missing exception
        catch (DataMissingException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new UserError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            $view = new UserError();
            $view->display($message);
            exit();
        }

        $sql = "INSERT INTO " . $this->tblUsers . " VALUES (NULL, '$username', '$fullname', '$email', '$role', '$password')";
        //execute query
        return $this->dbConnection->query($sql);
    }

    //function that verifies users
    public function verify_user() {

        if (isset($_POST['username'])) {
            $username = trim($_POST['username']);
        }
        if (isset($_POST['password'])) {
            $password = trim($_POST['password']);
        }


        if (!empty($username)) {
            $query_str = "SELECT * FROM " . $this->tblUsers . " WHERE user_name='$username' AND password='$password'";
            $result = $this->dbConnection->query($query_str);
            if ($result->num_rows > 0) {
                //session_start();
                $result_row = $result->fetch_assoc();
                $_SESSION['role'] = $result_row['role'];
                $_SESSION['fullname'] = $result_row['user_fullname'];
                $_SESSION['username'] = $result_row['user_name'];
                $_SESSION['login_status'] = 1;
                return true;
            } else {
                $_SESSION['login_status'] = 2;
                return false;
            }
        }
    }

    //function that allows sign out
    public function sign_out() {
        if ($_SESSION['login_status'] == 1) {
            session_destroy();
            setcookie(session_name(), '', time() - 3600);
            $_SESSION = array();
            header("Location: index.php"); //if comment it, then we get message. 
            return true;
        } else {
            return false;
        }
    }

}
