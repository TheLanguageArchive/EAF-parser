<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Parser\PropertiesParser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class HeaderParser
{
    /**
     * Parse header
     *
     * @param SimpleXMLElement $item
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $item): array
    {
        $attributes = $item->attributes();

        return [

            'mediafile'  => (string)$attributes['MEDIA_FILE'],
            'timeunits'  => (string)$attributes['TIME_UNITS'],
            'media'      => [],
            'properties' => PropertiesParser::parse($item->PROPERTY),
        ];
    }
}
