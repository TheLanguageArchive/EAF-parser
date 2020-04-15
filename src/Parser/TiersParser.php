<?php
namespace TLA\EAF\Parser;

use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class TiersParser
{
    /**
     * Parsing tiers
     *
     * @param SimpleXMLElement $items
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $items): array
    {
        $tiers = [];

        foreach ($items as $item) {

            $attributes = $item->attributes();
            $id         = (string)$attributes['TIER_ID'];

            $tiers[] = [

                'id'              => $id,
                'locale'          => (string)$attributes['DEFAULT_LOCALE'],
                'annotations'     => AnnotationParser::parse($item->ANNOTATION),
                'linguistic_type' => (string)$attributes['LINGUISTIC_TYPE_REF'],
            ];
        }

        return $tiers;
    }
}
