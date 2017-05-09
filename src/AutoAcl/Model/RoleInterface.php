<?php
namespace AutoAcl\Model;

use \Zend\Permissions\Acl\Role\RoleInterface as ZendRoleInterface;

interface RoleInterface extends ZendRoleInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getDescription();
}