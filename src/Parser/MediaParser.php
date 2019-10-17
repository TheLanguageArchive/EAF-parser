<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Media\Media;
use TLA\EAF\Media\MediaResolver;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class MediaParser
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
     * Parsing media items
     *
     * @param SimpleXMLElement $items
     * @return Media[]
     */
    public function parse(SimpleXMLElement $items): array
    {
        $media = [];

        foreach ($items as $item) {

            $attributes = $item->attributes();
            $resolved   = $this->mediaResolver->resolve(new Media(

                (string)$attributes['MEDIA_URL'],
                (string)$attributes['MIME_TYPE'],
                (string)$attributes['RELATIVE_MEDIA_URL'],
                isset($attributes['EXTRACTED_FROM'])
            ));

            if (null !== $resolved) {
                $media[] = $resolved;
            }
        }

        return $media;
    }
}
