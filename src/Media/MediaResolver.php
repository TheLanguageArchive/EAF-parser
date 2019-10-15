<?php
namespace TLA\EAF\Media;

/**
 * Resolving media files in eaf from a
 * provided list of media items
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class MediaResolver
{
    /**
     * @var array
     */
    private $locations;

    /**
     * Constructor
     *
     * @param array $locations
     */
    public function __construct(array $locations)
    {
        $this->locations = $locations;
    }

    /**
     * Resolving media files
     */
    public function resolve(Media $media): ?Media
    {
        $pathinfo = $media->getRelative();

        if (!$pathinfo && $media->getUrl()) {
            $pathinfo = $media->getUrl();
        }

        $filename = pathinfo($pathinfo, PATHINFO_BASENAME);

        if (!isset($this->locations[$filename])) {
            return null;
        }

        $media->setUrl($this->locations[$filename]);
        return $media;
    }
}
