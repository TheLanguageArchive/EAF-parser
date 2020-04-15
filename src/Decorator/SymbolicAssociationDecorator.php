<?php
namespace TLA\EAF\Decorator;

/**
 * SymbolicAssociationDecorator divides a tier's annotations across the begin and end timeslots
 *
 * - All ref annotations
 * - References alignable annotation
 * - resolve time from top of tree
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class SymbolicAssociationDecorator
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
        foreach ($tier['annotations'] as &$annotation) {

            $annotation['custom_start'] = $annotation['referenced_annotation']['start'];
            $annotation['custom_end']   = $annotation['referenced_annotation']['end'];
        }
    }
}
