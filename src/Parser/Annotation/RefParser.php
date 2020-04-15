<?php
namespace TLA\EAF\Parser\Annotation;

use TLA\EAF\Parser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class RefParser
{
    /**
     * Parsing ref annotation
     *
     * @param SimpleXMLElement $item
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $item): array
    {
        $attributes = $item->attributes();
        $previous   = isset($attributes['PREVIOUS_ANNOTATION']) ? (string)$attributes['PREVIOUS_ANNOTATION'] : null;

        return [

            'id'       => (string)$attributes['ANNOTATION_ID'],
            'type'     => Parser::ANNOTATION_TYPE_REF,
            'value'    => (string)$item->ANNOTATION_VALUE,
            'ref'      => (string)$attributes['ANNOTATION_REF'],
            'previous' => $previous,
        ];
    }
}
