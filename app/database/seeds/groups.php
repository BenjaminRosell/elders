<?php

return array(

    array(
        'name' => 'admin',
        'permissions' => '{"admin":1,"users":1}',
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ),

    array(
        'name' => 'users',
        'permissions' => '{"users":1}',
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ),

    array(
        'name' => 'observer',
        'permissions' => '{"observer":1,"users":1}',
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ),

);