<?php
namespace MPI\EAF\LinguisticType;

use Ds\Map;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
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
     * Adding linguistic type to store
     *
     * @param string $id
     * @param string $constraints
     *
     * @return self
     */
    public function add(string $id, string $constraints)
    {
        $this->store->put($id, $constraints);
        return $this;
    }

    /**
     * Getting linguistic type constraints
     *
     * @param string $id
     *
     * @return string
     * @throws NotFoundException
     */
    public function get(string $id): string
    {
        if ($this->store->hasKey($id)) {
            return $this->store->get($id);
        }

        throw new NotFoundException('Linguistic type not found for Id = ' . $id);
    }
}
