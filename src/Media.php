<?php
namespace MPI\EAF;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Media
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
}
