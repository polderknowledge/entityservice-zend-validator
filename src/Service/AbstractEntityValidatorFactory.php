<?php // @codingStandardsIgnoreFile
/**
 * Polder Knowledge / entityservice-zend-validator (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-zend-validator for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-zend-validator/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Validator\Service;

use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use PolderKnowledge\EntityService\EntityServiceInterface;
use RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\ValidatorInterface;

// @codeCoverageIgnoreStart
if (!interface_exists('Zend\ServiceManager\MutableCreationOptionsInterface')) {
    interface NewInterface { }
    class_alias(NewInterface::class, 'Zend\ServiceManager\MutableCreationOptionsInterface', false);
}
// @codeCoverageIgnoreEnd

/**
 * Base class for Entity validator Factories.
 * Contains a until method to create the EntityService Required for these validators
 */
abstract class AbstractEntityValidatorFactory implements
    FactoryInterface,
    \Zend\ServiceManager\MutableCreationOptionsInterface
{
    protected $options = [];

    /**
     * Uses the EntityServiceManager to fetch an EntityService for the entity set in the options array.
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options The options passed to the service manager.
     * @return ValidatorInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!$options || !is_array($options)) {
            throw new InvalidArgumentException('You must provide options in order to create the validator.');
        }

        if (!array_key_exists('entity', $options)) {
            throw new RuntimeException('The "entity" option is required when creating the validator.');
        }

        $entityService = $this->createEntityService($container, $options['entity']);

        return $this->createValidator($entityService, $options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // @codeCoverageIgnoreStart
        if (method_exists($serviceLocator, 'getServiceLocator')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        // @codeCoverageIgnoreEnd

        $validator = $this($serviceLocator, '', $this->options);

        $this->options = null;

        return $validator;
    }

    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Fetches a EntityServiceInterface instance from the EntityServiceManager
     *
     * @param ContainerInterface $container
     * @param string $entityName
     * @return EntityServiceInterface
     */
    protected function createEntityService(ContainerInterface $container, $entityName)
    {
        $entityServiceManager = $container->get('EntityServiceManager');

        return $entityServiceManager->get($entityName);
    }

    abstract protected function createValidator(EntityServiceInterface $entityService, array $options = null);
}
