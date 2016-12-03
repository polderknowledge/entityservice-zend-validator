<?php
/**
 * Polder Knowledge / entityservice-zend-validator (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-zend-validator for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-zend-validator/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Validator\Service;

use PolderKnowledge\EntityService\EntityServiceInterface;
use PolderKnowledge\EntityService\Validator\EntityExists;

/**
 * Factory for EntityExists validator.
 */
final class EntityExistsFactory extends AbstractEntityValidatorFactory
{
    protected function createValidator(EntityServiceInterface $entityService, array $options = null)
    {
        $validator = new EntityExists($options);

        $validator->setEntityService($entityService);

        return $validator;
    }
}
