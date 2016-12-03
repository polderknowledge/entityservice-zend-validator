<?php
/**
 * Polder Knowledge / entityservice-zend-validator (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-zend-validator for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-zend-validator/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Validator;

use PolderKnowledge\EntityService\EntityServiceInterface;
use Zend\Validator\AbstractValidator;

/**
 * Base class for validators using an EntityServiceInterface.
 */
abstract class AbstractEntityValidator extends AbstractValidator
{
    /**
     * EntityService instance used for validation
     *
     * @var EntityServiceInterface
     */
    protected $entityService;

    /**
     * method name that will be called on validation
     *
     * @var string Method to be called
     */
    protected $method = 'findBy';

    /**
     * @var string Name of the field to search
     */
    protected $field = 'id';

    /**
     * Set entity service used for validation
     *
     * @param EntityServiceInterface $entityService
     */
    public function setEntityService(EntityServiceInterface $entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * Sets the method option.
     *
     * @param string $method The name of the method to set.
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Sets the field option.
     *
     * @param string $field The name of the field to set.
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * Will call the configured method on self::$entityService using the value as criteria
     *
     * @param mixed $value
     * @return object
     */
    protected function fetchResult($value)
    {
        return call_user_func_array(
            array(
                $this->entityService,
                $this->method
            ),
            array(
                'criteria' => array($this->field => $value)
            )
        );
    }
}
