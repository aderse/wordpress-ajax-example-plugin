<?php

defined('ABSPATH') || exit;

/*
 * Plugin Name: AJAX Example
 * Description: WordPress plugin that shows a very simple AJAX implementation.
 * Author: <a href="https://www.linkedin.com/in/andrew-derse-56692235/">Andrew Derse</a>
 * Version: 1.0
*/

require_once 'vendor/autoload.php';
AjaxExampleController::init();