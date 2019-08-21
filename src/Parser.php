<?php
namespace TLA\EAF;

use TLA\EAF\Eaf;
use TLA\Eaf\Media\MediaResolver;
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
     * @var string
     */
    private $file;

    /**
     * @var MediaResolver
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
     * @param string        $file
     * @param MediaResolver $mediaResolver
     */
    public function __construct($file, MediaResolver $mediaResolver)
    {
        $this->file          = $file;
        $this->mediaResolver = $mediaResolver;
    }

    /**
     * Parsing annotations file
     *
     * @return array
     */
    public function parse(): Eaf
    {
        $contents = simplexml_load_file($this->file);

        $this->timeslotStore       = (new TimeslotParser)->parse($contents->TIME_ORDER->TIME_SLOT);
        $this->linguisticTypeStore = (new LinguisticTypeParser)->parse($contents->LINGUISTIC_TYPE);
        $this->annotationStore     = new AnnotationStore();
        $this->tierStore           = (new TierParser($this->timeslotStore, $this->annotationStore, $this->linguisticTypeStore))->parse($contents->TIER);

        $metadata = (new MetadataParser)->parse($contents);
        $header   = (new HeaderParser($this->mediaResolver))->parse($contents->HEADER);
        $eaf      = new Eaf(

            $metadata,
            $header,
            $this->timeslotStore,
            $this->tierStore
        );

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

        return $eaf;
    }
}
