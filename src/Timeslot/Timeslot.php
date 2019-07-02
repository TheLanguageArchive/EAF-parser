<?php
namespace MPI\EAF\Timeslot;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Timeslot
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
    public function __construct(string $id, int $time = null)
    {
        $this->id   = $id;
        $this->time = $time;
    }

    /**
     * Get time
     *
     * @return integer|null
     */
    public function getTime()
    {
        return $this->time;
    }
}
