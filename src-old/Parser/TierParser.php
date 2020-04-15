<?php
namespace TLA\EAF\Parser;

use TLA\EAF\Tier\Tier;
use TLA\EAF\LinguisticType\Store as LinguisticTypeStore;
use TLA\EAF\Tier\Store as TierStore;
use TLA\EAF\Timeslot\Store as TimeslotStore;
use TLA\EAF\Annotation\Store as AnnotationStore;
use TLA\EAF\Parser\Annotation\AnnotationParser;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
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

            foreach ($tierAnnotationStores[$id]->getStorage() as $annotation) {
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
