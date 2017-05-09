<?php
namespace AutoAcl\Factory\Hydrator\Strategy;

use AutoAcl\Hydrator\Strategy\RoleStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleStrategyFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new RoleStrategy(
			$serviceLocator->get('AutoAcl\RoleServiceInterface')
		);
	}
}