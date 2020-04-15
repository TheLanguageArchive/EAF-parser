<?php
namespace TLA\EAF\Decorator;

use TLA\EAF\Parser;
use TLA\EAF\Decorator\AnnotationDecorator;
use TLA\EAF\Sorter\TierAnnotationsSorter;

/**
 * decorating tiers
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class TiersDecorator
{
    /**
     * Decorating tiers
     *
     * @param array $tiers
     * @param array $timeslots
     * @param array $linguisticTypes
     *
     * @return void
     */
    public static function decorate(array &$tiers, array &$timeslots, array &$linguisticTypes)
    {
        $annotations = [];
        foreach ($tiers as &$tier) {

            $tier['linguistic_type'] = $linguisticTypes[$tier['linguistic_type']] ?? null;

            foreach ($tier['annotations'] as &$annotation) {
                $annotations[$annotation['id']] = &$annotation;
            }
        }

        AnnotationsDecorator::decorate($annotations, $timeslots);
    }
}
