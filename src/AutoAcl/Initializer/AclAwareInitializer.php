<?php
namespace AutoAcl\Initializer;

use AutoAcl\Model\AclAwareInterface;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclAwareInitializer implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if($instance instanceof AclAwareInterface){
            $instance->setAcl($serviceLocator->get('AutoAcl\Acl'));
        }
    }
}