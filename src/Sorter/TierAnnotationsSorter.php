<?php
namespace TLA\EAF\Sorter;

use TLA\EAF\Parser;

/**
 * Sorting tier annotations
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class TierAnnotationsSorter
{
    /**
     * Sorting tier
     *
     * @param array $tier
     *
     * @return void
     */
    public static function sort(array &$tier)
    {
        $groupPosition  = 10000000;
        $groupPositions = [];
        $positions      = [];

        foreach ($tier['annotations'] as $annotation) {

            if ($annotation['type'] !== Parser::ANNOTATION_TYPE_REF) {
                continue;
            }

            $group = $annotation['referenced_annotation']['id'];

            if (!isset($groupPositions[$group])) {

                $groupPositions[$group] = $groupPosition;

                $position       = $groupPosition;
                $groupPosition += 10000000;
            }

            $positions[$annotation['id']] = $position;
            $position += 1;
        }

        $unsorted = array_values($tier['annotations']);
        $sorted   = [];

        foreach ($unsorted as $annotation) {

            if ($annotation['type'] !== Parser::ANNOTATION_TYPE_REF) {
                continue;
            }

            if (null === $annotation['previous']) {

                $groupPositions[$annotation['referenced_annotation']['id']] -= 1;
                $positions[$annotation['id']] = $groupPositions[$annotation['referenced_annotation']['id']];

            } else {

                $previousPos = $positions[$annotation['previous']] ?? false;
                $currentPos  = $positions[$annotation['id']] ?? false;

                if (false !== $previousPos && false !== $currentPos) {
                    $positions[$annotation['previous']] = $currentPos - 1;
                }
            }
        }

        foreach ($positions as $id => $position) {
            $sorted[] = $tier['annotations'][$id];
        }

        $tier['annotations'] = $sorted;
    }
}
