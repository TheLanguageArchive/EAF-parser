<?php
namespace MPI\EAF\Parser\Annotation;

use SimpleXMLElement;
use MPI\EAF\Annotation\RefAnnotation;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
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
