<?php
use TLA\EAF\Parser;
use TLA\EAF\Resolver\MediaResolver;

require __DIR__ . '/vendor/autoload.php';

$locations = [

    'elan-example1.wav' => [

        'url'      => 'http://localhost/flat/islandora/object/lat%3A12345_7240d589_694e_409f_af00_171fd6c17807/datastream/OBJ/view',
        'mimetype' => 'audio/mp3',
    ],

    'elan-example1.mpg' => [

        'url'      => 'http://localhost/flat/islandora/object/lat%3A12345_839d0177_76ac_4278_8e2c_4e85f1b02704/datastream/MP4/view',
        'mimetype' => 'video/mp4',
    ],
];
throw new Exception('t');
$parser = new Parser(simplexml_load_file(__DIR__ . '/example3.eaf'), new MediaResolver($locations));
$eaf    = $parser->parse();
// header('Content-Encoding: gzip');
header('Content-type: application/json');
echo json_encode($eaf);
