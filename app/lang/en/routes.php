<?php 

return array(
	'home-teaching' => array('route' => 'Visits', 'type' => 'resource', 'beforeFilter' => 'authorise'),
	'users' => array('route' => 'Users', 'type' => 'resource', 'beforeFilter' => 'authorise'),
	'homes' => array('route' => 'Homes', 'type' => 'resource', 'beforeFilter' => 'authorise') ,
);