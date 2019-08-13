<?php
namespace MPI\EAF\LinguisticType;

use MPI\EAF\Tier\Tier;
use MPI\EAF\Timeslot\Timeslot;
use MPI\EAF\Annotation\RefAnnotation;

/**
 * SymbolicAssociation divides a tier's annotations
 * across the begin and end timeslots
 *
 * - All ref annotations
 * - References alignable annotation
 * - resolve time from top of tree
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class SymbolicAssociation
{
    /**
     * Divide annotation within tier
     *
     * @return void
     */
    public function associate(Tier $tier)
    {
        // symbolic association needs the referenced annotation
        $store = $tier->getAnnotationStore();

        // and finally saving the custom time back into ref annotation
        foreach ($store->getStorage() as $annotation) {

            $referenced = $annotation->getReferencedAnnotation();
            while ($referenced instanceof RefAnnotation) {
                $referenced = $referenced->getReferencedAnnotation();
            }

            $annotation->setCustomStart(new Timeslot('custom-' . $referenced->getStart()->getId(), $referenced->getStart()->getTime()));
            $annotation->setCustomEnd(new Timeslot('custom-' . $referenced->getEnd()->getId(), $referenced->getEnd()->getTime()));
        }
    }
}
