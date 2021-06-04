<?php
/**
 * Created by PhpStorm.
 * User: Alex Pavel
 * Date: 3/7/2018
 * Time: 12:25 PM
 */
//Require the autoload file
require_once('vendor/autoload.php');
require_once 'model/data-layer.php';


session_start();
// server should keep session data for AT LEAST 8 hours
ini_set('session.gc_maxlifetime', 28800);
// each client should remember their session id for EXACTLY 8 hours
session_set_cookie_params(28800);
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Create an instance of the Base Class
$f3 = Base::instance();
$f3->set('DEBUG', 3);
$f3->set('ethnicities', getEthnicities());
$f3->set('listResources', getResources());
$f3->set('listGenders', getGenders());

// construct a new validator
$validator = new Validate();

// create a new controller
$controller = new Controller($f3, $validator);

//logout route
$f3->route('GET|POST /logout', function($f3) {
    $GLOBALS['controller']->logout($f3);
});

//intake requests route
$f3->route('GET|POST /requests', function($f3) {
    $GLOBALS['controller']->requests($f3);
});

//login
$f3->route('GET|POST /', function($f3) {
    $GLOBALS['controller']->login($f3);
});

//Define a default route(home)
$f3->route('GET /home', function($f3)
{
    $GLOBALS['controller']->home($f3);
});

//reports
$f3->route('GET|POST /reports', function($f3) {
    $GLOBALS['controller']->reports($f3);
});

//newGuest
$f3->route('GET|POST /newGuest', function($f3) {
    $GLOBALS['controller']->newGuest($f3);
});

//edit guest
$f3->route('GET|POST /@client_id', function($f3,$params) {
    $GLOBALS['controller']->clientId($f3, $params);
});

//edit guest
$f3->route('GET|POST /request/@id', function($f3,$params) {
    $GLOBALS['controller']->requestId($f3, $params);
});

//demographics
$f3->route('GET /demographics', function($f3) {
    $GLOBALS['controller']->demographics($f3);
});

// reset the password route
$f3->route('GET|POST /profile', function($f3) {
    $GLOBALS['controller']->profile($f3);
});

// budget page route
$f3->route('GET|POST /budget', function($f3) {
    $GLOBALS['controller']->budget($f3);
});

// archived task page route
$f3->route('GET|POST /archived', function($f3) {
    $GLOBALS['controller']->archived($f3);
});

//Run Fat-Free
$f3->run();
