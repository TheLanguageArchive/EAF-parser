<?php
require __DIR__ . '/vendor/autoload.php';

$parser = new MPI\EAF\Parser(__DIR__ . '/example.eaf');
$result = $parser->parse();
header('Content-Type: application/json');
echo json_encode($result);
