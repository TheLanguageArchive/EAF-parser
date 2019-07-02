<?php
namespace MPI\EAF;

use DateTime;

/**
 * Metadata entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah.mpi.nl>
 * @package MPI EAF Parser
 */
class Metadata
{
    /**
     * @var string
     */
    private $author;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $version;

    /**
     * Constructor
     *
     * @param string   $author
     * @param DateTime $date
     * @param string   $format
     * @param string   $version
     */
    public function __construct(string $author, DateTime $date, string $format, string $version)
    {
        $this->author  = $author;
        $this->date    = $date;
        $this->format  = $format;
        $this->version = $version;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}
