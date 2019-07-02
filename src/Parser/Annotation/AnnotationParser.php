<?php
namespace MPI\EAF\Parser\Annotation;

use MPI\EAF\Annotation\Store as AnnotationStore;
use MPI\EAF\Timeslot\Store as TimeslotStore;
use MPI\EAF\Parser\Annotation\AlignableParser;
use MPI\EAF\Parser\Annotation\RefParser;
use SimpleXMLElement;
use MPI\EAF\Annotation\AnnotationInterface;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class AnnotationParser
{
    /**
     * @var TimeslotStore
     */
    private $timeslotStore;

    /**
     * Injecting timeslot store
     *
     * @param TimeslotStore $timeslotStore
     */
    public function __construct(TimeslotStore $timeslotStore)
    {
        $this->timeslotStore = $timeslotStore;
    }

    /**
     * Parsing annotations
     *
     * @param SimpleXMLElement $items
     *
     * @return AnnotationStore
     */
    public function parse(SimpleXMLElement $items): AnnotationStore
    {
        $store = new AnnotationStore();

        foreach ($items as $item) {

            $annotation = $this->parseAnnotation($item);
            $store->add($annotation->getId(), $annotation);
        }

        return $store;
    }

    /**
     * Determine annotation type
     *
     * @param SimpleXMLElement $annotation
     *
     * @return AnnotationInterface
     */
    private function parseAnnotation(SimpleXMLElement $annotation): AnnotationInterface
    {
        if (isset($annotation->ALIGNABLE_ANNOTATION)) {

            $parser = new AlignableParser($this->timeslotStore);
            return $parser->parse($annotation->ALIGNABLE_ANNOTATION);
        }

        if (isset($annotation->REF_ANNOTATION)) {

            $parser = new RefParser();
            return $parser->parse($annotation->REF_ANNOTATION);
        }

        throw new UnknownAnnotationException('Could not parse annotation');
    }
}
