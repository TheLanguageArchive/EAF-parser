<?php
namespace MPI\EAF\Annotation;

use MPI\EAF\Annotation\AnnotationInterface;
use JsonSerializable;

/**
 * Alignable Annotation Entity
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class RefAnnotation implements AnnotationInterface, JsonSerializable
{
    /** @var string */
    const ANNOTATION_TYPE = 'ref';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $ref;

    /**
     * @var AnnotationInterface|null
     */
    private $referencedAnnotation;

    /**
     * @var string|null
     */
    private $previous;

    /**
     * @var AnnotationInterface|null
     */
    private $previousAnnotation;

    /**
     * Constructor
     *
     * @param string      $id
     * @param string      $value
     * @param string      $ref
     * @param string|null $previous
     */
    public function __construct(string $id, string $value, string $ref, ?string $previous)
    {
        $this->id                   = $id;
        $this->value                = $value;
        $this->ref                  = $ref;
        $this->referencedAnnotation = null;
        $this->previous             = $previous;
        $this->previousAnnotation   = null;
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
     * Get referred annotation
     *
     * @return AnnotationInterface
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * Setting referenced annotation
     *
     * @param AnnotationInterface $annotation
     *
     * @return self
     */
    public function setReferencedAnnotation(AnnotationInterface $annotation): self
    {
        $this->referencedAnnotation = $annotation;
        return $this;
    }

    /**
     * Getting referenced annotation
     *
     * @return AnnotationInterface
     */
    public function getReferencedAnnotation(): ?AnnotationInterface
    {
        return $this->referencedAnnotation;
    }

    /**
     * Get previous annotation
     *
     * @return string|null
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * Setting previous annotation
     *
     * @param AnnotationInterface $annotation
     *
     * @return self
     */
    public function setPreviousAnnotation(AnnotationInterface $annotation): self
    {
        $this->previousAnnotation = $annotation;
        return $this;
    }

    /**
     * Get previous annotation
     *
     * @return AnnotationInterface
     */
    public function getPreviousAnnotation(): ?AnnotationInterface
    {
        return $this->previousAnnotation;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'id'                    => $this->getId(),
            'type'                  => self::ANNOTATION_TYPE,
            'value'                 => $this->getValue(),
            'ref'                   => $this->getRef(),
            'referenced_annotation' => $this->getReferencedAnnotation(),
            'previous'              => $this->getPrevious(),
            'previous_annotation'   => $this->getPreviousAnnotation(),
        ];
    }
}
