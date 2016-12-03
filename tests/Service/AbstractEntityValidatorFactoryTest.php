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
use PolderKnowledge\EntityService\Validator\EntityExists;
use PolderKnowledge\EntityService\Validator\Service\EntityExistsFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractEntityValidatorFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::__invoke
     * @expectedException InvalidArgumentException
     */
    public function testInvokeWithoutOptions()
    {
        // Arrange
        $factory = new EntityExistsFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $factory->__invoke($container, '');

        // Assert
        // ...
    }

    /**
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::__invoke
     * @expectedException RuntimeException
     */
    public function testInvokeWithoutEntityOption()
    {
        // Arrange
        $factory = new EntityExistsFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $factory->__invoke($container, '', [
            'test' => '',
        ]);

        // Assert
        // ...
    }

    /**
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::__invoke
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::createEntityService
     */
    public function testInvoke()
    {
        // Arrange
        $factory = new EntityExistsFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        $entityService = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $entityServiceManager = new EntityServiceManager($container, []);
        $entityServiceManager->setService('test', $entityService);

        $container->expects($this->once())
            ->method('get')
            ->with($this->equalTo('EntityServiceManager'))
            ->willReturn($entityServiceManager);

        // Act
        $result = $factory->__invoke($container, '', [
            'entity' => 'test',
        ]);

        // Assert
        $this->assertInstanceOf(EntityExists::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::createService
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::createEntityService
     * @covers PolderKnowledge\EntityService\Validator\Service\AbstractEntityValidatorFactory::setCreationOptions
     */
    public function testCreateService()
    {
        // Arrange
        $factory = new EntityExistsFactory();
        $factory->setCreationOptions([
            'entity' => 'test',
        ]);

        $container = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        $entityService = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $entityServiceManager = new EntityServiceManager($container, []);
        $entityServiceManager->setService('test', $entityService);

        $container->expects($this->once())
            ->method('get')
            ->with($this->equalTo('EntityServiceManager'))
            ->willReturn($entityServiceManager);

        // Act
        $result = $factory->createService($container);

        // Assert
        $this->assertInstanceOf(EntityExists::class, $result);
    }

    /*
    public function testCreateService()
    {
        // Arrange
        $entityNotExistsFactory = new EntityNotExistsFactory();

        $entityServiceMock = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $entityServiceManager = $this->getMock(EntityServiceManager::class);
        $entityServiceManager->expects($this->once())->method('get')->willReturn($entityServiceMock);

        $serviceManagerMockBuilder = $this->getMockBuilder(ServiceManager::class);
        $serviceManagerMockBuilder->setMethods(array('get'));
        $serviceManager = $serviceManagerMockBuilder->getMock();
        $serviceManager->expects($this->once())->method('get')->willReturn($entityServiceManager);

        $mockBuilder = $this->getMockBuilder(AbstractPluginManager::class);
        $mockBuilder->setMethods(array('getServiceLocator'));
        $mock = $mockBuilder->getMockForAbstractClass();
        $mock->expects($this->once())->method('getServiceLocator')->willReturn($serviceManager);

        // Act
        $result = $entityNotExistsFactory->createService($mock);

        // Assert
        $this->assertInstanceOf(EntityNotExists::class, $result);
    }

    public function testSetCreationOptions()
    {
        // Arrange
        $entityNotExistsFactory = new EntityNotExistsFactory();
        $entityNotExistsFactory->setCreationOptions(array(
            'entity' => MyEntity::class,
        ));

        $entityServiceMock = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $entityServiceManager = $this->getMock(EntityServiceManager::class);
        $entityServiceManager->expects($this->once())->method('get')->willReturn($entityServiceMock);

        $serviceManagerMockBuilder = $this->getMockBuilder(ServiceManager::class);
        $serviceManagerMockBuilder->setMethods(array('get'));
        $serviceManager = $serviceManagerMockBuilder->getMock();
        $serviceManager->expects($this->once())->method('get')->willReturn($entityServiceManager);

        $mockBuilder = $this->getMockBuilder(AbstractPluginManager::class);
        $mockBuilder->setMethods(array('getServiceLocator'));
        $mock = $mockBuilder->getMockForAbstractClass();
        $mock->expects($this->once())->method('getServiceLocator')->willReturn($serviceManager);

        // Act
        $result = $entityNotExistsFactory->createService($mock);

        // Assert
        $this->assertInstanceOf(EntityNotExists::class, $result);
    }
    */
}
