<?php
use TLA\EAF\Parser;
use TLA\EAF\Media\Resolver;

require __DIR__ . '/vendor/autoload.php';

$locations = [
    'elan-example1.mpg' => [

        'url' => 'http://localhost/flat/sites/all/modules/custom/flat_annotation_viewer/annotations/example.mp4',
        'mimetype' => false,
    ],

];

$parser = new Parser(simplexml_load_file(__DIR__ . '/example2.eaf'), new Resolver($locations));
$eaf    = $parser->parse();

header('Content-Type: application/json');
echo json_encode($eaf);
