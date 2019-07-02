<?php
namespace MPI\EAF;

use MPI\EAF\Media;
use MPI\EAF\Property;

/**
 * Header entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Header
{
    /**
     * @var string
     */
    private $mediafile;

    /**
     * @var string
     */
    private $timeunits;

    /**
     * @var Media[]
     */
    private $media;

    /**
     * @var Property[]
     */
    private $properties;

    /**
     * Constructor
     *
     * @param string     $mediafile
     * @param string     $timeunits
     * @param Media[]    $media
     * @param Property[] $properties
     */
    public function __construct(string $mediafile, string $timeunits, array $media, array $properties)
    {
        $this->mediafile  = $mediafile;
        $this->timeunits  = $timeunits;
        $this->media      = $media;
        $this->properties = $properties;
    }

    /**
     * Get media file
     *
     * @return string
     */
    public function getMediaFile(): string
    {
        return $this->mediafile;
    }

    /**
     * Get timeslots
     *
     * @return string
     */
    public function getTimeUnits(): string
    {
        return $this->timeslots;
    }

    /**
     * Get media items
     *
     * @return Media[]
     */
    public function getMedia(): array
    {
        return $this->media;
    }

    /**
     * Get properties
     *
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}
