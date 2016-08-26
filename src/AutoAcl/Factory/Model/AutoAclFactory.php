<?php
namespace AutoAcl\Factory\Model;

use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AutoAclFactory implements FactoryInterface
{
	/** @var Acl */
	protected $acl;

	/** @var ServiceLocatorInterface */
	protected $serviceLocator;

	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed|\Zend\Permissions\Acl\Acl
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$this->acl = new Acl();
		$this->serviceLocator = $serviceLocator;

		// Go through routes and use them as resources
		$this->initRouteResources();

		// Go through all navigation and use them as resources
		//$this->initNavigationResources();

		// Go through all configured permissions
		$this->initRoles();

		return $this->acl;
	}

	protected function initRouteResources()
	{
		$config = $this->serviceLocator->get('config');
		$config = $config['router']['routes'];

		$this->acl->addResource('/routes');
		foreach($config as $routeName => $routeConfig){
			$this->addRouteResource('/routes', $routeName, $routeConfig);
		}
	}

	protected function addRouteResource($parentRoute, $currentRoute, $routeConfig)
	{
		$resourceName = $parentRoute.'/'.$currentRoute;
		// echo 'adding: '.$resourceName.'<br />';
		$this->acl->addResource($resourceName, $parentRoute);
		if(isset($routeConfig['child_routes'])){
			foreach($routeConfig['child_routes'] as $routeName => $config){
				$this->addRouteResource($resourceName, $routeName, $config);
			}
		}
		if(isset($routeConfig['options'], $routeConfig['options']['defaults'], $routeConfig['options']['defaults']['controller'])){
			// TODO come back to maybe
//			$controllerName = $routeConfig['options']['defaults']['controller'];
//			$controller = $this->serviceLocator->get('controllermanager')->get($controllerName);
//			$controllerClass = get_class($controller);
//			$reflectionController = new \ReflectionClass($controller);
//			/** @var $method \ReflectionMethod */
//			foreach($reflectionController->getMethods(\ReflectionMethod::IS_PUBLIC) as $method){
//				if($method->class != $controllerClass || strpos($method->name, 'Action') != (strlen($method->name) - strlen('Action'))){
//					continue;
//				}
//				$methodResourceName = $resourceName.':'.str_replace('Action', '', $method->name);
//				echo 'adding: '.$methodResourceName.'<br />';
//				$this->acl->addResource($methodResourceName, $resourceName);
//
//			}
		}
	}

	protected function initRoles()
	{
		$config = $this->serviceLocator->get('config');
		$config = $config['auto-acl']['roles'];
		foreach($config as $roleName => $roleConfig){
			if(!$this->acl->hasRole($roleName)){
				$this->acl->addRole($roleName);
			}

			if(isset($roleConfig['allow'])){
				foreach($roleConfig['allow'] as $id => $permissionData){
					$resource = $permissionData['resource'];
					$priv = $permissionData['privileges'];
					if(is_array($priv) && empty($priv)){
						$priv = null;
					}elseif($priv != null){
						$priv = null;
					}

					$this->acl->allow($roleName, $resource, $priv);
				}
			}

			if(isset($roleConfig['deny'])){
				foreach($roleConfig['deny'] as $id => $permissionData){
					$resource = $permissionData['resource'];
					$priv = $permissionData['privileges'];
					if(is_array($priv) && empty($priv)){
						$priv = null;
					}elseif($priv != null){
						$priv = null;
					}

					$this->acl->deny($roleName, $resource, $priv);
				}
			}
		}
	}
}