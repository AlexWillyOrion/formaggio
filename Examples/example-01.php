<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Formaggio\Formaggio;

$a = new Formaggio('/users', 'post');
$a->text('name', ["value" => "alessandro"])->place('Alessandro');
$a->text('lastname')->place('Manno');
$a->email('email')->place('alessandromanno@gmail.com');
$a->render();