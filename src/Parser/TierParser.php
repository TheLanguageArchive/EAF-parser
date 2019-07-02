<?php
namespace MPI\EAF\Parser;

use MPI\EAF\Tier\Tier;
use MPI\EAF\LinguisticType\Store as LinguisticTypeStore;
use MPI\EAF\Tier\Store as TierStore;
use MPI\EAF\Timeslot\Store as TimeslotStore;
use MPI\EAF\Annotation\Store as AnnotationStore;
use MPI\EAF\Parser\Annotation\AnnotationParser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class TierParser
{
    /**
     * @var TimeslotStore
     */
    private $timeslotStore;

    /**
     * @var AnnotationStore
     */
    private $annotationStore;

    /**
     * @var LinguisticTypeStore
     */
    private $linguisticTypeStore;

    /**
     * Injecting LinguisticTypeStore
     *
     * @param TimeslotStore       $timeslotStore
     * @param AnnotationStore     $annotationStore
     * @param LinguisticTypeStore $linguisticTypeStore
     */
    public function __construct(TimeslotStore $timeslotStore, AnnotationStore $annotationStore, LinguisticTypeStore $linguisticTypeStore)
    {
        $this->timeslotStore       = $timeslotStore;
        $this->annotationStore     = $annotationStore;
        $this->linguisticTypeStore = $linguisticTypeStore;
    }

    /**
     * Parsing tiers
     *
     * @param SimpleXMLElement $tiers
     *
     * @return TierStore
     */
    public function parse(SimpleXMLElement $items): TierStore
    {
        $store                = new TierStore();
        $tierAnnotationStores = [];

        foreach ($items as $item) {

            $attributes = $item->attributes();
            $id         = (string)$attributes['TIER_ID'];

            $tierAnnotationStores[$id] = (new AnnotationParser($this->timeslotStore))->parse($item->ANNOTATION);

            foreach ($tierAnnotationStores[$id]->getIterator() as $annotation) {
                $this->annotationStore->add($annotation->getId(), $annotation);
            }
        }

        foreach ($items as $item) {

            $attributes        = $item->attributes();
            $id                = (string)$attributes['TIER_ID'];
            $linguisticTypeRef = (string)$attributes['LINGUISTIC_TYPE_REF'];
            $parent            = isset($attributes['PARENT_REF']) ? (string)$attributes['PARENT_REF'] : null;

            $tier = new Tier(

                $id,
                (string)$attributes['DEFAULT_LOCALE'],
                $tierAnnotationStores[$id],
                $this->linguisticTypeStore->get($linguisticTypeRef),
                $parent
            );


            $store->add($id, $tier);
        }

        return $store;
    }
}
