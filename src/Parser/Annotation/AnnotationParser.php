<?php
namespace TLA\EAF\Parser\Annotation;

use TLA\EAF\Annotation\Store as AnnotationStore;
use TLA\EAF\Timeslot\Store as TimeslotStore;
use TLA\EAF\Parser\Annotation\AlignableParser;
use TLA\EAF\Parser\Annotation\RefParser;
use TLA\EAF\Annotation\AnnotationInterface;
use SimpleXMLElement;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
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
