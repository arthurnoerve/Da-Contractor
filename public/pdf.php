<?php
require __DIR__ . '/../vendor/autoload.php';

use \App\TemplateManager;

$dotenv = new Dotenv\Dotenv(__DIR__."/../");
$dotenv->load();

$man = new TemplateManager();


header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="contract.pdf"');

echo $man->generate_pdf($_GET);
