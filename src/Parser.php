<?php
namespace TLA\EAF;

use TLA\EAF\Eaf;
use TLA\EAF\Media\Resolver;
use TLA\EAF\Timeslot\Store as TimeslotStore;
use TLA\EAF\LinguisticType\Store as LinguisticTypeStore;
use TLA\EAF\Annotation\Store as AnnotationStore;
use TLA\EAF\Annotation\Resolver\RefAnnotationResolver;
use TLA\EAF\Parser\MetadataParser;
use TLA\EAF\Parser\HeaderParser;
use TLA\EAF\Parser\TimeslotParser;
use TLA\EAF\Parser\TierParser;
use TLA\EAF\Parser\LinguisticTypeParser;
use TLA\EAF\Annotation\Sorter;
use TLA\EAF\LinguisticType\SymbolicSubdivision;
use TLA\EAF\LinguisticType\SymbolicAssociation;
use TLA\EAF\LinguisticType\TimeSubdivision;
use SimpleXMLElement;

/**
 * Parser
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Parser
{
    /** @var string */
    const ANNOTATION_TYPE_ALIGNABLE            = 'alignable';

    /** @var string */
    const ANNOTATION_TYPE_REF                  = 'ref';

    /** @var string */
    const LINGUISTIC_TYPE_SYMBOLIC_ASSOCIATION = 'Symbolic_Association';

    /** @var string */
    const LINGUISTIC_TYPE_TIME_SUBDIVISION     = 'Time_Subdivision';

    /** @var string */
    const LINGUISTIC_TYPE_SYMBOLIC_SUBDIVISION = 'Symbolic_Subdivision';

    /** @var string */
    const LINGUISTIC_TYPE_INCLUDED_IN          = 'Included_In';

    /**
     * @var SimpleXMLElement
     */
    private $annotation;

    /**
     * @var Resolver
     */
    private $mediaResolver;

    /**
     * @var TimeslotStore
     */
    private $timeslotStore;

    /**
     * @var AnnotationStore
     */
    private $annotationStore;

    /**
     * @var LinguisticTypeStore
     */
    private $linguisticTypeStore;

    /**
     * Constructor
     *
     * @param SimpleXMLElement $annotation
     * @param Resolver         $mediaResolver
     */
    public function __construct(SimpleXMLElement $annotation, Resolver $mediaResolver)
    {
        $this->annotation    = $annotation;
        $this->mediaResolver = $mediaResolver;
    }

    /**
     * Parsing annotations file
     *
     * @return array
     */
    public function parse(): Eaf
    {
        $eaf = $this->createEaf();
        $this->normalize();

        return $eaf;
    }

    /**
     * Creating eaf and storing data in stores
     *
     * @return Eaf
     */
    private function createEaf(): Eaf
    {
        $this->timeslotStore       = (new TimeslotParser)->parse($this->annotation->TIME_ORDER->TIME_SLOT);
        $this->linguisticTypeStore = (new LinguisticTypeParser)->parse($this->annotation->LINGUISTIC_TYPE);
        $this->annotationStore     = new AnnotationStore();
        $this->tierStore           = (new TierParser($this->timeslotStore, $this->annotationStore, $this->linguisticTypeStore))->parse($this->annotation->TIER);

        $metadata = (new MetadataParser)->parse($this->annotation);
        $header   = (new HeaderParser($this->mediaResolver))->parse($this->annotation->HEADER);

        return new Eaf(

            $metadata,
            $header,
            $this->timeslotStore,
            $this->tierStore
        );
    }

    /**
     * Normalizing data:
     * - resolving references
     * - sorting
     * - associating
     * - fixing timestamps
     *
     * @return void
     */
    private function normalize()
    {
        $resolver = new RefAnnotationResolver($this->annotationStore);
        $resolver->resolve();

        foreach ($this->tierStore->getStorage() as $tier) {

            if ($tier->getLinguisticType() === self::LINGUISTIC_TYPE_SYMBOLIC_SUBDIVISION) {

                $sorter = new Sorter();
                $sorter->sort($tier);

                $subdivision = new SymbolicSubdivision();
                $subdivision->divide($tier);
            }

            if ($tier->getLinguisticType() === self::LINGUISTIC_TYPE_SYMBOLIC_ASSOCIATION) {

                $association = new SymbolicAssociation();
                $association->associate($tier);
            }

            if ($tier->getLinguisticType() === self::LINGUISTIC_TYPE_TIME_SUBDIVISION) {

                $subdivision = new TimeSubdivision();
                $subdivision->divide($tier);
            }
        }
    }
}
