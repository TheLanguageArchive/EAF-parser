<?php
namespace MPI\EAF\Parser;

use SimpleXMLElement;
use MPI\EAF\Media;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class MediaParser
{
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

            $media[] = new Media(

                (string)$attributes['MEDIA_URL'],
                (string)$attributes['MIME_TYPE'],
                (string)$attributes['RELATIVE_MEDIA_URL']
            );
        }

        return $media;
    }
}
