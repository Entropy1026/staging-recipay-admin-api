<?php
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => 'localhost',                    
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'recipay_db',
                    // 'port'   => '3306',
                ]
            ],            
        ],        
    ],
];