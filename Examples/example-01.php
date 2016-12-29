<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Formaggio\Formaggio;

$formaggio = new Formaggio('/users', 'post');
$formaggio->text('name', ["value" => "Alessandro"])->place('Alessandro');
$formaggio->text('lastname')->place('Manno');
$formaggio->email('email')->place('alessandromanno@gmail.com');
$formaggio->password('password');
$formaggio->render();