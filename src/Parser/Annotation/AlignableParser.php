<?php
namespace MPI\EAF\Parser\Annotation;

use SimpleXMLElement;
use MPI\EAF\Annotation\AlignableAnnotation;
use MPI\EAF\Timeslot\Store;
use MPI\EAF\Timeslot\NotFoundException;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class AlignableParser
{
    /**
     * Injecting timeslot store
     *
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Parse alignable annotation
     *
     * @param SimpleXMLElement $annotation
     *
     * @return AlignableAnnotation
     * @throws NotFoundException
     */
    public function parse(SimpleXMLElement $annotation): AlignableAnnotation
    {
        $attributes = $annotation->attributes();

        $start = $this->store->get((string)$attributes['TIME_SLOT_REF1']);
        $end   = $this->store->get((string)$attributes['TIME_SLOT_REF2']);

        return new AlignableAnnotation(

            (string)$attributes['ANNOTATION_ID'],
            (string)$annotation->ANNOTATION_VALUE,
            $start,
            $end
        );
    }
}
