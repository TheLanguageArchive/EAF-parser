<?php
namespace TLA\EAF\Decorator;

/**
 * TimeSubdivisionDecorator divides a tier's annotations across the begin and end timeslots
 *
 * - All AlignableAnnotations
 * - Possible empty timeslots
 * - Possible filled timeslots
 * - calculate virtual times of empty timeslots by finding a annotation with actual time
 *   and divide the previous annotations to get their virtual timeslots
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class TimeSubdivisionDecorator
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
        $section  = 0;
        $sections = [];

        foreach ($tier['annotations'] as &$annotation) {

            $sections[$section][] = &$annotation;
            if (null !== $annotation['end']) {
                $section += 1;
            }
        }

        foreach ($sections as $section => $annotations) {

            // getting the first annotation start and end time
            // and calculating the duration by dividing the time with
            // the total of annotations in the store
            $first       = current($annotations);
            $last        = end($annotations);
            $start       = $first['start'];
            $end         = $last['end'];
            $duration    = (($end - $start) / count($annotations));
            $customStart = $start - $duration;
            $customEnd   = $start;

            // and finally saving the custom time back into ref annotation
            foreach ($annotations as &$annotation) {

                $customStart += $duration;
                $customEnd   += $duration;

                if (null === $annotation['start'] || null === $annotation['end']) {

                    $annotation['custom_start'] = $customStart;
                    $annotation['custom_end']   = $customEnd;
                }
            }
        }
    }
}
