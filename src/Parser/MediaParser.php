<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Media\Media;
use TLA\EAF\Media\Manager;
use TLA\EAF\Media\Resolver;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class MediaParser
{
    /**
     * @var Resolver
     */
    private $mediaResolver;

    /**
     * Constructor
     *
     * @param Resolver $mediaResolver
     */
    public function __construct(Resolver $mediaResolver)
    {
        $this->mediaResolver = $mediaResolver;
    }

    /**
     * Parsing media items
     *
     * @param  SimpleXMLElement $items
     * @return Manager
     */
    public function parse(SimpleXMLElement $items): Manager
    {
        $media = [];
        $id    = 0;

        foreach ($items as $item) {

            $attributes = $item->attributes();
            $resolved   = $this->mediaResolver->resolve(new Media(

                $id,
                (string)$attributes['MEDIA_URL'],
                (string)$attributes['MIME_TYPE'],
                (string)$attributes['RELATIVE_MEDIA_URL'],
                isset($attributes['EXTRACTED_FROM'])
            ));

            if (null !== $resolved) {

                $id     += 1;
                $media[] = $resolved;
            }
        }

        return new Manager($media);
    }
}
