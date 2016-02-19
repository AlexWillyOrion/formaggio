<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Formaggio\MakeForm;

$a = new MakeForm;
$a->start('/saveThis','GET');
$a->text('nome')->place('pino');
$a->email('email')->place('alessandro@manno.info');
$a->password('pass');

$a->render();