<?php
namespace AutoAcl\Service;

use AutoAcl\Model\RoleInterface;
use Zend\Permissions\Acl\AclInterface;
use Zend\Permissions\Acl\Acl;

class RoleService implements RoleServiceInterface
{
    protected $acl;

    public function __construct(
        Acl $acl
    ){
        $this->acl = $acl;
    }

    /**
     * @return array []RoleInterface
     */
    public function getAll()
    {
        $roles = [];
        foreach($this->acl->getRoles() as $roleId){
            $roles[$roleId] = $this->acl->getRole($roleId);
        }
        return $roles;
    }

    /**
     * @param $roleId string
     * @return RoleInterface|null
     */
    public function load($roleId)
    {
        /** @var RoleInterface $role */
        foreach($this->getAll() as $role){
            if($role->getRoleId() == $roleId){
                return $role;
            }
        }
        return null;
    }

    /**
     * @return array []
     */
    public function getRolesOptionArray()
    {
        $roleOptions = [];
        /** @var RoleInterface $role */
        foreach($this->getAll() as $role){
            $roleOptions[] = [
                'label' => $role->getName(),
                'value' => $role->getRoleId()
            ];
        }
        return $roleOptions;
    }
}