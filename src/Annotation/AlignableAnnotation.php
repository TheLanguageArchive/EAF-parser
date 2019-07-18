<?php
namespace MPI\EAF\Annotation;

use MPI\EAF\Annotation\AnnotationInterface;
use MPI\EAF\Timeslot\Timeslot;
use JsonSerializable;

/**
 * Alignable Annotation Entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class AlignableAnnotation implements AnnotationInterface, JsonSerializable
{
    /** @var string */
    const ANNOTATION_TYPE = 'alignable';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var Timeslot
     */
    private $start;

    /**
     * @var Timeslot
     */
    private $end;

    /**
     * Constructor
     *
     * @param string   $id
     * @param string   $value
     * @param Timeslot $start
     * @param Timeslot $end
     */
    public function __construct(string $id, string $value, Timeslot $start, Timeslot $end)
    {
        $this->id    = $id;
        $this->value = $value;
        $this->start = $start;
        $this->end   = $end;
    }

    /**
     * Get Annotation Id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get annotation value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get start of timeslot
     *
     * @return Timeslot
     */
    public function getStart(): Timeslot
    {
        return $this->start;
    }

    /**
     * Get end of timeslot
     *
     * @return Timeslot
     */
    public function getEnd(): Timeslot
    {
        return $this->end;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'id'    => $this->getId(),
            'type'  => self::ANNOTATION_TYPE,
            'value' => $this->getValue(),
            'start' => $this->getStart(),
            'end'   => $this->getEnd(),
        ];
    }
}
