<?php
use TLA\EAF\Parser;
use TLA\EAF\Media\Resolver;

require __DIR__ . '/vendor/autoload.php';

$locations = [

    'example.wav' => [

        'url'      => 'http://localhost/flat/islandora/object/lat%3A12345_4db31e65_4e57_419f_8d17_3523ee3e39be/datastream/PROXY_MP3/view',
        'mimetype' => 'audio/mp3',
    ],

    'example.mp4' => [

        'url'      => 'http://localhost/flat/islandora/object/lat%3A12345_aeaae863_c5c6_4ad7_9669_8ac1d5787333/datastream/MP4/view',
        'mimetype' => 'video/mp4',
    ],

    'pear.mp4' => [

        'url'      => 'http://localhost/flat/sites/all/modules/custom/flat_annotation_viewer/annotations/pear/pear.mp4',
        'mimetype' => 'video/mp4',
    ],
];

$parser = new Parser(simplexml_load_file(__DIR__ . '/example.eaf'), new Resolver($locations));
$eaf    = $parser->parse();

header('Content-Type: application/json');
echo json_encode($eaf);
