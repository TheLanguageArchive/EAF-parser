<?php
namespace MPI\EAF\Annotation;

use MPI\EAF\Tier\Tier;
use Ds\Vector;

/**
 * Sorting annotation stores of tiers
 */
class Sorter
{
    /**
     * Sorting tier
     *
     * @param Tier $tier
     *
     * @return Tier
     */
    public function sort(Tier $tier): Tier
    {
        $store = $tier->getAnnotationStore();
        $vector = new Vector();

        foreach ($store->getStorage() as $annotation) {
            $vector->push($annotation);
        }

        foreach ($vector as $key => $item) {

            $vector->remove($vector->find($item));

            if (null === $item->getPreviousAnnotation()) {
                $vector->unshift($item);
            } else {

                $prevPosition = $vector->find($item->getPreviousAnnotation());
                $vector->insert($prevPosition + 1, $item);
            }
        }

        $store->clear();
        $store->addMultiple($vector->toArray());

        return $tier;
    }
}
