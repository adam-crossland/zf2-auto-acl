<?php
namespace AutoAcl\Factory\Hydrator\Strategy;

use AutoAcl\Hydrator\Strategy\RoleStrategy;
use AutoAcl\Service\RoleServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class RoleStrategyFactory implements FactoryInterface
{
	/**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RoleStrategy(
            $container->get(RoleServiceInterface::class)
        );
    }
}