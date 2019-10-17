<?php
namespace TLA\EAF;

use TLA\EAF\Media\Media;
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
     * @var Media[]
     */
    private $media;

    /**
     * @var Property[]
     */
    private $properties;

    /**
     * @var Media
     */
    private $video;

    /**
     * @var Media
     */
    private $audio;

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
        $this->video      = null;
        $this->audio      = null;

        // checking for video and audio
        foreach ($this->media as $media) {

            if (false === $media->isAudio()) {
                $this->video = $media;
            }

            if (true === $media->isAudio()) {
                $this->audio = $media;
            }
        }
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
     * Get media items
     *
     * @return Media[]
     */
    public function getMedia(): array
    {
        return $this->media;
    }

    /**
     * Get video media file
     *
     * @return Media|false
     */
    public function getVideo(): ?Media
    {
        return $this->video;
    }

    /**
     * Get audio media file
     *
     * @return Media|false
     */
    public function getAudio(): ?Media
    {
        return $this->audio;
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
            'media'      => $this->getMedia(),
            'video'      => $this->getVideo(),
            'audio'      => $this->getAudio(),
            'properties' => $this->getProperties(),
        ];
    }
}
