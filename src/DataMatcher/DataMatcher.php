<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataProcessor\DataProcessorCollection;
use FOD\Instruct\DataProcessor\DataProcessorInterface;
use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use Symfony\Component\Validator\Constraint;

/**
 * Base abstract class for Data Matchers.
 */
abstract class DataMatcher implements DataMatcherInterface
{
    /**
     * @var DataProcessorCollection
     */
    protected $subjectProcessors;

    /**
     * @var DataProcessorCollection
     */
    protected $objectProcessors;

    /**
     * @var Constraint
     */
    protected $subjectConstraints;

    /**
     * @var Constraint
     */
    protected $objectConstraints;

    /**
     * @param DataProcessorCollection $subjectProcessors
     * @param DataProcessorCollection $objectProcessors
     * @param Constraint $subjectConstraints
     * @param Constraint $objectConstraints
     */
    public function __construct(
        DataProcessorCollection $subjectProcessors,
        DataProcessorCollection $objectProcessors,
        Constraint $subjectConstraints = null,
        Constraint $objectConstraints = null
    ) {
        $this->subjectProcessors = $subjectProcessors;
        $this->objectProcessors = $objectProcessors;
        $this->subjectConstraints = $subjectConstraints;
        $this->objectConstraints = $objectConstraints;
    }

    /**
     * @param array $subjectProcessors
     * @param array $objectProcessors
     */
    public static function create(array $subjectProcessors = [], array $objectProcessors = [])
    {
        return new static(
            new DataProcessorCollection($subjectProcessors),
            new DataProcessorCollection($objectProcessors)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function match($subject, $object)
    {
        $processedSubject = $this->subjectProcessors->process($subject);
        $processedObject = $this->objectProcessors->process($object);

        return $this->doMatch(
            new DataMatcherArgument($processedSubject, $this->subjectConstraints),
            new DataMatcherArgument($processedObject, $this->objectConstraints)
        );
    }

    /**
     * @param string $id
     * @param DataMatcherField       $field
     * @param DataProcessorInterface $dataProcessor
     */
    protected function setFieldsProcessor($id, DataMatcherField $field, DataProcessorInterface $dataProcessor)
    {
        if ($field->supportsSubject()) {
            $this->subjectProcessors[$id] = $dataProcessor;
        }

        if ($field->supportsObject()) {
            $this->objectProcessors[$id] = $dataProcessor;
        }
    }

    /**
     * @param string $id
     * @param DataMatcherField $field
     */
    protected function removeFieldsProcessor($id, DataMatcherField $field)
    {
        if ($field->supportsSubject()) {
            if (isset($this->subjectProcessors[$id])) {
                unset($this->subjectProcessors[$id]);
            }
        }

        if ($field->supportsObject()) {
            if (isset($this->objectProcessors[$id])) {
                unset($this->objectProcessors[$id]);
            }
        }
    }

    /**
     * Perform the actual matching.
     *
     * @param mixed $subject
     * @param mixed $object
     *
     * @return bool
     */
    abstract protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object);
}
