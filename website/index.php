<?php

/*
 * Authors: Eric Schrock, Daniel Neri, Hannah Roper
 * Date: April 8, 2017
 * Title: index.php
 * Description: this is the homepage 
 */
//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("application/autoloader.class.php");

//load the displather that dissects a request URL
new Dispatcher();
