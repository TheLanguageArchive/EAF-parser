<?php
namespace MPI\EAF\Annotation;

use MPI\EAF\Timeslot\NotFoundException;
use Ds\Map;
use Traversable;

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
     * Adding annotation to store
     *
     * @param string              $id
     * @param AnnotationInterface $annotation
     *
     * @return self
     */
    public function add(string $id, AnnotationInterface $annotation): self
    {
        $this->store->put($id, $annotation);
        return $this;
    }

    /**
     * Getting annotation from store
     *
     * @param string $id
     *
     * @return AnnotationInterface
     * @throws NotFoundException
     */
    public function get(string $id): AnnotationInterface
    {
        if ($this->has($id)) {
            return $this->store->get($id);
        }

        throw NotFoundException('Annotation not found');
    }

    /**
     * Check whether annotation exists in store
     *
     * @param string $id
     *
     * @return boolean
     */
    public function has(string $id): bool
    {
        return $this->store->hasKey($id);
    }

    /**
     * Getting internal store iterator
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return $this->store->getIterator();
    }
}
