<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Header;
use TLA\EAF\Media\MediaResolver;
use TLA\EAF\Parser\MediaParser;
use TLA\EAF\Parser\PropertiesParser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class HeaderParser
{
    /**
     * @var MediaResolver
     */
    private $mediaResolver;

    /**
     * Constructor
     *
     * @param MediaResolver $mediaResolver
     */
    public function __construct(MediaResolver $mediaResolver)
    {
        $this->mediaResolver = $mediaResolver;
    }

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
            (new MediaParser($this->mediaResolver))->parse($header->MEDIA_DESCRIPTOR),
            (new PropertiesParser)->parse($header->PROPERTY)
        );
    }
}
