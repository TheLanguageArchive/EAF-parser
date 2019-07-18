<?php
namespace MPI\EAF\Timeslot;

use JsonSerializable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Timeslot implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var integer|null
     */
    private $time;

    /**
     * Constructor
     *
     * @param string       $id
     * @param integer|null $time
     */
    public function __construct(string $id, ?int $time = null)
    {
        $this->id   = $id;
        $this->time = $time;
    }

    /**
     * Get Id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get time
     *
     * @return integer|null
     */
    public function getTime(): ?int
    {
        return $this->time;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'id'          => $this->getId(),
            'time'        => $this->getTime(),
        ];
    }
}
