<?php
namespace AutoAcl\Factory\Model;

use AutoAcl\Model\Role;
use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class AutoAclFactory implements FactoryInterface
{
	/** @var Acl */
	protected $acl;

	/** @var ServiceLocatorInterface */
	protected $serviceLocator;

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
        $this->acl = new Acl();
        $this->serviceLocator = $container;

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


        $routePrefix = '/routes';
		$this->acl->addResource($routePrefix);
		foreach($config as $routeName => $routeConfig){
			$this->addRouteResource($routePrefix, $routeName, $routeConfig);
		}
	}

	protected function addRouteResource($parentRoute, $currentRoute, $routeConfig)
	{
		$resourceName = $parentRoute.'/'.$currentRoute;
		//echo 'adding: '.$resourceName.'<br />';
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
		foreach($config as $roleId => $roleConfig){
			if(!$this->acl->hasRole($roleId)){
                if(!isset($roleConfig['name'])){
                    $roleConfig['name'] = $roleId;
                }
                if(!isset($roleConfig['description'])){
                    $roleConfig['description'] = $roleId;
                }
//                echo 'adding role: '.$roleId.'<br />';
				$this->acl->addRole(new Role(
                    $roleId,
                    $roleConfig['name'],
                    $roleConfig['description']
                ));
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

					$this->acl->allow($roleId, $resource, $priv);
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

					$this->acl->deny($roleId, $resource, $priv);
				}
			}
		}
	}
}