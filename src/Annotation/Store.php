<?php
namespace MPI\EAF\Annotation;

use MPI\EAF\Timeslot\NotFoundException;
use Ds\Map;
use Traversable;
use JsonSerializable;

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
     * Adding multiple values
     *
     * @param array $values
     *
     * @return self
     */
    public function addMultiple(array $values): self
    {
        $this->store->putAll($values);
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
     * Clearing internal store
     *
     * @return self
     */
    public function clear(): self
    {
        $this->store->clear();
        return $this;
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

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $annotations = [];

        foreach ($this->getIterator() as $annotation) {
            $annotations[] = $annotation;
        }

        return $annotations;
    }
}
