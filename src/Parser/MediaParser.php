<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Resolver\MediaResolver;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class MediaParser
{
    /**
     * Parsing media items
     *
     * @param SimpleXMLElement $items
     * @param MediaResolver    $mediaResolver
     *
     * @return array
     */
    public static function parse(SimpleXMLElement $items, MediaResolver $mediaResolver): array
    {
        $media = [];
        $id    = 0;

        foreach ($items as $item) {

            $attributes = $item->attributes();

            $offset   = isset($attributes['TIME_ORIGIN']) ? (int)$attributes['TIME_ORIGIN'] : 0;
            $relative = (string)$attributes['RELATIVE_MEDIA_URL'];
            $url      = (string)$attributes['MEDIA_URL'];
            $path     = $relative;

            if (!$path && $url) {
                $path = $url;
            }

            $filename = pathinfo($path, PATHINFO_BASENAME);
            $resolved = $mediaResolver->resolve([

                'id'       => $id,
                'filename' => $filename,
                'url'      => $url,
                'mimetype' => (string)$attributes['MIME_TYPE'],
                'relative' => $relative,
                'audio'    => isset($attributes['EXTRACTED_FROM']),
                'offset'   => $offset
            ]);

            if (false !== $resolved) {

                $id     += 1;
                $media[] = $resolved;
            }
        }

        return [

            'media' => $media,
            'count' => count($media),
            'first' => current($media) ?? null,
        ];
    }
}
