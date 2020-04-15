<?php
namespace TLA\EAF\Tier;

use TLA\EAF\Annotation\Store as AnnotationStore;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
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
    public function __construct(string $id, string $locale, AnnotationStore $annotationStore, string $linguisticType, ?string $parent = null)
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
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'id'              => $this->getId(),
            'locale'          => $this->getLocale(),
            'annotations'     => $this->getAnnotationStore()->toArray(),
            'linguistic_type' => $this->getLinguisticType(),
        ];
    }
}
