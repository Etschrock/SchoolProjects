<?php

/**
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 22 2017
 * Title: gallery_controller.class.php
 * Description: This is the controller for the gallery
 */
class GalleryController {

    private $gallery_model;

    //default constructor
    public function __construct() {
        //create an instance of the GalleryModel class
        $this->gallery_model = GalleryModel::getGalleryModel();
    }

    //index action that displays all galleries
    public function index() {
        try {
            //retrieves all galleries and store them in an array
            $galleries = $this->gallery_model->list_gallery();

            if (!$galleries) {
                throw new DatabaseException("There was a problem displaying the gallery.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }
        //display all galleries
        $view = new GalleryIndex();
        $view->display($galleries);
    }

    //show details of the image
    public function detail($id) {
        try {
            //retrieve the specific image
            $gallery = $this->gallery_model->view_gallery($id);

            if (!$gallery) {
                throw new DatabaseException("There was an problem displaying the gallery id='" . $id . "'. It does not Exist.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }

        //display gallery details
        $view = new GalleryDetail();
        $view->display($gallery);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new GalleryError();

        //display the error page
        $error->display($message);
    }

    //display a gallery in a form for editing
    public function edit($id) {
        try {
            //retrieve the specific image
            $gallery = $this->gallery_model->view_gallery($id);

            if (!$gallery) {
                throw new DatabaseException("There was a problem displaying the gallery id='" . $id . "'. It does not Exist.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }

        $view = new GalleryEdit();
        $view->display($gallery);
    }

// end of edit method
    //function to add new image into gallery table
    public function add() {
        try {
            $image = $this->gallery_model->create_image();

            //error exception
            if (!$image) {
                throw new DatabaseException("An error has occured. We could not upload the image.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }

        $view = new ImageAdded();
        $view->display($image);
    }

    //update a image in the database
    public function update($id) {
        try {
            //update the image
            $update = $this->gallery_model->update_gallery($id);
            if (!$update) {
                throw new DatabaseException("There was a problem updating image id='" . $id . "'.");
            }
        } catch (DatabaseException $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            //display error in the views from view folder
            $view = new GalleryError();
            $view->display($message);
            exit();
        }

        //display the updated image
        $confirm = "The image was successfully updated.";
        $gallery = $this->gallery_model->view_gallery($id);

        $view = new GalleryDetail();
        $view->display($gallery, $confirm);
    }

    public function display() {
        $view = new GalleryAdd();
        $view->display();
    }

}
