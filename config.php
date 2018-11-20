<?php

return [
  'prod' => [
    'dsn' => 'mysql:host={host};dbname={database}',
    'login' => '{username}',
    'password' => '{password}',
    'options' => []
  ],
  'dev' => [
    'dsn' => 'mysql:host=localhost;dbname=simple',
    'login' => 'root',
    'password' => 'root',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ],
  'admin' => [
    'username' => 'mvc',
    'password' => 'cnampaca',
  ]
];
