<?php
namespace TLA\EAF;

use TLA\EAF\Media\Manager;
use TLA\EAF\Property;

/**
 * Header entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
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
     * @var Manager
     */
    private $mediaManager;

    /**
     * @var Property[]
     */
    private $properties;

    /**
     * Constructor
     *
     * @param string     $mediafile
     * @param string     $timeunits
     * @param Manager    $mediaManager
     * @param Property[] $properties
     */
    public function __construct(string $mediafile, string $timeunits, Manager $mediaManager, array $properties)
    {
        $this->mediafile    = $mediafile;
        $this->timeunits    = $timeunits;
        $this->mediaManager = $mediaManager;
        $this->properties   = $properties;
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
     * Get timeunits
     *
     * @return string
     */
    public function getTimeUnits(): string
    {
        return $this->timeunits;
    }

    /**
     * Get media manager
     *
     * @return Manager
     */
    public function getMediaManager(): Manager
    {
        return $this->mediaManager;
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

    /**
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        $properties = array_map(function(Property $property) {
            return $property->toArray();
        }, $this->getProperties());

        return [

            'mediafile'  => $this->getMediaFile(),
            'timeunits'  => $this->getTimeUnits(),
            'media'      => $this->getMediaManager()->toArray(),
            'properties' => $properties,
        ];
    }
}
