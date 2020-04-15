<?php
namespace TLA\EAF\Timeslot;

use TLA\EAF\Timeslot\Timeslot;
use TLA\EAF\Timeslot\NotFoundException;
use Ds\Map;

/**
 * Timeslot store
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Store
{
    /**
     * @var Map
     */
    private $store;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->store = new Map();
    }

    /**
     * Add timeslot to store
     *
     * @param string $id
     * @param integer $time
     *
     * @return self
     */
    public function add(string $id, ?int $time = null)
    {
        $this->store->put($id, new Timeslot($id, $time));
        return $this;
    }

    /**
     * Get timeslot if exists
     *
     * @param string $id
     * @return Timeslot
     * @throws Exception
     */
    public function get(string $id): Timeslot
    {
        if ($this->store->hasKey($id)) {
            return $this->store->get($id);
        }

        throw new NotFoundException('Timeslot not found');
    }

    /**
     * Getting internal store iterator
     *
     * @return Map
     */
    public function getStorage(): Map
    {
        return $this->store;
    }

    /**
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        $timeslots = [];

        foreach ($this->getStorage() as $timeslot) {
            $timeslots[] = $timeslot->toArray();
        }

        return $timeslots;
    }
}