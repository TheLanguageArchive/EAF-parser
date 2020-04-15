<?php
namespace TLA\EAF\LinguisticType;

use TLA\EAF\Annotation\RefAnnotation;
use TLA\EAF\Annotation\AlignableAnnotation;
use TLA\EAF\Annotation\AnnotationInterface;
use TLA\EAF\Tier\Tier;
use TLA\EAF\Timeslot\Timeslot;

/**
 * SymbolicSubdivision divides a tier's annotations
 * across the begin and end timeslots
 *
 * - All ref annotations
 * - References alignable annotation
 * - "previous_annotation" determines order
 * - group ref annotations by annotation_ref
 * - resolve time from top of tree
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class SymbolicSubdivision
{
    /**
     * Divide annotation within tier
     *
     * @return void
     */
    public function divide(Tier $tier)
    {
        // symbolic subdivision needs the referenced annotation
        // to divide the timeslots evenly between the start and end
        $first      = $tier->getAnnotationStore()->first();
        $referenced = $this->getReferencedAnnotation($first);
        $store      = $tier->getAnnotationStore();
        $total      = $store->count();

        // getting the first annotation start and end time
        // and calculating the duration by dividing the time with
        // the total of annotations in the store
        $start       = $referenced->getStart();
        $end         = $referenced->getEnd();
        $duration    = (($end->getTime() - $start->getTime()) / $total);
        $customStart = -$duration;
        $customEnd   = 0;

        // and finally saving the custom time back into ref annotation
        foreach ($store->getStorage() as $annotation) {

            $customStart += $duration;
            $customEnd   += $duration;

            $referenced  = $this->getReferencedAnnotation($annotation);

            $annotation->setCustomStart(new Timeslot('custom-' . $referenced->getStart()->getId(), $customStart));
            $annotation->setCustomEnd(new Timeslot('custom-' . $referenced->getEnd()->getId(), $customEnd));
        }
    }

    /**
     * Get referenced annotation
     *
     * @param AnnotationInterface $annotation
     *
     * @return AnnotationInterface
     */
    public function getReferencedAnnotation(AnnotationInterface $annotation)
    {
        $referenced = $annotation->getReferencedAnnotation();
        if ($referenced instanceof AlignableAnnotation) {
            return $referenced;
        }
         if ($referenced instanceof RefAnnotation) {
            return $referenced->getReferencedAnnotation();
        }
    }
}
