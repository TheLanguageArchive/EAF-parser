<?php
namespace TLA\EAF\Decorator;

use TLA\EAF\Parser;

/**
 * decorating annotations
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class AnnotationsDecorator
{
    /**
     * Decorating annotations
     *
     * @param array $annotations
     * @param array $timeslots
     *
     * @return void
     */
    public static function decorate(array &$annotations, array &$timeslots)
    {
        foreach ($annotations as &$annotation) {

            $annotation['custom_start'] = null;
            $annotation['custom_end']   = null;

            if ($annotation['type'] === Parser::ANNOTATION_TYPE_REF) {

                $id = self::findReference($annotations, $annotation['ref']);
                $annotation['referenced_annotation'] = &$annotations[$id] ?? null;
            }

            if ($annotation['type'] === Parser::ANNOTATION_TYPE_ALIGNABLE) {

                $annotation['start'] = $timeslots[$annotation['start']] ?? null;
                $annotation['end']   = $timeslots[$annotation['end']] ?? null;
            }
        }
    }

    /**
     * Recursively finding referenced annotation or null
     *
     * @param array  $annotations
     * @param string $ref
     *
     * @return string|null
     */
    public static function findReference(&$annotations, $ref)
    {
        if (trim($ref) === '' || !isset($annotations[$ref])) {
            return null;
        }

        if ($annotations[$ref]['type'] === Parser::ANNOTATION_TYPE_ALIGNABLE) {
            return $annotations[$ref]['id'];
        }

        if ($annotations[$ref]['type'] === Parser::ANNOTATION_TYPE_REF) {
            return self::findReference($annotations, $annotations[$ref]['ref']);
        }

        return null;
    }
}
