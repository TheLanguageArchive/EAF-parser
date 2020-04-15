<?php
namespace TLA\EAF\Media;

use TLA\EAF\Media\Media;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Manager
{
    /**
     * @var Media[]
     */
    private $media;

    /**
     * Constructor
     *
     * @param Media[] $media
     */
    public function __construct(array $media)
    {
        $this->media = $media;
    }

    /**
     * Getting all media files
     *
     * @return array
     */
    public function media(): array
    {
        return $this->media;
    }

    /**
     * Count media files
     *
     * @return boolean
     */
    public function count(): int
    {
        return count($this->media);
    }

    /**
     * Get first valid media item
     *
     * @return Media|null
     */
    public function first(): ?Media
    {
        return ($this->count() > 0 ? current($this->media) : null);
    }

    /**
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        $media = array_map(function($item) {
            return $item->toArray();
        }, $this->media());

        $first = $this->first();
        $first = $first instanceof Media ? $first->toArray() : null;

        return [

            'media' => $media,
            'count' => $this->count(),
            'first' => $first,
        ];
    }
}
