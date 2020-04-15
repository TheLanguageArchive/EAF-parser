<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Metadata;
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
     * @param SimpleXMLElement $metadata
     * @return Metadata
     */
    public function parse(SimpleXMLElement $metadata): Metadata
    {
        $attributes = $metadata->attributes();

        return new Metadata(

            (string)$attributes['AUTHOR'],
            new DateTime((string)$attributes['DATE']),
            (string)$attributes['FORMAT'],
            (string)$attributes['VERSION']
        );
    }
}
