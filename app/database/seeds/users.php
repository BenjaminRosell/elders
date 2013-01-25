<?php

return array(
   
   array(
    'id' => 2,
    'email' => 'user@elders.com',
    'username' => 'notassigned',
    'password' => Hash::make('admin'),
    'phone' => '5140000000',
    'first_name' => 'Not',
    'last_name' => 'Assigned',
    'reminder' => 0
    ),

   array(
    'id' => 1,
    'email' => 'admin@elders.com',
    'username' => 'admin',
    'password' => Hash::make('admin'),
    'phone' => '5140000000',
    'activated' => '1',
    'first_name' => 'Administrator',
    'last_name' => 'by Default',
    'reminder' => 1
    ),

);