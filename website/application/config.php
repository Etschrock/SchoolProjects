<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 8, 2017
 * Title: config.php
 * Description: this is the config.php file
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/I211/website");

/* * ***********************************************************************************
 *                       settings for tickets                                         *
 * ********************************************************************************** */

//define default path for media images
define("TICKET_IMG", "www/img/tickets.jpg/");
define("CITY_IMG", "www/img/cities.jpg/");
define("HOTEL_IMG", "www/img/hotels.jpg/");
define("GALLERY_IMG", "www/img/hotels.jpg/");

