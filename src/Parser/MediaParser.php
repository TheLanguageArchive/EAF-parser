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
        $rank  = 0;
        $id    = 0;

        foreach ($items as $item) {

            $attributes = $item->attributes();

            $isAudio  = self::determineAudio((string)$attributes['MIME_TYPE']);
            $offset   = isset($attributes['TIME_ORIGIN']) ? (int)$attributes['TIME_ORIGIN'] : 0;
            $relative = (string)$attributes['RELATIVE_MEDIA_URL'];
            $url      = (string)$attributes['MEDIA_URL'];
            $path     = $relative;

            if (!$path && $url) {
                $path = $url;
            }

            $filename = pathinfo($path, PATHINFO_BASENAME);
            $resolved = $mediaResolver->resolve([

                'id'       => null,
                'filename' => $filename,
                'url'      => $url,
                'mimetype' => (string)$attributes['MIME_TYPE'],
                'relative' => $relative,
                'audio'    => $isAudio,
                'offset'   => $offset
            ]);

            if (false !== $resolved) {

                $rank += 1;
                $id = $rank + (false === $isAudio ? 10 : 20);

                $resolved['id'] = $id;
                $media[] = $resolved;
            }
        }

        // adding sort to ensure videos come up first
        usort($media, function($a, $b) {
            return $a['id'] < $b['id'] ? -1 : 1;
        });

        return [

            'media' => $media,
            'count' => count($media),
            'first' => current($media) ?? null,
        ];
    }

    /**
     * Determining whether mimetype is audio
     *
     * @param string $mimetype
     *
     * @return boolean
     */
    public static function determineAudio(string $mimetype): bool
    {
        return substr($mimetype, 0, 5) === 'audio';
    }
}
