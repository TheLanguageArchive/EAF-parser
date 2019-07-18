<?php
namespace MPI\EAF\Annotation\Resolver;

use MPI\EAF\Annotation\Store as AnnotationStore;
use MPI\EAF\Annotation\RefAnnotation;

/**
 * Resolving references in annotation store
 *
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class RefAnnotationResolver
{
    /**
     * @var AnnotationStore
     */
    private $annotationStore;

    /**
     * Injecting annotation store
     *
     * @param AnnotationStore $annotationStore
     */
    public function __construct(AnnotationStore $annotationStore)
    {
        $this->annotationStore = $annotationStore;
    }

    /**
     * Resolving references
     *
     * @return void
     */
    public function resolve()
    {
        foreach ($this->annotationStore->getStorage() as $annotation) {

            if ($annotation instanceof RefAnnotation) {

                if (null !== $annotation->getRef() && $this->annotationStore->has($annotation->getRef())) {
                    $annotation->setReferencedAnnotation($this->annotationStore->get($annotation->getRef()));
                }

                if (null !== $annotation->getPrevious() && $this->annotationStore->has($annotation->getPrevious())) {
                    $annotation->setPreviousAnnotation($this->annotationStore->get($annotation->getPrevious()));
                }
            }
        }
    }
}
