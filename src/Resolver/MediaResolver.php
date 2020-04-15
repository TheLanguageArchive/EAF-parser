<?php
namespace TLA\EAF\Resolver;

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
     *
     * @param array $media
     *
     * @return array|false
     */
    public function resolve(array $media)
    {
        $path = $media['relative'];

        if (!$path && $media['url']) {
            $path = $media['url'];
        }

        $filename = pathinfo($path, PATHINFO_BASENAME);

        if (!isset($this->locations[$filename])) {
            return false;
        }

        $media['url'] = $this->locations[$filename]['url'];

        if (false !== $this->locations[$filename]['mimetype']) {
            $media['mimetype'] = $this->locations[$filename]['mimetype'];
        }

        return $media;
    }
}
