<?php
namespace MPI\EAF;

use MPI\EAF\Timeslot\Store as TimeslotStore;
use MPI\EAF\LinguisticType\Store as LinguisticTypeStore;
use MPI\EAF\Annotation\Store as AnnotationStore;
use MPI\EAF\Annotation\Resolver\RefAnnotationResolver;
use MPI\EAF\Parser\MetadataParser;
use MPI\EAF\Parser\HeaderParser;
use MPI\EAF\Parser\TimeslotParser;
use MPI\EAF\Parser\TierParser;
use MPI\EAF\Parser\LinguisticTypeParser;
use SimpleXMLElement;

/**
 * Parser
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package EAF Parser
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
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Parsing annotations file
     *
     * @return array
     */
    public function parse()
    {
        $contents = simplexml_load_file($this->file);

        $this->timeslotStore       = (new TimeslotParser)->parse($contents->TIME_ORDER->TIME_SLOT);
        $this->linguisticTypeStore = (new LinguisticTypeParser)->parse($contents->LINGUISTIC_TYPE);
        $this->annotationStore     = new AnnotationStore();

        $data = [

            'metadata'  => (new MetadataParser)->parse($contents),
            'header'    => (new HeaderParser)->parse($contents->HEADER),
            'timeslots' => $this->timeslotStore,
            'tiers'     => (new TierParser($this->timeslotStore, $this->annotationStore, $this->linguisticTypeStore))->parse($contents->TIER),
        ];

        $resolver = new RefAnnotationResolver($this->annotationStore);
        $resolver->resolve();

        dump($data['tiers']);exit;
        return $data;
    }
}
