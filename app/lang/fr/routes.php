<?php 

return array(
	'visites' => array('route' => 'Visits', 'type' => 'resource', 'beforeFilter' => 'authorise'),
	'utilisateurs' => array('route' => 'Users', 'type' => 'resource', 'beforeFilter' => 'authorise'),
	'familles' => array('route' => 'Homes', 'type' => 'resource', 'beforeFilter' => 'authorise') ,
);