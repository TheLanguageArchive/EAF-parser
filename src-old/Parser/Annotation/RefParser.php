<?php
namespace TLA\EAF\Parser\Annotation;

use TLA\EAF\Annotation\RefAnnotation;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class RefParser
{
    /**
     * Parsing ref annotations
     *
     * @param SimpleXMLElement $items
     *
     * @return RefAnnotation
     */
    public function parse(SimpleXMLElement $annotation): RefAnnotation
    {
        $attributes = $annotation->attributes();
        $previous   = isset($attributes['PREVIOUS_ANNOTATION']) ? (string)$attributes['PREVIOUS_ANNOTATION'] : null;

        return new RefAnnotation(

            (string)$attributes['ANNOTATION_ID'],
            (string)$annotation->ANNOTATION_VALUE,
            (string)$attributes['ANNOTATION_REF'],
            $previous
        );
    }
}
