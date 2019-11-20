<?php
namespace TLA\EAF;

use TLA\EAF\Media\Manager;
use TLA\EAF\Property;
use JsonSerializable;

/**
 * Header entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Header implements JsonSerializable
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
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'mediafile'  => $this->getMediaFile(),
            'timeunits'  => $this->getTimeUnits(),
            'media'      => $this->getMediaManager(),
            'properties' => $this->getProperties(),
        ];
    }
}
