<?php
namespace AutoAcl\Factory\Service;

use AutoAcl\Service\RoleService;
use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleServiceFactory implements FactoryInterface
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed|\Zend\Permissions\Acl\Acl
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new RoleService(
            $serviceLocator->get('AutoAcl\Acl')
        );
	}
}