<?php
namespace TLA\EAF\Parser\Annotation;

use TLA\EAF\Parser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class AlignableParser
{
    /**
     * Parse alignable annotation
     *
     * @param SimpleXMLElement $item
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $item): array
    {
        $attributes = $item->attributes();

        return [

            'id'    => (string)$attributes['ANNOTATION_ID'],
            'type'  => Parser::ANNOTATION_TYPE_ALIGNABLE,
            'value' => (string)$item->ANNOTATION_VALUE,
            'start' => (string)$attributes['TIME_SLOT_REF1'],
            'end'   => (string)$attributes['TIME_SLOT_REF2'],
        ];
    }
}
