<?php
namespace MPI\EAF\Tier;

use Ds\Map;
use MPI\EAF\Tier\NotFoundException;
use JsonSerializable;
use Traversable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Store implements JsonSerializable
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
     * Adding tier to store
     *
     * @param string $id
     * @param Tier   $tier
     *
     * @return self
     */
    public function add(string $id, Tier $tier): self
    {
        $this->store->put($id, $tier);
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return Tier
     */
    public function get(string $id): Tier
    {
        if ($this->store->hasKey($id)) {
            return $this->store->get($id);
        }

        throw new NotFoundException('Tier was not found');
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
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $tiers = [];

        foreach ($this->getStorage() as $tier) {
            $tiers[] = $tier;
        }

        return $tiers;
    }
}
