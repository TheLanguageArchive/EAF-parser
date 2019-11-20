<?php
namespace TLA\EAF\Media;

use JsonSerializable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Media implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $mimetype;

    /**
     * @var string
     */
    private $relative;

    /**
     * @var boolean
     */
    private $audio;

    /**
     * Constructor
     *
     * @param integer $id
     * @param string  $filename
     * @param string  $url
     * @param string  $mimetype
     * @param string  $relative
     * @param boolean $audio
     */
    public function __construct(int $id, string $filename, string $url, string $mimetype, string $relative, bool $audio)
    {
        $this->id       = $id;
        $this->filename = $filename;
        $this->url      = $url;
        $this->mimetype = $mimetype;
        $this->relative = $relative;
        $this->audio    = $audio;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get mime type
     *
     * @return string
     */
    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    /**
     * Set mimetype
     *
     * @param string $mimetype
     *
     * @return self
     */
    public function setMimetype(string $mimetype): self
    {
        $this->mimetype = $mimetype;
        return $this;
    }

    /**
     * @return string
     */
    public function getRelative(): string
    {
        return $this->relative;
    }

    /**
     * @return boolean
     */
    public function isAudio(): bool
    {
        return $this->audio;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'id'       => $this->getId(),
            'filename' => $this->getFilename(),
            'url'      => $this->getUrl(),
            'mimetype' => $this->getMimetype(),
            'relative' => $this->getRelative(),
            'audio'    => $this->isAudio(),
        ];
    }
}
