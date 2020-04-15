<?php
namespace TLA\EAF\Parser;

use DateTime;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class MetadataParser
{
    /**
     * Parsing metadata
     *
     * @param SimpleXMLElement $item
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $item): array
    {
        $attributes = $item->attributes();

        return [

            'author'  => (string)$attributes['AUTHOR'],
            'date'    => (new DateTime((string)$attributes['DATE']))->getTimestamp(),
            'format'  => (string)$attributes['FORMAT'],
            'version' => (string)$attributes['VERSION'],
        ];
    }
}
