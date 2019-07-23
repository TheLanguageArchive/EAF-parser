<?php
namespace MPI\EAF\LinguisticType;

use MPI\EAF\Tier\Tier;
use MPI\EAF\Timeslot\Timeslot;
use Ds\Map;

/**
 * TimeSubdivision divides a tier's annotations
 * across the begin and end timeslots
 *
 * - All AlignableAnnotations
 * - Possible empty timeslots
 * - Possible filled timeslots
 * - calculate virtual times of empty timeslots by finding a annotation with actual time
 *   and divide the previous annotations to get their virtual timeslots
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class TimeSubdivision
{
    /**
     * Divide annotation within tier
     *
     * @param Tier $tier
     *
     * @return void
     */
    public function divide(Tier $tier)
    {
        $store    = $tier->getAnnotationStore();
        $section  = 0;
        $sections = [];

        foreach ($store->getStorage() as $annotation) {

            if (!isset($sections[$section])) {
                $sections[$section] = new Map();
            }

            $sections[$section]->put($annotation->getId(), $annotation);
            if (null !== $annotation->getEnd()->getTime()) {
                $section += 1;
            }
        }

        foreach ($sections as $section => $annotations) {

            // getting the first annotation start and end time
            // and calculating the duration by dividing the time with
            // the total of annotations in the store
            $start       = $annotations->first()->value->getStart();
            $end         = $annotations->last()->value->getEnd();
            $duration    = (($end->getTime() - $start->getTime()) / $annotations->count());
            $customStart = $start->getTime() - $duration;
            $customEnd   = $start->getTime();

            // and finally saving the custom time back into ref annotation
            foreach ($annotations as $annotation) {

                $customStart += $duration;
                $customEnd   += $duration;

                if (null === $annotation->getStart()->getTime() || null === $annotation->getEnd()->getTime()) {

                    $annotation->setCustomStart(new Timeslot('custom-' . $annotation->getStart()->getId(), $customStart));
                    $annotation->setCustomEnd(new Timeslot('custom-' . $annotation->getEnd()->getId(), $customEnd));
                }
            }
        }
    }
}
