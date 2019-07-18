<?php
namespace MPI\EAF\LinguisticType;

use MPI\EAF\Tier\Tier;
use MPI\EAF\Timeslot\Timeslot;
use MPI\EAF\Annotation\AlignableAnnotation;

/**
 * SymbolicSubdivision divides a tier's annotations
 * across the begin and end timeslots
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
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
        $referenced = $first->getReferencedAnnotation();
        $store      = $tier->getAnnotationStore();
        $total      = $store->count();

        // getting the first annotation start and end time
        // and calculating the duration by dividing the time with
        // the total of annotations in the store
        $start       = $referenced->getStart();
        $end         = $referenced->getEnd();
        $duration    = (($end->getTime() - $start->getTime()) / $total);
        $customStart = -300;
        $customEnd   = 0;

        // and finally saving the custom time back into ref annotation
        foreach ($store->getStorage() as $annotation) {

            $customStart += $duration;
            $customEnd   += $duration;

            $referenced  = $annotation->getReferencedAnnotation();

            $annotation->setCustomStart(new Timeslot('custom-' . $referenced->getStart()->getId(), $customStart));
            $annotation->setCustomEnd(new Timeslot('custom-' . $referenced->getEnd()->getId(), $customEnd));

        }
    }
}
