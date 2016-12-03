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
 * The EntityExists validator will validate a certain entity was found. Validation will
 * fail when the entity is not present
 */
class EntityExists extends AbstractEntityValidator
{
    /**
     * Error constants
     */
    const ERROR_NO_OBJECT_FOUND = 'noObjectFound';

    /**
     * @var array Message templates
     */
    protected $messageTemplates = array(
        self::ERROR_NO_OBJECT_FOUND => "No object matching '%value%' was found",
    );

    /**
     * Returns true when $this->entityService returns an entity
     * when $this->method is called with the given criteria
     *
     * @param  mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        $result = $this->fetchResult($value);

        // The following code will check if we have a valid result. In case of an empty array (we did not get a valid
        // match) the not-operator will result to true, causing the error to be set. In case of a null value (no object
        // has been found), the not-operator will also result to true.
        if (!$result) {
            $this->error(self::ERROR_NO_OBJECT_FOUND, $value);
            return false;
        }

        return true;
    }
}
