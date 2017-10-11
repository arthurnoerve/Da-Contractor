<?php
require __DIR__ . '/../vendor/autoload.php';

use \App\TemplateManager;

$man = new TemplateManager();


header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $params['company'] . '.pdf"');

echo $man->generate_pdf($_GET);
