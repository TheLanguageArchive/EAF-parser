<?php
namespace TLA\EAF\Media;

use TLA\EAF\Media\Media;
use JsonSerializable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Manager implements JsonSerializable
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
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'media' => $this->media(),
            'count' => $this->count(),
            'first' => $this->first(),
        ];
    }
}
