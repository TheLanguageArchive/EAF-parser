<?php
namespace TLA\EAF;

use TLA\EAF\Metadata;
use TLA\EAF\Header;
use TLA\EAF\Timeslot\Store as TimeslotStore;
use TLA\EAF\Tier\Store as TierStore;
use JsonSerializable;

/**
 * Eaf entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Eaf implements JsonSerializable
{
    /**
     * @var Metadata
     */
    private $metadata;

    /**
     * @var Header
     */
    private $header;

    /**
     * @var TimeslotStore
     */
    private $timeslotStore;

    /**
     * @var TierStore
     */
    private $tierStore;

    /**
     * Constructor
     *
     * @param Metadata      $metadata
     * @param Header        $header
     * @param TimeslotStore $timeslotStore
     * @param TierStore     $tierStore
     */
    public function __construct(Metadata $metadata, Header $header, TimeslotStore $timeslotStore, TierStore $tierStore)
    {
        $this->metadata      = $metadata;
        $this->header        = $header;
        $this->timeslotStore = $timeslotStore;
        $this->tierStore     = $tierStore;
    }

    /**
     * Getting Metadata
     *
     * @return Metadata
     */
    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    /**
     * Getting Header
     *
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * Getting timeslot store
     *
     * @return TimeslotStore
     */
    public function getTimeslotStore(): TimeslotStore
    {
        return $this->timeslotStore;
    }

    /**
     * Getting tiers store
     *
     * @return TierStore
     */
    public function getTierStore(): TierStore
    {
        return $this->tierStore;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'metadata'  => $this->getMetadata(),
            'header'    => $this->getHeader(),
            'timeslots' => $this->getTimeslotStore(),
            'tiers'     => $this->getTierStore(),
        ];
    }
}
