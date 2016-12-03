<?php
/**
 * Polder Knowledge / entityservice-zend-validator (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-zend-validator for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-zend-validator/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Validator;

/**
 * The EntityNotExists validator will validate a certain entity was found.
 * Validation will fail when the entity is present
 */
class EntityNotExists extends AbstractEntityValidator
{
    /**
     * Error constants
     */
    const ERROR_OBJECT_FOUND = 'objectFound';

    /**
     * @var array Message templates
     */
    protected $messageTemplates = array(
        self::ERROR_OBJECT_FOUND => "Object matching '%value%' was found",
    );

    /**
     * Returns true when $this->entityService returns an empty result
     * when $this->method is called with the given criteria
     *
     * @param mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        $result = $this->fetchResult($value);

        // A filled array or an object both pass this test causing the error to be set. An empty array or a null value
        // will cause the if check to return false. Meaning no error will be set.
        if ($result) {
            $this->error(self::ERROR_OBJECT_FOUND, $value);
            return false;
        }

        return true;
    }
}
