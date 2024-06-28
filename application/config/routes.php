<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

// route login
$route['login'] = 'login';


$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;
