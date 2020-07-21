<?php
namespace TLA\EAF\Decorator;

/**
 * SymbolicSubdivisionDecorator divides a tier's annotations across the begin and end timeslots
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
class SymbolicSubdivisionDecorator
{
    /**
     * Divide annotation within tier
     *
     * @param array $tier
     *
     * @return void
     */
    public static function decorate(array &$tier)
    {
        $grouped = [];

        // grouping the subdivisions by ref
        foreach ($tier['annotations'] as &$annotation) {
            $grouped[$annotation['ref']][] = &$annotation;
        }

        foreach ($grouped as &$annotations) {

            // symbolic subdivision needs the referenced annotation
            // to divide the timeslots evenly between the start and end
            $first      = current($annotations);
            $referenced = $first['referenced_annotation'];
            $total      = count($annotations);

            // getting the first annotation start and end time
            // and calculating the duration by dividing the time with
            // the total of annotations in the store
            $duration    = (($referenced['end'] - $referenced['start']) / $total);
            $customStart = $referenced['start'] - $duration;
            $customEnd   = $referenced['start'];

            // and finally saving the custom time back into ref annotation
            foreach ($annotations as &$annotation) {

                $customStart += $duration;
                $customEnd   += $duration;

                $annotation['custom_start'] = $customStart;
                $annotation['custom_end']   = $customEnd;
            }
        }
    }
}
