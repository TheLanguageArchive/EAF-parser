<?php
namespace MPI\EAF\Parser;

use SimpleXMLElement;
use MPI\EAF\Metadata;
use DateTime;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
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
