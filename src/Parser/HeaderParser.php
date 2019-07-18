<?php
namespace MPI\EAF\Parser;

use MPI\EAF\Header;
use MPI\EAF\Parser\MediaParser;
use MPI\EAF\Parser\PropertiesParser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class HeaderParser
{
    /**
     * Parse header
     *
     * @param SimpleXMLElement $header
     *
     * @return Header
     */
    public function parse(SimpleXMLElement $header): Header
    {
        $attributes = $header->attributes();

        return new Header(

            (string)$attributes['MEDIA_FILE'],
            (string)$attributes['TIME_UNITS'],
            (new MediaParser)->parse($header->MEDIA_DESCRIPTOR),
            (new PropertiesParser)->parse($header->PROPERTY)
        );
    }
}
