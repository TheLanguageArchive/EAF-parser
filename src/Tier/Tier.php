<?php
namespace MPI\EAF\Tier;

use MPI\EAF\Annotation\Store as AnnotationStore;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Tier
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var AnnotationStore
     */
    private $annotationStore;

    /**
     * @var string
     */
    private $linguisticType;

    /**
     * @var string|null
     */
    private $parent;

    /**
     * Tier Entity
     *
     * @param string          $id
     * @param string          $locale
     * @param AnnotationStore $annotationStore
     * @param string          $linguisticType
     * @param string|null     $parent
     */
    public function __construct(string $id, string $locale, AnnotationStore $annotationStore, string $linguisticType, string $parent = null)
    {
        $this->id              = $id;
        $this->locale          = $locale;
        $this->annotationStore = $annotationStore;
        $this->linguisticType  = $linguisticType;
        $this->parent          = $parent;
    }

    /**
     * Get tier ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get tier locale
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Get annotation store
     *
     * @return AnnotationStore
     */
    public function getAnnotationStore(): AnnotationStore
    {
        return $this->annotationStore;
    }

    /**
     * Get linguistic type
     *
     * @return string
     */
    public function getLinguisticType(): string
    {
        return $this->linguisticType;
    }

    /**
     * Get parent tier ID
     *
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }
}
