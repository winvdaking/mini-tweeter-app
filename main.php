<?php

require 'vendor/autoload.php';
parse_ini_file('conf/config.ini');

$db = new \Illuminate\Database\Capsule\Manager();