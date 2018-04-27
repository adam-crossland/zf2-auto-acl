<?php
namespace AutoAcl\Initializer;

use AutoAcl\Model\AclAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;
use Interop\Container\ContainerInterface;

class AclAwareInitializer implements InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param  ContainerInterface $container
     * @param  object             $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if($instance instanceof AclAwareInterface){
            $instance->setAcl($container->get('AutoAcl\Acl'));
        }
    }
}