<?php
namespace MPI\EAF\Parser;

use SimpleXMLElement;
use MPI\EAF\Property;

/**
 * Properties parser
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
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
