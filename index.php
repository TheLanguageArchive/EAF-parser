<?php
use MPI\EAF\Media\MediaResolver;

require __DIR__ . '/vendor/autoload.php';

$locations = ['example.mp4' => 'http://localhost/flat/sites/all/modules/custom/flat_annotation_viewer/annotations/example.mp4'];
$parser    = new MPI\EAF\Parser(__DIR__ . '/example.eaf', new MediaResolver($locations));
$result    = $parser->parse();

header('Content-Type: application/json');
echo json_encode($result);
