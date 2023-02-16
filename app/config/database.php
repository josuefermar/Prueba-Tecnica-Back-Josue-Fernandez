<?php

use Illuminate\Database\Capsule\Manager as Capsule;
require('db_credentials.php');

$capsule = new Capsule;

$capsule->addConnection($db_credentials);

$capsule->setAsGlobal();
$capsule->bootEloquent();