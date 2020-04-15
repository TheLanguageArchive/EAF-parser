<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Property;
use SimpleXMLElement;

/**
 * Properties parser
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class PropertiesParser
{
    /**
     * Parsing properties
     *
     * @param SimpleXMLElement $items
     *
     * @return Property[]
     */
    public function parse(SimpleXMLElement $items): array
    {
        $properties = [];

        foreach ($items as $item) {

            $properties[] = new Property(

                (string)$item->attributes()['NAME'],
                (string)$item
            );
        }

        return $properties;
    }
}
