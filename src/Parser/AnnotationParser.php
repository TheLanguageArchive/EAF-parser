<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Parser\Annotation\AlignableParser;
use TLA\EAF\Parser\Annotation\RefParser;
use TLA\EAF\Exception\UnknownAnnotationException;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class AnnotationParser
{
    /**
     * Parsing annotations
     *
     * @param SimpleXMLElement $items
     *
     * @return array
     * @throws UnknownAnnotationException
     */
    public static function parse(SimpleXMLElement $items): array
    {
        $annotations = [];
        foreach ($items as $item) {

            $annotation = self::parseAnnotation($item);
            $annotations[$annotation['id']] = $annotation;
        }

        return $annotations;
    }

    /**
     * parse annotation by type
     *
     * @param SimpleXMLElement $item
     *
     * @return array
     * @throws UnknownAnnotationException
     */
    private static function parseAnnotation(SimpleXMLElement $item): array
    {
        if (isset($item->ALIGNABLE_ANNOTATION)) {
            return AlignableParser::parse($item->ALIGNABLE_ANNOTATION);
        }

        if (isset($item->REF_ANNOTATION)) {
            return RefParser::parse($item->REF_ANNOTATION);
        }

        throw new UnknownAnnotationException('Could not parse annotation');
    }
}
