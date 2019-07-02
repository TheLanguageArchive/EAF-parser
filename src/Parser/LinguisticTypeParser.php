<?php
namespace MPI\EAF\Parser;

use MPI\EAF\LinguisticType\Store as LinguisticTypeStore;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class LinguisticTypeParser
{
    /**
     * Parsing linguistic type store
     *
     * @param SimpleXMLElement $items
     *
     * @return LinguisticTypeStore
     */
    public function parse(SimpleXMLElement $items): LinguisticTypeStore
    {
        $store = new LinguisticTypeStore();

        foreach ($items as $item) {

            $attributes = $item->attributes();
            $id         = (string)$attributes['LINGUISTIC_TYPE_ID'];

            if (!isset($attributes['CONSTRAINTS'])) {
                $store->add($id, 'toplevel');
            } else {
                $store->add($id, (string)$attributes['CONSTRAINTS']);
            }
        }

        return $store;
    }
}
