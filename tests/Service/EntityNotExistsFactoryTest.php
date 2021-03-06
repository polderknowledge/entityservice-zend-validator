<?php
/**
 * Polder Knowledge / entityservice-zend-validator (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-zend-validator for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-zend-validator/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest\Validator\Service;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\EntityServiceInterface;
use PolderKnowledge\EntityService\Service\EntityServiceManager;
use PolderKnowledge\EntityService\Validator\EntityNotExists;
use PolderKnowledge\EntityService\Validator\Service\EntityNotExistsFactory;

class EntityNotExistsFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Validator\Service\EntityNotExistsFactory::createValidator
     */
    public function testCreateValidator()
    {
        // Arrange
        $factory = new EntityNotExistsFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        $entityService = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $entityServiceManager = new EntityServiceManager($container, []);
        $entityServiceManager->setService('test', $entityService);

        $container->expects($this->once())
            ->method('get')
            ->with($this->equalTo('EntityServiceManager'))
            ->willReturn($entityServiceManager);

        // Act
        $result = $factory($container, '', [
            'entity' => 'test',
        ]);

        // Assert
        $this->assertInstanceOf(EntityNotExists::class, $result);
    }
}
