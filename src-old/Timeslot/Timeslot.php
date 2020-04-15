<?php
namespace TLA\EAF\Timeslot;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
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
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'id'          => $this->getId(),
            'time'        => $this->getTime(),
        ];
    }
}
