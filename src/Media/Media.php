<?php
namespace MPI\EAF\Media;

use JsonSerializable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Media implements JsonSerializable
{
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
     * Constructor
     *
     * @param string $url
     * @param string $mimetype
     * @param string $relative
     */
    public function __construct(string $url, string $mimetype, string $relative)
    {
        $this->url      = $url;
        $this->mimetype = $mimetype;
        $this->relative = $relative;
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
     * @return string
     */
    public function getRelative(): string
    {
        return $this->relative;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'url'      => $this->getUrl(),
            'mimetype' => $this->getMimetype(),
            'relative' => $this->getRelative(),
        ];
    }
}
