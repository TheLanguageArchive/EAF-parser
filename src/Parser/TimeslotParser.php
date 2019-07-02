<?php
namespace MPI\EAF\Parser;

use MPI\EAF\Timeslot\Store as TimeslotStore;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class TimeslotParser
{
    /**
     * Parsing timeslot
     *
     * @param SimpleXMLElement $items
     *
     * @return TimeslotStore
     */
    public function parse(SimpleXMLElement $items): TimeslotStore
    {
        $store = new TimeslotStore();

        foreach ($items as $item) {

            $attributes     = $item->attributes();
            $id             = (string)$attributes['TIME_SLOT_ID'];
            $time           = isset($attributes['TIME_VALUE']) ? (int)$attributes['TIME_VALUE'] : null;

            $store->add($id, $time);
        }

        return $store;
    }
}
